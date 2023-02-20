<?php
  $db = new mysqli('localhost', 'root', '', 'gaming-news');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $db->escape_string($_POST['title']);
    $body = $db->escape_string($_POST['body']);
    $author = $db->escape_string($_POST['author']);
    $date = date('Y-m-d H:i:s');

    // Check if the image isn't empty
    if (!empty($_FILES['image']['name'])) {
      $image_name = $db->escape_string($_FILES['image']['name']);
      $image_data = $db->escape_string(file_get_contents($_FILES['image']['tmp_name']));
      $image_mime_type = $db->escape_string($_FILES['image']['type']);
    } else {
      // Else set the values to null
      $image_name = null;
      $image_data = null;
      $image_mime_type = null;
    }

    // Insert the post into the database and redirect to post.php
    $query = "INSERT INTO posts (title, body, author, date, image_name, image_data, image_mime_type) VALUES ('$title', '$body', '$author', '$date', '$image_name', '$image_data', '$image_mime_type')";
    $db->query($query);
    header('Location: /gaming-news-app/admin/posts/posts.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style>
      body {
        background: #FC466B;  /* Old browsers */
        background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        color: white;
      }
      form {
        text-align: center ;
        margin-top:10%;
      }

      .form-add {
        text-align: center;
        margin-top:10%;
      }

      input[type=text] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
      }

      textarea {
        height: 10em;
        width: 50%;
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
      <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title"><br>
        <br>
        <label for="body">Body:</label><br>
        <textarea name="body" id="body" cols="30" rows="10"></textarea><br>
        <label for="author">Author:</label><br>
        <input type="text" name="author" id="author">  <br>
        <label for="image">JPG Image:</label><br>
        <input type="file" name="image" id="image"><br>
        <br>
        <input type="submit" value="Add Post">
      </form>
  </body>
</html>
