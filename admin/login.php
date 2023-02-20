<?php
// Start the session
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  // If the admin is already logged in, redirect them to the admin panel
  header('Location: admin-panel.php');
  exit;
}

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'gaming-news');

// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Escape the submitted username and password to prevent SQL injection attacks
  $username = $db->real_escape_string($_POST['username']);
  $password = $db->real_escape_string($_POST['password']);

  // Query the database to see if the entered username and password match any records
  $query = "SELECT * FROM admins WHERE username='$username' AND password='$password' LIMIT 1";
  $result = $db->query($query);

  // Check if a record was found
  if ($result->num_rows == 1) {
    // If a record was found, log the admin in and redirect them to the admin panel
    $_SESSION['logged_in'] = true;
    header('Location: admin-panel.php');
    exit;
  } else {
    // If no record was found, display an error message
    $error_message = 'Invalid username or password';
  }
}
?>

<!doctype html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
    background: #FC466B;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color: white;
    text-align: center;
    }

    form {
      margin-top: 10%;
      font-size: 18px;
    }

    input {
      width:10%;
    }

  </style>
</head>
<body>
  <h1>Admin Login</h1>
  <?php if (isset($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Log In">
  </form>
</body>
</html>
