
<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['status']))
	{
		header("location:signin.php");
	}
}
 echo "Current User ID : ".$_SESSION['uid']."<br>";
 
// echo "Your Current Balance is: ".$get_currentBal."<br>";
 
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>shadowplay_2</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
   <link rel="stylesheet" type="text/css" href="../style/ownstyles.css" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
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
          <?php
           if(isset($monthErr) || isset($amountErr) || isset($typeErr) || isset($cardnumErr)){ ?>
           <div class="alert-box error"><span>error: </span>Please check below fields</div>
      <?php } ?><br><br>
         <form method="post" action="index.php">
            Choose Deposit Amount:
            <span class="error" >* <?php if (isset($amountErr)) {
    echo $amountErr;
    } ?>   </span><br>
            <input type="radio" name="amount" value="50" <?php if(isset($_POST['amount']) && $_POST['amount'] == '50') echo ' checked="checked"'?>>50$<br> 
            <input type="radio" name="amount" value="100" <?php if(isset($_POST['amount']) && $_POST['amount'] == '100') echo ' checked="checked"'?>>100$<br>  
            <input type="radio" name="amount" value="300" <?php if(isset($_POST['amount']) && $_POST['amount'] == '300') echo ' checked="checked"'?>>300$<br> 
            <input type="radio" name="amount" value="500" <?php if(isset($_POST['amount']) && $_POST['amount'] == '500') echo ' checked="checked"'?>>500$<br>
            <input type="radio" name="amount" value="1000" <?php if(isset($_POST['amount']) && $_POST['amount'] == '1000') echo ' checked="checked"'?>>1000$<br> 
            <input type="radio" name="amount" value="2000" <?php if(isset($_POST['amount']) && $_POST['amount'] == '2000') echo ' checked="checked"'?>>2000$<br> 
                 Choose Payment Method:
                 <span class="error" >* <?php if (isset($typeErr)) {
    echo $typeErr;
    } ?>   </span><br>
                  
                 <input type="radio" name="type" value="v" <?php if(isset($_POST['type']) && $_POST['type'] == 'v') echo ' checked="checked"'?>>Visa  
                 <input type="radio" name="type" value="ax" <?php if(isset($_POST['type']) && $_POST['type'] == 'ax') echo ' checked="checked"'?>>American Express<br>
                 <img src="../images/visa.png"><img src="../images/amex.png">
                  <br> 
                  <label>Card Number</label>
                   
                  
                  <input type="text" name="cardnumber" value="<?php if(isset($cardnumber)){echo $cardnumber;}?>">
               <span class="error" >* <?php if (isset($cardnumErr)) {
    echo $cardnumErr;
} ?>   </span>
                  <br>
                  <label>expiration date</label><br><select name='expireMM' id='expireMM'>
    <option value=''>Month</option>
    <option value='01'>Janaury</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
</select> 
<select name='expireYY' id='expireYY'>
    <option value=''>Year</option>
    <option value='2014'>2014</option>
    <option value='2015'>2015</option>
    <option value='2016'>2016</option>
</select> 
                  <span class="error" >* <?php if (isset($monthErr)) {
    echo $monthErr;
    } ?>   </span><br><br>
    <?php
       $date = date('m/d/Y');
      
       ?>
     <input type="hidden" name="date" value="<?php echo $date; ?>">
     <input type="hidden" name="transaction" value="deposit">
     
     <input type="submit" name="action" value="Continue" id="Continue">
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
