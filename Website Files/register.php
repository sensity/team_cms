<?php include ("includes/header.php") ?>



<?php

    if(isset($_SESSION['loginn']) == 1)

    {
        echo "<div class='alert alert-info'>You already have a user.</div>";
    }

    else
    {
    }

?>



    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <!-- content -->

					<?php $login->register(); ?>
            </div>



<?php include ("includes/footer.php") ?>