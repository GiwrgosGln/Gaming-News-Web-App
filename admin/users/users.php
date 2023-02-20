<?php
  // Connect to the database
  $db = new mysqli('localhost', 'root', '', 'gaming-news');

  // Start the session
  session_start();

  // Check if the admin is logged in
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If the admin is not logged in, redirect them to the login page
    header('Location: /gaming-news-app/admin/login.php');
    exit;
  }

  // Check for form submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user clicked the delete button
    if (isset($_POST['delete_user_id'])) {
      // Get the ID of the user to delete
      $id = $db->escape_string($_POST['delete_user_id']);

      // Delete the user from the database
      $query = "DELETE FROM users WHERE id = $id";
      $db->query($query);
    }
  }

  // Query the database for the users
  $query = "SELECT * FROM users";
  $result = $db->query($query);

  // Fetch the users from the result
  $users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!-- HTML to display the users -->
<!DOCTYPE html>
<html>
  <head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style>
      body {
          background: #FC466B;  /* fallback for old browsers */
          background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
          background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          color: white;
        }
        table {
        border-collapse: collapse;
        width: 40%;
        margin-left: auto;
        margin-right: auto;
        margin-top:50px;
      }

      button {
        text-align: center;
        margin-left:10px;
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
              <form action="/gaming-news-app/admin/logout.php">
                <button type="submit" value="Logout">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </nav>

    <table>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td>
            <form method="post">
              <input type="hidden" name="delete_user_id" value="<?php echo $user['id']; ?>">
              <button type="submit"><img src="/gaming-news-app/admin/posts/post_images/delete.png" width="15"></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>
