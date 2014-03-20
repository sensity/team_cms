<?php
//Filename: Class.lib.php
//Website: http://Kristian-Jacobs.dk
//Author: Krisitan Jacobs 
//Publisher: Kristian Jacobs Develops 

$mysqli = new mysqli('localhost', 'root', '', 'team_cms');

//The class for global site settings.
class siteSettings
{
	public function currentVersion()
	{
		$version = "0.0.1";

		if($version == $row['site_version'])
		{
			echo "You have the up-to date version of the cms";
		}
		else
		{
			echo "There is a update available, you need to update now.";
		}
	}
}

//The class for every news related stuff.
class News
{
	//Showiwng the news on the index.php
	public function getFrontPageNews()
	{

		global $mysqli;

		//If there is some kind of error.
		if($mysqli->connect_errno > 0)
		{
    	echo $mysqli->error;
		}

		$query = "SELECT * FROM news LIMIT 3";

		$result = $mysqli->query($query);

		while ($row = $result->fetch_assoc())
		{
			echo "
				<h1><a href='#'>$row[news_title]</a></h1>

				<!-- Shows the news -->
				<p class='lead'>
	        		by <a href='profiles.php?id=1'>$row[news_author]</a>
	        	</p>

	        	<hr>

	        	<!-- Show the post time -->
	        	<p>
	        		<span class='glyphicon glyphicon-time'></span>
	        		Posted on August 28, 2013 at 10:00 PM
	        	</p>

	        	<hr>

	        	<!-- News Headline Picture -->
	        	<img src='http://placehold.it/900x300' class='img-responsive'>

	        	<hr>

	        	<p>
	        		$row[news_content]
	        	</p>

	        	<a class='btn btn-primary' href='news.php?id=$row[news_id]'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

	        	<hr>

	        	<!-- News End -->

				";
		}
	}

	//Showing the news on the news.php page.
	public function getNewsByID()
	{

		global $mysqli;

		if(isset($_GET['id']))
        {
            $id = $_GET['id'];

            $query = "SELECT * FROM news WHERE news_id=$id";

            $result = $mysqli->query($query);

            while ($row = $result->fetch_assoc())
            {
                echo "
                <h1><a href='#'>$row[news_title]</a></h1>

                <!-- Shows the news writer -->
                <p class='lead'>
                    by <a href='profiles.php?id=1'>$row[news_author]</a>
                </p>

                <hr>

                <!-- Show the post time -->
                <p>
                    <span class='glyphicon glyphicon-time'></span>
                    Posted on August 28, 2013 at 10:00 PM
                </p>

                <hr>

                <!-- News Headline Picture -->
                <img src='http://placehold.it/900x300' class='img-responsive'>

                <hr>

                <p>
                    $row[news_content]
                </p>

                <hr>

                <!-- News End -->

                ";
            }
        }
	    else
	    {
	        //Getting all news From the database.
	        $query = "SELECT * FROM news";

	        $result = $mysqli->query($query);

	        while ($row = $result->fetch_assoc())
	        {
	            echo "
	                <h1><a href='#'>$row[news_title]</a></h1>

	                <!-- Shows the news writer -->
	                <p class='lead'>
	                    by <a href='profiles.php?id=1'>$row[news_author]</a>
	                </p>

	                <hr>

	                <!-- Show the post time -->
	                <p>
	                    <span class='glyphicon glyphicon-time'></span>
	                    Posted on August 28, 2013 at 10:00 PM
	                </p>

	                <hr>

	                <!-- News Headline Picture -->
	                <img src='http://placehold.it/900x300' class='img-responsive'>

	                <hr>

	                <p>
	                    $row[news_content]
	                </p>

	                <a class='btn btn-primary' href='news.php?id=$row[news_id]'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

	                <hr>

	                <!-- News End -->

	                ";
	        }
	    }
	}
}

//Class about macthes the teams have played.

class matches
{
	//Shows all the matches. Shown: matches.php
	public function getAllMatches()
	{

		global $mysqli;

		echo "<h2>Latest Matches</h2>";
                
	    //Getting latest matches from our frontend_functions.php
	    $query = "SELECT * FROM matches INNER JOIN team ON matches.fk_team_id=team.team_id";

	    $result = $mysqli->query($query);

	    echo "
	    <!-- Table -->
	    <table class='table'>
	        <th>#</th>
	        <th>Our Team</th>
	        <th>Versus</th>
	        <th>Enemy Team</th>
	        <th>Score</th>
	        ";

	        while($row = $result->fetch_assoc())
	        {
	            echo "  
	                <tr>
	                    <td>$row[match_id]</td>
	                    <td><a href='teams.php?id=$row[team_id]'>$row[match_team_a]</a></td>
	                    <td>=></td>
	                    <td>$row[match_team_b]</td>
	                    <td>$row[match_score]</td>
	                </tr>
	            ";
	        }
	    echo "</table>";
	}
	//Showing the latest matches. Shown: Sidebar
	public function getLatestMatches()
	{
		global $mysqli;

		//Getting latest matches from our frontend_functions.php
        $query = "SELECT * FROM matches INNER JOIN team ON matches.fk_team_id=team.team_id LIMIT 3";

        $result = $mysqli->query($query);

        echo "
            <div class='well'>
                    <h4>Latest Matches</h4>
                    <div class='input-group'>
                        <ul class='list-unstyled'>
        ";

        while ($row = $result->fetch_assoc())
        {
            echo "<li><a href='teams.php?id=$row[team_id]'>$row[match_team_a]</a> VS $row[match_team_b] - $row[match_score]</li>";
        }

        echo "
	                    </ul>
	                </div>
	            </div>
        ";
	}
}

//Class to include every function for the team system.
class teams
{
	public function getAllTeams()
	{

		global $mysqli;

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];

			$query = "SELECT * FROM team WHERE team_id=$id";

			$result = $mysqli->query($query);

			$row = $result->fetch_assoc();

			echo "<h1><a href='#'>$row[team_name]</a></h1>";
			echo "<hr>";

			echo "
				<!-- Team Headline Picture -->
        	<img src='http://placehold.it/900x150' class='img-responsive'>
			";

			echo "<hr>";
			
			echo "
				<p>
					$row[team_desc]
				</p>
			";
			echo "
				<h3>Members:</h3>
				<ul class='list-unstyled'>
					<li><a href='profile.php?id=1'>TestPerson</a> - Top Laner</li>
				</ul>
			";	
		}
		else
		{

			global $mysqli;

			$query = "SELECT * FROM team ";

			$result = $mysqli->query($query);

			while ($row = $result->fetch_assoc())
			{
				echo "
	                <h1><a href='#'>$row[team_name]</a></h1>

	                <hr>

	                <!-- Team Picture -->
	                <img src='http://placehold.it/900x150' class='img-responsive'>

	                <hr>

	                <p>
	                    $row[team_desc]
	                </p>

	                <a class='btn btn-primary' href='teams.php?id=$row[team_id]'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

	                <hr>

	                <!-- Teams End -->
	                ";
			}
		}
	} 
}

//Our login class for every login function in the system.
class login
{

	public function register()
	{

		global $mysqli;

		echo "

		<form class='form-horizontal' method='POST'>

			<fieldset>

			<!-- Form Name -->

			<legend>Register</legend>

			<!-- Text input-->

			<div class='form-group'>

			  <label class='col-md-4 control-label' for='username'>Username</label>  

			  <div class='col-md-4'>

			  <input id='username' name='username' type='text' placeholder='Username' class='form-control input-md'>

			  </div>

			</div>



			<!-- Text input-->

			<div class='form-group'>

			  <label class='col-md-4 control-label' for='email'>E-Mail</label>  

			  <div class='col-md-4'>

			  <input id='email' name='email' type='text' placeholder='E-Mail' class='form-control input-md'>

			  </div>

			</div>


			<!-- Password input-->

			<div class='form-group'>
			  <label class='col-md-4 control-label' for='password'>Password</label>
			  <div class='col-md-4'>
			    <input id='password' name='password' type='password' placeholder='Password' class='form-control input-md'>
			  </div>
			</div>


			<!-- Button (Double) -->

			<div class='form-group'>

			  <label class='col-md-4 control-label' for='button1id'></label>

			  <div class='col-md-8'>

			    <button id='button1id' name='register' class='btn btn-success' type='submit'>Register</button>

			    <button id='button2id' name='reset' class='btn btn-danger' type='reset'>Clear Fields</button>

			  </div>

			</div>

			</fieldset>

		</form>
		";

		if(isset($_POST['register']))
		{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$error_msg = "";

			if($username == "")
			{	
				$error_msg .= "You need to enter a username.";
			}

			if($email == "")
			{	
				$error_msg .= "You need to to enter a email.";
			}

			if($password == "")
			{	
				$error_msg .= "You need to enter a password.";
			}

			if($error_msg = "")
			{
				$query = "INSERT INTO users (user_username, user_email, user_password)
				VALUES ('$username', '$email', '$password')";

				$mysqli->query($query);

				echo "<div class='alert alert-success'>Congratulations! You Have Successfully Registered! Check your email for confirmation link. Approx 10 minutes</div>";
			}
			else
			{
				echo "<div class='alert alert-danger'>You need to enter the following details $error_msg</div>";
			}

		}
	}

	//If the user logged in, show the user side bar. Shown: All Pages
	public function ifLoggedIn()
	{

		global $mysqli;

		if(isset($_SESSION['loginn']))
        {
            echo "
            <!-- User Settings Class -->
            <div class='well'>
                <h4>User Settings</h4><br />
                <div class='input-group'>
                    <ul class='list-unstyled'>
                        <li>Welcome, <b>$_SESSION[username]</b></li>
                        <li><a href='myprofile.php#edit-profile'>My Profile</a></li>
                        <li><a href='logout.php'>Log Out</a></li>
                        <li>-------</li>
                        ";
                        if($_SESSION['access'] == 1)
                        {
                            echo "<li><a href='admin/index.php' target='_blank'>Admin Panel</a></li>";
                        }
                        elseif($_SESSION['access'] == 2)
                        {
                        	echo "<li><a href=''>Developer Panel</a></li>";
                        }

                        echo "

                    </ul>
                </div>
                <!-- /input-group -->
            </div>
        ";
        }
	}
	//This is the core login function, that requires to use the login system.
	public function loginfunc()
	{

		global $mysqli;

		//Login function
        if(isset($_POST['submit_login']))
        {
            $username = $_POST['username'];

            $password = $_POST['password'];

            //$username = mysqli_real_escape_string(trim($username));

            //$password = mysqli_real_escape_string(trim($password));

            //$encrypt_password = md5($password);

            $query = "SELECT * FROM users
                      WHERE user_username = '$username'

                      AND user_password = '$password'";

            //Running our SQL
            $result = $mysqli->query($query) or die(mysqli_error($con));

            $row = $result->fetch_assoc();
            
            $count = $result->num_rows;

            //If user found, user will be sent to myprofile.php
            if($count == 1)
            {
                    $_SESSION['loginn'] = 1;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['access'] = $row['fk_position_id'];

                    header('location:myprofile.php');

            }
            else
            {
                //If no user found, echo a error message.
                $error = "Username or password incorrect."; 
            }
            echo "
            <div class='alert alert-danger'> <p>$error</p></div>
            ";
        }
	}
}

class userprofile
{
	public function myProfile()
	{
		global $mysqli;
		
		$query = "SELECT * FROM users WHERE user_username = '".$_SESSION['username']."'";
                    
        $result = $mysqli->query($query);
        
        $row = $result->fetch_assoc();
        
        echo "
            Username: $row[user_username]<br />
            E-Mail: $row[user_email]<br />
            Avatar: <img src='http://placehold.it/90x90'>
        ";
	}

	public function editProfile()
	{
		global $mysqli;

        //getting the content for putting in the forms.

        $query = "SELECT * FROM users WHERE user_username = '".$_SESSION['username']."'";
        
        $result = $mysqli->query($query);
        
        $row = $result->fetch_assoc();

        //Making variables empty, to it dosen't show a notice in the formular fields.
        /*
        $user_username = "";
        $user_email = "";
        $user_password = "";
        $user_avatar = "";
        $user_lol_ign = "";
        $user_steam_comid = "";
        $user_twitch_username = "";
        */

        //Making Variables to our rows from the database, to fill the formular fields.
        $user_username = $row['user_username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_avatar = $row['user_avatar'];
        $user_lol_ign = $row['user_lol_ign'];
        $user_steam_comid = $row['user_steam_comid'];
        $user_twitch_username = $row['user_twitch_username'];

        
        ?>
    
    
        <form class="form-horizontal" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Edit Profile</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Username</label>  
              <div class="col-md-4">
              <input id="textinput" name="username" type="text" placeholder="Username" value="<?php echo $user_username ?>" class="form-control input-md">
              <span class="help-block">.</span>  
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">E-Mail</label>  
              <div class="col-md-4">
              <input id="textinput" name="email" type="text" placeholder="E-Mail" value="<?php echo $user_email ?>" class="form-control input-md">
              <span class="help-block">.</span>  
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="passwordinput">Password</label>
              <div class="col-md-4">
                <input id="passwordinput" name="password" type="password" placeholder="Password" class="form-control input-md">
                <span class="help-block">.</span>
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">LoL IGN</label>  
              <div class="col-md-4">
              <input id="textinput" name="lol_ign" type="text" placeholder="LoL IGN" value="<?php echo $user_lol_ign ?>" class="form-control input-md">
              <span class="help-block">.</span>  
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Steam Community ID</label>  
              <div class="col-md-4">
              <input id="textinput" name="steam_id" type="text" placeholder="Steam Community ID" value="<?php echo $user_steam_comid ?>" class="form-control input-md">
              <span class="help-block">.</span>  
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Twitch.TV Username</label>  
              <div class="col-md-4">
              <input id="textinput" name="twitch_username" type="text" placeholder="Twitch.TV Username" value="<?php echo $user_twitch_username ?>" class="form-control input-md">
              <span class="help-block">.</span>  
              </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="button1id">Double Button</label>
              <div class="col-md-8">
                <button id="button1id" name="submit_update" class="btn btn-success" data-loading-text="Loading..." type="submit">Update Profile</button>
                <button id="button2id" name="reset_fields" class="btn btn-danger" type="reset" disabled>Reset All Fields</button>
              </div>
            </div>

            </fieldset>
            </form>

        <?php
        //Updating the values from the form into the database.
        //Checking if submit_update is pressed.
        if(isset($_POST['submit_update']))
        {
            //Getting the values from the input fields.
            $username = $_POST['username'];
            $email = $_POST['email'];
            $twitch_username = $_POST['twitch_username'];
            
            $query = "
            UPDATE users
            SET user_username = '$username',
                user_twitch_username = '$twitch_username',
                user_email = '$email'
            WHERE user_username = '".$_SESSION['username']."'";
            
            $_SESSION['username'] = $_POST['username'];
                
            $result = $mysqli->query($query);
            
            echo "Profile updates successfully";
            
            header('Location: myprofile.php');
        }
	}

	public function twitchStream()
	{

		global $mysqli;

        //getting the content for putting in the forms.

        $query = "SELECT * FROM users WHERE user_username = '".$_SESSION['username']."'";
        
        $result = $mysqli->query($query);
        
        $row = $result->fetch_assoc();
	?>
		<!-- video player -->
        <object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo $row['user_twitch_username'] ?>" bgcolor="#000000">
            <param name="allowFullScreen" value="true" />
            <param name="allowScriptAccess" value="always" />
            <param name="allowNetworking" value="all" />
            <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
            <param name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo $row['user_twitch_username'] ?>&auto_play=true&start_volume=25" />
        </object>
        <a href="http://www.twitch.tv/<?php echo $row['user_twitch_username'] ?>" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from <?php echo $row['user_twitch_username'] ?> on www.twitch.tv</a>

        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <?php echo $row['user_twitch_username'] ?>'s Twitch.TV Chat (Click on it to toggle chat) 
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                <!-- Chat -->
                <iframe frameborder="0" scrolling="no" id="chat_embed" src="http://twitch.tv/chat/embed?channel=<?php echo $row['user_twitch_username'] ?>&popout_chat=true" height="500" width="350"></iframe>
              </div>
            </div>
          </div>
        </div>
    <?php
	}
}



class contact
{
	public function contactForm()
	{

		global $mysqli;

		if(isset($_SESSION['loginn']) == 1)
    	{
    		$query_data = "SELECT * FROM users WHERE user_username = '".$_SESSION['username']."'";

    		$result = $mysqli->query($query_data);

    		$row = $result->fetch_assoc();

    	echo "
        	<form class='form-horizontal' method='POST'>
				<fieldset>

				<!-- Form Name -->
				<legend>Form Name</legend>

				<!-- Text input-->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='name'>Full Name</label>  
				  <div class='col-md-4'>
				  <input id='name' name='name' type='text' value='$row[user_realname]' placeholder='Full Name' class='form-control input-md' required=''>
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='email'>E-Mail</label>  
				  <div class='col-md-4'>
				  <input id='email' name='email' type='text' value='$row[user_email]' class='form-control input-md'>
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='phone'>Phone Number</label>  
				  <div class='col-md-4'>
				  <input id='phone' name='phone' type='text' placeholder='Phone Number' class='form-control input-md'>
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='subject'>Subject</label>  
				  <div class='col-md-4'>
				  <input id='subject' name='subject' type='text' placeholder='Subject' class='form-control input-md'>
				    
				  </div>
				</div>

				<!-- Textarea -->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='message'>Message</label>
				  <div class='col-md-4'>                     
				    <textarea class='form-control' id='message' name='message'>Your Message Here</textarea>
				  </div>
				</div>

				<!-- Button (Double) -->
				<div class='form-group'>
				  <label class='col-md-4 control-label' for='button1id'></label>
				  <div class='col-md-8'>
				    <button id='button1id' name='submit_message' class='btn btn-success' type='submit'>Send Message</button>
				    <button id='button2id' name='reset_message' class='btn btn-danger' type='reset'>Reset All Fields</button>
				  </div>
				</div>

				</fieldset>
			</form>
		";
    	}
    	else
    	{
    		echo "
    			<form class='form-horizontal' method='POST'>
		<fieldset>

		<!-- Form Name -->
		<legend>Form Name</legend>

		<!-- Text input-->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='name'>Full Name</label>  
		  <div class='col-md-4'>
		  <input id='name' name='name' type='text' placeholder='Full Name' class='form-control input-md'>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='email'>E-Mail</label>  
		  <div class='col-md-4'>
		  <input id='email' name='email' type='text' placeholder='E-Mail' class='form-control input-md'>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='phone'>Phone Number</label>  
		  <div class='col-md-4'>
		  <input id='phone' name='phone' type='text' placeholder='Phone Number' class='form-control input-md'>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='subject'>Subject</label>  
		  <div class='col-md-4'>
		  <input id='subject' name='subject' type='text' placeholder='Subject' class='form-control input-md'>
		    
		  </div>
		</div>

		<!-- Textarea -->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='message'>Message</label>
		  <div class='col-md-4'>                     
		    <textarea class='form-control' id='message' name='message' placeholder='Your Message Here'></textarea>
		  </div>
		</div>

		<!-- Button (Double) -->
		<div class='form-group'>
		  <label class='col-md-4 control-label' for='button1id'></label>
		  <div class='col-md-8'>
		    <button id='button1id' name='submit_message' class='btn btn-success' type='submit'>Send Message</button>
		    <button id='button2id' name='reset_message' class='btn btn-danger' type='reset'>Reset All Fields</button>
		  </div>
		</div>

		</fieldset>
		</form>
    		";
    	}

    	if(isset($_POST['submit_message']))
    	{

    		$cm_name = $_POST['name'];
    		//Only Setting the variable $cm_username if there is a session with username available.
			if(isset($_SESSION['username']))
			{
				$cm_username = $_SESSION['username'];
			}
    		$cm_email = $_POST['email'];
    		$cm_subject = $_POST['subject'];
    		$cm_message = $_POST['message'];
    		$cm_status = "Open";

    		$error_msg = "";

    		if($cm_name == "")
    		{
    			$error_msg .= "You need to fill out the name field..<br />";
    		}

    		if($cm_email == "")
    		{
    			$error_msg .= "You need to fill out the email field..<br />";
    		}


    		if($cm_subject == "")
    		{
    			$error_msg .= "You need to fill out the subject field..<br />";
    		}


    		if($cm_message == "")
    		{
    			$error_msg .= "You need to fill out the message field..<br />";
    		}


    		if($error_msg == "")
    		{
    			$query_message = "INSERT INTO contact_message (cm_name, cm_username, cm_email, cm_subject, cm_message, cm_status) VALUES ('$cm_name', '$cm_username', '$cm_email', '$cm_subject', '$cm_message', '$cm_status')";

    			$mysqli->query($query_message);


    			echo "<div class='alert alert-success'>Message recieved, we will reply within 24 Hours.</div>";
    		}
    		else
    		{
    			echo "<div class='alert alert-danger'>Your message was not sent,<br />  $error_msg</div>";
    		}
    	}
	}
}

?>