
<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['status']))
	{
		header("location:signin.php");
	}
}
 echo $_SESSION['uid'];
 
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
          <?php
       echo "Welcome ".$_SESSION['fname']; 
       ?>
       
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
