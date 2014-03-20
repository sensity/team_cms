<?php include ("includes/header.php") ?>

<?php
    if(isset($_SESSION['loginn']) == 1)
    {
        echo "<div class='alert alert-info'>You are already logged in.</div>";
    }
    else
    {

    }
?>

    <div class="container">

        <div class="row">
            <div class="col-lg-8">

                <form class="form-horizontal" method="POST">
                    <fieldset>
                    <!-- Form Name -->
                    <legend>Login - User Accounts</legend>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Username</label>  
                      <div class="col-md-4">
                      <input id="textinput" name="username" type="text" placeholder="Username" class="form-control input-md">
                      <span class="help-block"></span>  
                      </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="passwordinput">Password</label>
                      <div class="col-md-4">
                        <input id="passwordinput" name="password" type="password" placeholder="Password" class="form-control input-md">
                        <span class="help-block"></span>
                      </div>
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="button1id"></label>
                      <div class="col-md-8">
                        <button id="button1id" name="submit_login" class="btn btn-success" type="submit">Login</button>
                        <button id="button2id" name="button2id" class="btn btn-danger">Reset All Fields</button>
                      </div>
                    </div>

                    </fieldset>
                </form>
                    <!-- This is our login function -->
                    <?php $login->loginfunc(); ?>    
            </div>

            <?php

            if(isset($_GET['logout']))
            {
                $login->logout();
            }

            ?>

<?php include ("includes/footer.php") ?>