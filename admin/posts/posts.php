<?php
  // Connect to the database
  $db = new mysqli('localhost', 'root', '', 'gaming-news');

  // Select all posts from the "posts" table
  $query = "SELECT * FROM posts ORDER BY id DESC";
  $result = $db->query($query);
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
      body {
        background: #FC466B;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        color: white;
        }
        table {
        border-collapse: collapse;
        width: 100%;
        color:white;
      }

      th, td {
        text-align: left;
        padding: 10px;
      }


      th {
        background-color: #4CAF50;
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
  </body>
</html>
<?php

    // Check if there are any posts
    if ($result->num_rows > 0) {
      // Create an HTML table to display the posts
      echo '<table>';

    // Loop through the rows of the result set
    while ($row = $result->fetch_assoc()) {
      // Display the post data in a row of the table
      echo '<tr>';
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['title'] . '</td>';
      echo '<td>' . $row['body'] . '</td>';
      echo '<td>' . $row['author'] . '</td>';
      echo '<td>' . $row['date'] . '</td>';
      echo '<td>';

      // Check if the post has an image
      if ($row['image_name'] != null) {
        // Display the image
        echo '<img src="data:' . $row['image_mime_type'] . ';base64,' . base64_encode($row['image_data']) . '" alt="' . $row['image_name'] . '" width="100">';
      } else {
        // Display a placeholder image
        echo '<img src="placeholder.jpg" alt="No image" width="100">';
      }
      echo '</td>';
      echo '<td>';

      // Display the delete and edit buttons
      echo '<a href="delete_post.php?id=' . $row['id'] . '"><img src="post_images/delete.png" alt="Delete" width="20"></a>';
      echo '<a href="edit_post.php?id=' . $row['id'] . '"><img src="post_images/edit.png" alt="Edit" width="20"></a>';
      echo '</td>';
      echo '</tr>';
    }

    // Close the table
    echo '</table>';
  } else {
    // No posts found
    echo 'No posts found';
  }
?>


