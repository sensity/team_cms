<?php include ('includes/header.php'); ?>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to the admin panel<a class="alert-link" href="#"> TEST </a>! This is the user administration.
            </div>
          </div>
        </div><!-- /.row -->

        <?php
            if(isset($_GET['id']))
            {
              echo "
                    <form class='form-horizontal' method='POST'>
                      <fieldset>



                      <!-- Form Name -->
                      <legend>Message</legend>

                      <div class='well'>

                      <div align='left'>
                      ";

                      $id = $_GET['id'];
                      //Shows the message from contact page, with the ID
                      $query_showcm = "SELECT * FROM users WHERE user_id=$id";

                      $result = mysqli_query($con, $query_showcm);

                      $row = mysqli_fetch_assoc($result);

                      echo "

                      Name - $row[user_realname]
                      <br />
                      Username - $row[user_username]
                      <br />
                      E-Mail - $row[user_email]
                      <br />
                      Avatar - $row[user_avatar]
                      <br />
                      LoL Ign - $row[user_lol_ign]
                      <br />
                      Steam CommunityID - $row[user_steam_comid]
                      <br />
                      LoL Ign - $row[user_twitch_username]
                      <br />

                      ";
                      //This function is for changing status on the current message, retrieved by id.
                      $query_changestatus = "SELECT * FROM contact_message WHERE cm_id=$id";

                      $result = mysqli_query($con, $query_changestatus);

                      $row = mysqli_fetch_assoc($result);

                      ?>
                      <!-- User role editor -->
                      <?php

                      echo " 

                      </div><!-- </ align middle -->
                      </div>
              ";
            }

            else
            {
              echo "
              <div class='row'>
                <div class='col-lg-12'>
                  <h2>Messages</h2>
                  <div class='table-responsive'>
                    <table class='table table-bordered table-hover tablesorter'>
                      <thead>
                        <tr>
                          <th># <i class='fa fa-sort'></i></th>
                          <th>Username <i class='fa fa-sort'></i></th>
                          <th>E-Mail <i class='fa fa-sort'></i></th>
                          <th>Position <i class='fa fa-sort'></i></th>
                          <th>Status <i class='fa fa-sort'></i></th>
                        </tr>
                      </thead>
                      <tbody>
                      ";

                          $query = "SELECT * FROM users LEFT JOIN position ON users.fk_position_id=position.position_id";

                          $result = mysqli_query($con, $query);

                          while($row = mysqli_fetch_assoc($result))
                          {
                            echo "
                                  <tr>
                                    <td>$row[user_id]</td>
                                    <td><a href='?id=$row[user_id]'>$row[user_username]</a></td>
                                    <td><a href='mailto:$row[user_email]'>$row[user_email]</td>
                                    <td>$row[position_name]</td>
                                    <td>Active</td>
                                  </tr>
                            ";
                          }
                      echo "
                      </tbody>
                    </table>
                  </div>
                </div>
                ";
            }
        ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

<?php include ('includes/footer.php'); ?>