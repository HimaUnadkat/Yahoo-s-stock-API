
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
        <meta name="description" content="website description" />
        <meta name="keywords" content="website keywords, website keywords" />
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
         <link rel="stylesheet" type="text/css" href="../style/ownstyles.css" />
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
         <script type="text/javascript" src="//code.jquery.com/jquery-2.0.2.js"></script>
        <script type="text/javascript">
            function getData() {
                //  alert("INside getdata");
                var url = "http://query.yahooapis.com/v1/public/yql";
                var symbol = $("#symbol").val();

                var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in ('" + symbol + "')");

                $.getJSON(url, 'q=' + data + "&format=json&diagnostics=true&env=http://datatables.org/alltables.env")
                        .done(function(data) {
                            $("#result").text("Bid Price: " + data.query.results.quote.LastTradePriceOnly);
                            $('#result').val(data.query.results.quote.LastTradePriceOnly);
                            $('#symbolValue').val(symbol);
                            $('#symbol').val(symbol);
                        })
                        .fail(function(jqxhr, textStatus, error) {
                            var err = textStatus + ", " + error;
                            $("#result").text('Request failed: ' + err);
                        });
            }
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
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['uid'])) {
                            $uid = $_SESSION['uid'];
                        }
                        //$pid=$_POST['p_id'];
                        $retrieveSellingStock = retrieveSellingStock($uid);
                        $retrieveSubtotal = retrieveSellingSubtotal($uid);
                        //  echo "<br>Subtotal is: $retrieveSubtotal<br>";
                        if ($retrieveSellingStock->rowCount()) {
                            echo "
           <table border='1' width=100%>
<tr>
<th>Symbol</th>
<th>StockPrice</th>
<th>Quantity</th>

<th>total</th>

</tr>";
                            while ($r = $retrieveSellingStock->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td >" . $r->p_stockSymbol . "</td>";
                                echo "<td >" . $r->p_stockPrice . "</td>";

                                echo "<td >" . $r->p_quantity . "</td>";
                                ?>
                               


                           
                            <?php
                            echo "<td>" . $r->p_total . "</td>";
                            echo "</tr>";
                            ?>
                              
                        
                                <?php
                        }
                        echo "<td colspan='3'>Subtotal</td>";

                        echo "<td> $retrieveSubtotal</td>";
                        echo "</table>";
                    } else {
                        echo 'Cart is currently Empty';
                    }
                    ?>
                    <br><br><br> 
                    Enter Stock Symbol you want to sell:  <br>
                    <input type="text" id="symbol" name="symbol"/>
                    <button type="submit" onClick="getData();" id="fetch">Fetch Data</button>

        <br><br>
                  <form method="post" action="index.php">
                       <?php
            $date = date('m/d/Y');
            //echo $date;
            ?>
                      Result<br><input type="text" name="result" id="result" value="<?php if (isset($stockPrice)) echo $stockPrice; ?>"> 
            <input type="hidden" name="symbolValue" id="symbolValue" value="<?php if (isset($symbol)) echo $symbol; ?>">
           
            <br>Enter Quantity<br>
            <input type="text" name="quantity" value="<?php if (isset($quantity)) echo $quantity; ?>">
            <input type="hidden" name="date" value="<?php echo $date; ?>">
            <!--<input type="submit" name="action" value="Calculate Selling Price">-->
            <br><br>
            <input type="submit" name="action" value="Add To Selling Cart" id="sellingCart">
               
                       
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
