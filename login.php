<form action="login.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
// Connect to the database
$host = "localhost";
$user = "username";
$password = "password";
$dbname = "database_name";
$conn = mysqli_connect('localhost', 'root', '', 'gaming-news');

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Query the database for a user with the specified username and password
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  // If a matching user was found, log them in
  if (mysqli_num_rows($result) > 0) {
    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header("Location: posts.php");
  } else {
    // If no matching user was found, display an error message
    echo "Invalid username or password.";
  }
}

mysqli_close($conn);
?>
