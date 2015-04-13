
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
//echo "Welcome ".$_SESSION['fname'];
?>
<html>
   <head>
  <title>shadowplay_2</title>
  <style>
      input#checkout,#BuyMore{
      background-color:#FF9980;
border-radius:5px;
border:none;
padding:10px 25px;
color:#FFF;
text-shadow:1px 1px 1px #949494;


}
  </style>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
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
      <div class="sidebar">
       <?php include '../includes/sidebar.inc.php';
         ?>
      </div>
      <div id="content">
       
        <form method="post" action="index.php">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
            }
            $retrieveTempStock = retrieveTempStock($uid);
           $retrieveSubtotal=  retrieveSubtotal($uid);
          //  echo "<br>Subtotal is: $retrieveSubtotal<br>";
            if ($retrieveTempStock->rowCount()) {
                echo "
           <table border='1' width=100%>
<tr>
<th>Symbol</th>
<th>StockPrice</th>
<th>Quantity</th>
<th>total</th>

</tr>";
                while ($r = $retrieveTempStock->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>";
                    echo "<td >" . $r->temp_stockSymbol . "</td>";
                    echo "<td >" . $r->temp_stockPrice . "</td>";
                    ?>
                    <form method="post" action="index.php">
                        <?php
                        echo "<td height='50'  ><input type='text' name='cartQty' value='$r->temp_quantity'>";


                        echo"<input type='submit' name='action' value='update'></td>   ";
                        ?>
                        <input type="hidden" name="stockSymbol" value="<?php echo $r->temp_stockSymbol; ?>">
                        <input type="hidden" name="stockPrice" value="<?php echo $r->temp_stockPrice; ?>">
                    </form>
                    <?php
                    echo "<td>" . $r->temp_total . "</td>";
                    echo "</tr>";
                }
                 echo "<td colspan='3'>Subtotal</td>";
                 
                 echo "<td> $retrieveSubtotal</td>";
                echo "</table>";
            } else {
                echo 'Cart is currently Empty';
            }
            ?>
            <br><br><br> <input type="submit" name="action" value="Buy More Stocks" id="BuyMore">
            <input type="submit" name="action" value="checkout" id="checkout">
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
