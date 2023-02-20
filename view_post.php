<!DOCTYPE html>
<html>
    <head>
        <title>Posts</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <style>
            body {
                    background: #a8c0ff;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    color:white;
                    font-size: 25px;;
                }
                .post-image {
                width: 100%;
                height: 100%;
                }
        </style>
    </head>
    <body>
        <?php
        // Connect to the database
        $db = new mysqli('localhost', 'root', '', 'gaming-news');

        // Get the id of the post from the query string
        $id = $_GET['id'];

        // Get the post from the "posts" table
        $query = "SELECT * FROM posts WHERE id=$id";
        $result = $db->query($query);

        // Get the post data
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $body = $row['body'];
        $author = $row['author'];
        $date = $row['date'];
        $image_name = $row['image_name'];
        $image_data = $row['image_data'];
        $image_mime_type = $row['image_mime_type'];
        ?>
        <!-- The Bootstrap container -->
        <div class="container mt-4">
        <!-- The post title -->
        <h1 class="display-4"><?php echo $title; ?></h1>
        <!-- The post author and date -->
        <p class="lead"><?php echo $author; ?> - <?php echo $date; ?></p>
        <hr class="my-4">
        <!-- The post image -->
        <?php if($image_name) { ?>
            <img src="data:<?php echo $image_mime_type; ?>;base64,<?php echo base64_encode($image_data); ?>" alt="<?php echo $image_name; ?>" class="post-image img-fluid rounded">
        <?php } ?>

        <hr class="my-4">
        <!-- The post body -->
        <p><?php echo $body; ?></p>
        </div>





    </body>
</html>


