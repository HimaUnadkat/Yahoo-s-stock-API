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
     
      <div id="content">
        <form method="post" action="index.php">
            First Name<br> <input type="text" name="fname"  value="<?php if (isset($fname)) {
    echo $fname;
} ?>">
            <span class="error" >* <?php
                if (isset($fnameErr)) {
                    echo $fnameErr;
                }
                ?>   </span>
            <br>
            Last Name<br> <input type="text" name="lname" value="<?php if (isset($lname)) {
                    echo $lname;
                } ?>">
            <span class="error" >* <?php
                if (isset($lnameErr)) {
                    echo $lnameErr;
                }
                ?>   </span><br>
            Email <br><input type="text" name="email" value="<?php if (isset($email)) {
                    echo $email;
                } ?>">
            <span class="error" >* <?php
                if (isset($emailErr)) {
                    echo $emailErr;
                }
                ?>   </span>
            <br>
            Password<br> <input type="password" name="password">
            <span class="error" >* <?php
                if (isset($passwordErr)) {
                    echo $passwordErr;
                }
                ?>   </span><br>
            Confirm Password <br><input type="password" name="cpassword">
            <span class="error" >* <?php
                if (isset($cpasswordErr)) {
                    echo $cpasswordErr;
                }
                if (isset($pwNotMatchErr)) {
                    echo $pwNotMatchErr;
                }
                ?>   </span><br><br>
                <input type="submit" value="signup" name="action" id="signup">
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
