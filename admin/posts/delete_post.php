<?php
  $db = new mysqli('localhost', 'root', '', 'gaming-news');

  // Get the post's ID
  $id = $_GET['id'];

  // Delete the post
  $query = "DELETE FROM posts WHERE id=$id";
  $db->query($query);
  header('Location: posts.php');
?>
