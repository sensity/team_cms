<?php
    session_start();
    ob_start();

    include ("connect.php");
    include_once("class.lib.php");
    include_once("classes/autoload.class.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YOUR SITE TITEL</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/blog-home.css" rel="stylesheet">

</head>

<?php
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
?>


<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">

                <?php

                    $query = "SELECT * FROM menu";
    
                    $result = mysqli_query($con, $query);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "
                                <li><a href='$row[menu_link]'>$row[menu_name]</a></li>
                            ";
                    }

                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>