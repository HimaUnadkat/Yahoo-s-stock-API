 <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['status']))
	{
		header("location:signin.php");
	}
}
echo 'User ID:' . $_SESSION['uid'];
echo '<br>';
 $uid=$_SESSION['uid'];
 require_once('calculate.php');
?>
<html>
    <head>
  <title>shadowplay_2</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="../style/style.css" />
  <link rel="stylesheet" type="text/css" href="../style/ownstyles.css" />
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
       
        <h2>List of purchased Stocks</h2>
       
        <form action="index.php" method="post" ><br><Br>
            <input type="submit" name="action" value="Retrieve Stocks" id="retrieve"><br>
            
              </form>
            <?php
           
             $retrieveStocks=retrieveStocks($uid);
             if ($retrieveStocks->rowCount()) {
         
                 while ($r = $retrieveStocks->fetch(PDO::FETCH_OBJ)) {
                     ?>
                     <form action="index.php" method="post">;
                         <?php
                 
                     echo "<li>Stock Symbol        :" . $r->p_stockSymbol . "</li>";
                     echo "<li> Unit Price         :" . $r->p_stockPrice . "</li>";
                     echo "<li>Quantity            :" . $r->p_quantity . "</li>";
                     echo "<li>Total               :" . $r->p_total . "</li>";
                     echo "<li>Purchase Date       :" . $r->p_date . "</li>";
                   
                     
                   // echo "<a href='index.php?p_id=$r->p_id'>Sell this stock</a>";
                     $p_id=$r->p_id;
                    echo "<input type=hidden name=pid value=$p_id>";
                   
                    
                  //  ?>
                  
                    <?php
                  
                     echo '<hr>';
                     
                 }
                 echo "<input type=submit name='action' value='Start selling Now' id='startSellingNow'>"; ?>
                  </form>
        <?php
             }else{
                 echo 'Currently You dont have any stocks in your account';
             }
             
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
