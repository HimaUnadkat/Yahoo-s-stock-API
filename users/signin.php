<!DOCTYPE HTML>
<html>

<head>
  <title>shadowplay_2</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
   <link rel="stylesheet" type="text/css" href="../style/ownstyles.css" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
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
      
      <div id="content">
        <form method="post" action="index.php">
            <span class="error" >* <?php
                if (isset($notExists)) {
                    echo $notExists;
                }
                ?>   </span><br><br>
            User ID<br>
            <input type="text" name="userid" value="<?php if (isset($userid)) {
    echo $userid;
} ?>">
             <span class="error" >* <?php
                if (isset($useridErr)) {
                    echo $useridErr;
                }
                ?>   </span><br>
            Password<br>
            <input type="password" name="loginpassword">
             <span class="error" >* <?php
                if (isset($loginpasswordErr)) {
                    echo $loginpasswordErr;
                }
                ?>   </span><br><br>
                <input type="submit" name="action" value="SignIn" id="SignIn">
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
