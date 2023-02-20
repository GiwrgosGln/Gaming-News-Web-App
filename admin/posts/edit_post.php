<?php
  $db = new mysqli('localhost', 'root', '', 'gaming-news');

  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $author = $_POST['author'];
    $date = $_POST['date'];

    // Check if the user has selected a new image
    if ($_FILES['image']['error'] == 0) {
      $image_data = $db->escape_string(file_get_contents($_FILES['image']['tmp_name']));
      $image_mime_type = $db->escape_string($_FILES['image']['type']);
      $image_name = $db->escape_string($_FILES['image']['name']);

      // Update new image
      $query = "UPDATE posts SET title='$title', body='$body', author='$author', date='$date', image_name='$image_name', image_data='$image_data', image_mime_type='$image_mime_type' WHERE id=$id";
      $db->query($query);
    } else {
      // Update the post without making any changes to image
      $query = "UPDATE posts SET title='$title', body='$body', author='$author', date='$date' WHERE id=$id";
      $db->query($query);
    }
    header('Location: posts.php');
  } else {
    $id = $_GET['id'];
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = $db->query($query);
    $post = $result->fetch_assoc();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Post</title>
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
    
    <!-- Navbar -->
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

    <!-- Form -->
    <form action="edit_post.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
      <label for="title">Title:</label><br>
      <input type="text" name="title" value="<?php echo $post['title']; ?>"><br>
      <label for="body">Body:</label><br>
      <textarea name="body"><?php echo $post['body']; ?></textarea><br>
      <label for="author">Author:</label><br>
      <input type="text" name="author" value="<?php echo $post['author']; ?>"><br>
      <label for="date">Date:</label><br>
      <input type="date" name="date" value="<?php echo $post['date']; ?>"><br>
      <label for="image">Image:</label><br>
      <input type="file" name="image"><br>
      <?php
        // Check if the post has an image
        if ($post['image_name'] != null) {
          // Display the current image
          echo '<img src="data:' . $post['image_mime_type'] . ';base64,' . base64_encode($post['image_data']) . '" alt="' . $post['image_name'] . '" width="100">';
        } else {
          // Display a placeholder image
          echo '<img src="placeholder.jpg" alt="No image" width="100">';
        }
      ?>
      <br><br>
      <input type="submit" name="submit" value="Save">
    </form>
  </body>
</html>

