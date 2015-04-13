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

                    <?php
                    echo "Summary...<br>";
                    echo "<br>Stock Symbol :$symbol";




                    if (!empty($matchFound)) {
                        //echo $matchFound;

                        if (empty($quantity)) {
                            echo "<br>Please Enter quantity of $symbol for selling";
                            ?>
                            <form action="index.php" method="post"><br><br>
                                <input type="submit" name="action" value="Try Again">
                            </form>               
                            <?php
                        }
                        if (!empty($quantity)) {
                             $date = date('m/d/Y');
                            if ($quantity > $totalQty) {
                                echo "<div class=\"wrong\">You have only $totalQty stocks of $symbol</div>";
                                ?>
                                <form action="index.php" method="post"><br><br>
                                    <input type="submit" name="action" value="Try Again">
                                </form>               
                                <?php
                            } else {
                              
                   
                                $newQty=$totalQty-$quantity;
                                echo "<br>Total Selling quantity of $symbol is : $quantity";
                                if ($purchasedPrice > $stockPrice) {
                                    $totalLoss = ($purchasedPrice - $stockPrice) * $quantity;
                                    echo "<div class=\"red\">Stock Selling Price:$stockPrice</div>";
                                    echo "Stock Purchase Price:$purchasedPrice";

                                    echo "<div class=\"loss\">Total Loss: $totalLoss$</div>";
                                } else {
                                    $totalProfit = ($stockPrice - $purchasedPrice) * $quantity;
                                    echo "<div class=\"green\">Stock Selling Price:$stockPrice</div>";
                                    echo "Stock Purchase Price:$purchasedPrice";
                                    echo "<div class=\"profit\">Total Profit : $totalProfit$</div>";
                                }
                                 ?>
                     <form method="post" action="index.php">
                    <br><br>
                    <input type="hidden" name="symbol" value="<?php echo $symbol ?>">
                    <input type="hidden" name="totalLoss" value="<?php if(isset($totalLoss)) echo $totalLoss; ?>">
                    <input type="hidden" name="totalProfit" value="<?php if(isset($totalProfit)) echo $totalProfit; ?>">
                     <input type="hidden" name="sellQuantity" value="<?php echo $quantity ?>">
                     <input type="hidden" name="sellPrice" value="<?php echo $stockPrice ?>">
                     <input type="hidden" name="date" value="<?php echo $date; ?>">
                     <input type="hidden" name="newQty" value="<?php echo $newQty; ?>">
                     <input type="hidden" name="purchasedPrice" value="<?php echo $purchasedPrice; ?>">
                        <input type="submit" name="action" value="Sell Now">
                    </form>
                    <?php
                            }
                        }
                        
                       
                    }
                    if (!empty($matchNotFound)) {
                        echo $matchNotFound;
                        ?>
                        <form method="post" action="index.php">
                            <br><br><br>
                            <input type=submit name=action value='Try Again'>
                        </form>
                        <?php
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
