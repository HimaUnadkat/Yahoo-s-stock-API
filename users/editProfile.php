<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
if(!isset($_SESSION['status']))
	{
		header("location:signin.php");
	}
}
echo "<br>EditProfile.php<br>";
 echo "Current User Id: ".$_SESSION['uid']."<br>";
 
 echo '<br>';
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>shadowplay_2</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
   <link rel="stylesheet" type="text/css" href="../style/ownstyles.css" />
  <link rel="stylesheet" type="text/css" href="../style/style.css" />
  <link rel="stylesheet" href="../style/box.css">
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
      
          e.style.display = 'block';
    }
//-->
</script>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
         <?php include '../includes/logo.inc.php';
         ?>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
            <?php include '../includes/menu.inc.php';
         ?>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div class="sidebar">
       <?php include '../includes/sidebar.inc.php';
         ?>
      </div>
      <div id="content">
        <form method="post" action="index.php">
        First Name<br> <input type="text" name="fname"  value="<?php echo $_SESSION['fname'];
?>">
            <span class="error" >* <?php
                if (isset($fnameErr)) {
                    echo $fnameErr;
                }
                ?>   </span>
            <br>
            Last Name<br> <input type="text" name="lname" value="<?php echo $_SESSION['lname']; ?>">
            <span class="error" >* <?php
                if (isset($lnameErr)) {
                    echo $lnameErr;
                }
                ?>   </span><br>
                Email <br><input type="text" readonly="readonly" name="email" value="<?php echo $_SESSION['userEmail'];
?>">
            
            <br><br>
            <input type="submit" name="action" value="Update" id="Update" onclick="toggle_visibility('foo');">
            <div class="alert-box success"  id="foo" style="display: none;"><span>success: </span>Write your success message here.</div>
        </form>
           </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      <?php include '../includes/footer.inc.php';
         ?>
    </div>
  </div>
</body>
</html>
