<?php

function calculateStockPrice($stockPrice, $quantity) {
    $total = $stockPrice * $quantity;

    return $total;
}

function calculateSellPrice($stockPrice, $sellquantity) {

    $total = $stockPrice * $sellquantity;


    return $total;
}

function addToTempStock($uid, $symbol, $stockPrice, $quantity, $total, $date) {
    // echo '<br>calculate.php date='.$date.'<br>';
    global $dbstock;
    $query = ("select * from tempStock where temp_uid='$uid' and temp_stockSymbol='$symbol'");
    // echo "<br>------------select query---------------<br>";
    //var_dump($query);
    $stmt = $dbstock->query($query);
    $row = $stmt->fetchObject();
    $result = $stmt->rowCount();
    if ($result == 1) {
        $stockquantity = $row->temp_quantity;
        echo '<br>Quantity in database is:' . $stockquantity . '<br>';



        $newQty = $stockquantity + $quantity;
        $newPrice = calculateStockPrice($stockPrice, $newQty);
        $query1 = "UPDATE  tempStock
        set temp_quantity= '$newQty' ,temp_total='$newPrice' where temp_uid='$uid' and temp_stockSymbol='$symbol'";
        $dbstock->exec($query1);
        // echo "<br>------------update query---------------<br>";
        //var_dump($query1);
    } else {

        $query2 = "INSERT INTO tempStock
        (temp_uid, temp_stockSymbol, temp_stockPrice, temp_quantity,temp_total,temp_date)
        VALUES
        ('$uid','$symbol','$stockPrice','$quantity','$total',STR_TO_DATE('$date', '%m/%d/%Y'))";
        //var_dump($query2);
        $dbstock->exec($query2);
        //  echo "<br>------------INsert query---------------<br>";
        //        var_dump($query2);
    }
}

function retrieveTempStock($uid) {
    global $dbstock;
    $query = $dbstock->query("select * from tempStock where temp_uid='$uid'");
    return $query;
}

function retrieveSubtotal($uid) {
    global $dbstock;
    $query1 = "select sum(temp_total) as value_sum from tempStock where temp_uid='$uid'";
    $stmt = $dbstock->query($query1);
    $row = $stmt->fetchObject();
    $Subtotal = $row->value_sum;


    return $Subtotal;
}

function retrieveSellingSubtotal($uid) {
    global $dbstock;
    $query1 = "select SUM(p_total) as value_sum from purchaseStock where p_uid='$uid'";
    $stmt = $dbstock->query($query1);
    $row = $stmt->fetchObject();
    $Subtotal = $row->value_sum;


    return $Subtotal;
}

function updateTempStock($uid, $stockSymbol, $stockPrice, $quantity, $total, $date) {
    global $dbstock;
    $query1 = "UPDATE  tempStock
        set temp_quantity= '$quantity' ,temp_total='$total' where temp_uid='$uid' and temp_stockSymbol='$stockSymbol'";
    $dbstock->exec($query1);
}

function checkBalance($uid) {
    global $dbstock;
    $sql = "SELECT * FROM money where m_uid='$uid' ORDER BY m_id DESC LIMIT 1";

    $stmt = $dbstock->query($sql);
    $row = $stmt->fetchObject();
    $totalBalance = $row->m_totalBalance;
    return $totalBalance;
}

function updateMoneyTable($uid, $totalBalance,$retrieveSubtotal,$date) {
    global $dbstock;
    /*$query1 = "UPDATE money
        set m_totalBalance= '$totalBalance' where m_uid='$uid' ORDER BY m_id DESC LIMIT 1";
    $dbstock->exec($query1);*/
    $query2 = "INSERT INTO money
        (m_uid, m_transaction,m_amount,m_creditcardtype, m_creditcardno,m_totalBalance,m_Date)
        VALUES
        ('$uid','Buying Stocks','$retrieveSubtotal','','','$totalBalance',STR_TO_DATE('$date', '%m/%d/%Y'))";
        //var_dump($query2);
        $dbstock->exec($query2);
    PurchaseStock($uid);
}

function PurchaseStock($uid) {
    global $dbstock;
    $query = "INSERT INTO purchaseStock ( 
     p_uid , 
      p_stockSymbol, 
     p_stockPrice , 
      p_quantity,
      p_total,
      p_date) 
SELECT temp_uid, 
       temp_stockSymbol, 
       temp_stockPrice,
       temp_quantity,
       temp_total,
       temp_date
       
FROM tempStock
where temp_uid='$uid'";
    $dbstock->exec($query);
    //    echo "<br>------------INsert query---------------<br>";
    //   var_dump($query);
    $query2 = "Delete from tempStock where temp_uid='$uid'";
    $dbstock->exec($query2);
}

function retrieveStocks($uid) {
    global $dbstock;
    $query = $dbstock->query("select * from purchaseStock where p_uid='$uid'");
    return $query;
}

function retrieveSellingStock($uid) {
    global $dbstock;
    $query = $dbstock->query("select * from purchaseStock where p_uid='$uid'");
    return $query;
}

function retrieveStockSymbol($uid, $symbol) {
    global $dbstock;
    $query = $dbstock->query("select * from purchaseStock where p_uid='$uid' and p_stockSymbol='$symbol'");
    return $query;
}

function addSellingRecord($uid, $symbol, $sellPrice, $sellQuantity, $total, $date, $totalProfit, $totalLoss) {
    global $dbstock;
    $query2 = "INSERT INTO sellRecords
        (s_uid, s_stockSymbol, s_stockSellPrice, s_quantity,s_totalSell,s_date,s_profit,s_loss)
        VALUES
        ('$uid','$symbol','$sellPrice','$sellQuantity','$total',STR_TO_DATE('$date', '%m/%d/%Y'),'$totalProfit','$totalLoss')";
    
    $dbstock->exec($query2);
}

function updatePurchasedRecord($uid, $symbol, $newQty, $total) {
    global $dbstock;
    $query1 = "UPDATE  purchaseStock
        set p_quantity= '$newQty' ,p_total='$total' where p_uid='$uid' and p_stockSymbol='$symbol'";
   
    $dbstock->exec($query1);
}

function deletePurchasedRecord($uid, $symbol) {
    global $dbstock;
    $query1 = "DELETE from purchaseStock where p_uid='$uid' and p_stockSymbol='$symbol'";
   
    $dbstock->exec($query1);
}

?>