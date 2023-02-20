<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // If the admin is not logged in, redirect them to the login page
  header('Location: login.php');
  exit;
}

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'gaming-news');

// Execute the SELECT COUNT(*) statement
$result = $db->query('SELECT COUNT(*) as count FROM posts');

// Retrieve the count
$row = $result->fetch_assoc();
$count = $row['count'];

// Close the database connection
$db->close();
?>

<!doctype html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <style>
    .fade-in {
      animation: fadeIn 1s ease-in;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    body {
    background: #FC466B;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color: white;
    }

    .green-card {
    background-color: #5BC0F8;
    color: black;
    }

    .yellow-card {
      background-color: #86E5FF;
      color: black;
    }

    .blue-card {
      background-color: #FFC93C;
      color: black;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/gaming-news-app/admin/admin-panel.php">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/gaming-news-app/admin/posts/posts.php">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/gaming-news-app/admin/posts/add_post.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/gaming-news-app/admin/users/users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/gaming-news-app/admin/users/add_user.php">Add User</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <form action="logout.php">
              <button type="submit" value="Logout">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container mt-5">
      <div class="text-center fade-in">
        <h1 class="display-4">Admin Panel</h1>
        <p class="lead">Manage Users/Posts/Shop</p>
      </div>
    </div>

    <br><br><br><br><br>


    <!-- Icon for number of posts -->
<div class="container mt-5">
  <div class="row">
    <div class="col-4">
      <div class="card  text-center green-card fade-in">
        <div class="card-body">
          <i class="fas fa-file-alt fa-3x"></i>
          <h5 class="card-title mt-2">Number of Posts:</h5>
          <p class="card-text">
            <?php
            // Connect to database and count number of posts
            $conn = mysqli_connect('localhost', 'root', '', 'gaming-news');
            $query = "SELECT COUNT(*) as num_posts FROM posts";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            echo $row['num_posts'];
            ?>
          </p>
        </div>
      </div>
    </div>
    
    <!-- Icon for number of users -->
    <div class="col-4">
      <div class="card text-center yellow-card fade-in">
        <div class="card-body">
          <i class="fas fa-users fa-3x"></i>
          <h5 class="card-title mt-2">Number of Users:</h5>
          <p class="card-text">
            <?php
            // Connect to database and count number of users
            $conn = mysqli_connect('localhost', 'root', '', 'gaming-news');
            $query = "SELECT COUNT(*) as num_users FROM users";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            echo $row['num_users'];
            ?>
          </p>
        </div>
      </div>
    </div>
    
        <!-- Icon for number of users -->
        <div class="col-4">
      <div class="card text-center blue-card fade-in">
        <div class="card-body">
          <i class="fas fa-users fa-3x"></i>
          <h5 class="card-title mt-2">Number of Products:</h5>
          <p class="card-text">
            <?php
            // Connect to database and count number of users
            $conn = mysqli_connect('localhost', 'root', '', 'gaming-news');
            $query = "SELECT COUNT(*) as num_users FROM users";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            echo $row['num_users'];
            ?>
          </p>
        </div>
      </div>
    </div>

</body>
</html>
