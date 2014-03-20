<?php include ("includes/header.php") ?>

<?php $news = new News; ?>

    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <!-- news start -->
                <?php $news->getFrontPageNews(); ?>
            </div>

<?php include ("includes/footer.php") ?>