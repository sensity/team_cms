<?php include ("includes/header.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- news start -->
                <?php $news->getNewsByID(); ?>
            </div>
<?php include ("includes/footer.php") ?>