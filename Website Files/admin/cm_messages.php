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
              Welcome to the admin panel<a class="alert-link" href="#"> TEST </a>! Here can you view and reply messages people sent from the contact form on our website.
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

                      <div align='middle'>
                      ";

                      $id = $_GET['id'];
                      //Shows the message from contact page, with the ID
                      $query_showcm = "SELECT * FROM contact_message WHERE cm_id=$id";

                      $result = mysqli_query($con, $query_showcm);

                      $row = mysqli_fetch_assoc($result);

                      echo "

                      Full Name - $row[cm_name]
                      <br />
                      Username - $row[cm_username]
                      <br />
                      E-Mail - $row[cm_email]
                      <br />
                      Subject - $row[cm_subject]
                      <br />
                      Message - $row[cm_message]
                      <br /><br />

                      Status - $row[cm_status]
                      <br />
                      Change Status - 

                      ";
                      //This function is for changing status on the current message, retrieved by id.
                      $query_changestatus = "SELECT * FROM contact_message WHERE cm_id=$id";

                      $result = mysqli_query($con, $query_changestatus);

                      $row = mysqli_fetch_assoc($result);

                      ?>
                      <?php
                          //If the button cm_reply is pressed, do {}
                          if(isset($_POST['status']))
                          {
                            $cm_newstatus = $_POST['cm_status'];

                            $id = $_GET['id'];

                            $query_status = "UPDATE contact_message SET cm_status='$cm_newstatus' WHERE cm_id=$id";

                            $result = mysqli_query($con, $query_status);

                            header('Location: cm_messages.php');
                          }
                      ?>
                      <select name='cm_status' id='selectbasic'>
                        <option value='Open'<?php if($row['cm_status'] == "Open") { echo "selected=selected"; } ?>>Open</option>
                        <option value='Closed' <?php if($row['cm_status'] == "Closed") { echo "selected=selected"; } ?>>Closed</option>
                      </select><br />
                      <input type='submit' name='status' value='Change Status'>

                      <?php

                      echo " 

                      </div><!-- </ align middle -->

                      <!-- Textarea -->
                      <div class='form-group'>
                        <label class='col-md-4 control-label' for='textarea'>Reply Field</label>
                        <div class='col-md-4'>                     
                          <textarea class='form-control' id='textarea' name='textarea' placeholder='Reply Here'></textarea>
                        </div>
                      </div>

                      <!-- Button (Double) -->
                      <div class='form-group'>
                        <label class='col-md-4 control-label' for='cm_reply'></label>
                        <div class='col-md-8'>
                          <button id='cm_reply' name='cm_reply' class='btn btn-success' type='submit'>Send Reply</button>
                          <button id='cm_reset' name='cm_reset' class='btn btn-danger' type='reset'>Clear All Fields</button>
                        </div>
                      </div>

                      </fieldset>
                      </form>
                    </form>

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
                          <th>Subject <i class='fa fa-sort'></i></th>
                          <th>Sender Username <i class='fa fa-sort'></i></th>
                          <th>Sender Email <i class='fa fa-sort'></i></th>
                          <th>Message <i class='fa fa-sort'></i></th>
                          <th>Status <i class='fa fa-sort'></i></th>
                        </tr>
                      </thead>
                      <tbody>
                      ";

                          $query = 'SELECT * FROM contact_message';

                          $result = mysqli_query($con, $query);

                          while($row = mysqli_fetch_assoc($result))
                          {
                            echo "
                                  <tr>
                                    <td>$row[cm_id]</td>
                                    <td><a href='?id=$row[cm_id]'>$row[cm_subject]</a></td>
                                    <td>$row[cm_username]</td>
                                    <td><a href='mailto:$row[cm_email]'>$row[cm_email]</td>
                                    <td>$row[cm_message]</td>
                                    <td>$row[cm_status]</td>
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