<?php include ("includes/header.php") ?>

<?php
    if($_SESSION['loginn'] != 1)
    {
        header("location:index.php");
    }
?>
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <!-- Page Content -->
                    <legend>Your Profile</legend>

                    <div class="well">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#your-profile" data-toggle="tab">Your Profile</a></li>
                          <li><a href="#edit-profile" data-toggle="tab">Edit Profile</a></li>
                          <li><a href="#messages" data-toggle="tab">Messages</a></li>
                          <li><a href="#twitch-stream" data-toggle="tab">Twitch.TV Stream (Offline)</a></li>
                        </ul>

                        <!-- Tab panes - Contains Data -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="your-profile">
                                <div class='well'>
                                    <?php $profile->myProfile(); ?>
                              </div>
                          </div>
                          <div class="tab-pane" id="edit-profile">
                              <div class='well'>
                                    <?php $profile->editProfile(); ?>
                                </div>
                                </div>
                                <div class="tab-pane" id="messages">
                                     <!-- Table -->
                                    <table class="table">
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>From</th>
                                        <tr>
                                            <td>1</td>
                                            <td>Have you done this yet?</td>
                                            <td><a href=''>fodbolden</a></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="tab-pane" id="twitch-stream">
                                    <?php $profile->twitchStream(); ?>
<!-- DO NOT TOUCH ANYTHING BELOW THIS LINE -->
                        </div>
                    </div>
                </div>
            </div>
<?php include ("includes/footer.php") ?>