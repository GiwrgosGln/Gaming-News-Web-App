<form action="register.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
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
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Check if the username is already in use
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    echo "Username already in use. Please choose a different username.";
  } else {
    // Check if the email is already in use
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      echo "Email already in use. Please use a different email.";
    } else {
      // Insert the new user into the database
      $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
      mysqli_query($conn, $query);
      echo "Registration successful! You can now login.";
    }
  }
}

mysqli_close($conn);
?>
