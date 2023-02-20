<?php
  // Start the session
  session_start();

  // Remove the user's login session
  unset($_SESSION['logged_in']);

  // Redirect the user to the login page
  header('Location: login.php');
  exit;
?>
