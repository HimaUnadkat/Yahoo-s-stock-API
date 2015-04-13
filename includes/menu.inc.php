<?php


		if(!isset($_SESSION['status']))
		{
			echo '  <li class="selected"><a href="signin.php">Sign In</a></li>';
		}
		if(!isset($_SESSION['status']))
		{
			echo '  <li><a href="signup.php">Sign Up</a></li> ';
		}
		
                if(isset($_SESSION['status']))
		{
			echo ' <li><a href="../users/userProfile.php">User Profile</a></li>';
		}
                  if(isset($_SESSION['status']))
		{
			echo ' <li> <a href="editProfile.php">Update Profile</a></li>';
		}
               if(isset($_SESSION['status']))
		{
			echo ' <li>  <a href="../Money/checkBalance.php">Your Balance</a></li>';
		}
                if(isset($_SESSION['status']))
		{
			echo '<li><a href="../logout/logout.php">Log Out</a></li>';
		}
       
		
	
?>
