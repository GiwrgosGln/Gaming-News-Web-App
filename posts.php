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
                font-family: Arial, Helvetica, sans-serif;
            }
            .carousel {
                margin: 0 auto;
            }
            .carousel a {
                color:white;
                font-size:25px;
            }
            .carousel-item h3 {
            font-size: 2em;
            }

            @media (max-width: 767px) {
            .carousel-item h3 {
                font-size: 1.5em;
            }
            }




        </style>
    </head>
    <body>
        <?php
            session_start();
        ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Logo" style="width:40px;">
        </a>
        <a class="navbar-brand" href="#">Gaming News</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Reviews</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Shop</a>
            </li>
            </ul>
            <?php if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) { ?>
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="nav-link">Register</a>
            <?php } else { ?>
            <div class="dropdown">
                <button class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
            <?php } ?>
        </div>
        </nav>



        <div class="content">
            <br><br>
            <!-- The Bootstrap carousel -->
            <div class="carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 60%; height: 30%;">
                <!-- The carousel indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <!-- The carousel items -->
                <div class="carousel-inner">
                    <?php
                    // Connect to the database
                    $db = new mysqli('localhost', 'root', '', 'gaming-news');

                    // Get the latest 3 posts from the "posts" table
                    $query = "SELECT * FROM posts ORDER BY date DESC LIMIT 3";
                    $result = $db->query($query);

                    // Loop through the posts
                    $i = 0;
                    while($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                        $body = $row['body'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $image_name = $row['image_name'];
                        $image_data = $row['image_data'];
                        $image_mime_type = $row['image_mime_type'];
                    ?>
                    <!-- The carousel item -->
                    <div class="carousel-item <?php if($i == 0) { echo 'active'; } ?>">
                    <!-- The post image -->
                    <?php if($image_name) { ?>
                        <img src="data:<?php echo $image_mime_type; ?>;base64,<?php echo base64_encode($image_data); ?>" class="d-block w-100" alt="<?php echo $image_name; ?>">
                    <?php } ?>
                    <!-- The post content -->
                    <div class="carousel-caption d-none d-md-block">
                        <!-- The post title -->
                        <h5 class="card-title"><a href="view_post.php?id=<?php echo $row['id']; ?>"><?php echo $title; ?></a></h5>
                        <!-- The post author and date -->
                        <p><?php echo $author; ?> - <?php echo $date; ?></p>
                    </div>
                    </div>
                    <?php $i++; } ?>
                </div>
                <!-- The carousel controls -->
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div>

            <!-- The Bootstrap grid layout -->
            <div class="container mt-4">
            <div class="row">
                <?php
                // Get the rest of the posts from the "posts" table
                $query = "SELECT * FROM posts ORDER BY date DESC LIMIT 3, 18446744073709551615";
                $result = $db->query($query);

                // Loop through the posts
                while($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                    $body = $row['body'];
                    $author = $row['author'];
                    $date = $row['date'];
                    $image_name = $row['image_name'];
                    $image_data = $row['image_data'];
                    $image_mime_type = $row['image_mime_type'];
                ?>
                <!-- The Bootstrap card for each post -->
                <div class="col-4">
                <div class="card mb-4">
                    <!-- The post image -->
                    <?php if($image_name) { ?>
                    <img src="data:<?php echo $image_mime_type; ?>;base64,<?php echo base64_encode($image_data); ?>" class="card-img-top" alt="<?php echo $image_name; ?>">
                    <?php } ?>
                    <!-- The post content -->
                    <div class="card-body">
                    <!-- The post title -->
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <!-- The post author and date -->
                    <p class="card-text"><?php echo $author; ?> - <?php echo $date; ?></p>
                    <!-- The post excerpt -->
                    <p class="card-text"><?php echo substr($body, 0, 100); ?>...</p>
                    <!-- The "Read More" button -->
                    <a href="view_post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                </div>
                <?php } ?>
            </div>
            </div>
        </div>
    </body>
</html>


