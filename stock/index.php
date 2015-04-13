<?php

require('../model/database_connect.php');
require '../model/money_repository.php';
require('calculate.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'BuyStocks';
}
if ($action == "Buy More Stocks") {
    include "./BuyStocks.php";
}
if ($action == "AddToCart") {

    $stockPrice = $_POST['result'];
    $quantity = $_POST['quantity'];
    $symbol = $_POST['symbolValue'];
    $date = $_POST['date'];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    echo "<br>stock Price for $symbol is: $stockPrice & Quantity is: $quantity<Br>";
    $total = calculateStockPrice($stockPrice, $quantity);
    $addTemp = addToTempStock($uid, $symbol, $stockPrice, $quantity, $total, $date);

    include 'BuyStocks.php';
}
if ($action == "CalculatePrice") {
    $stockPrice = $_POST['result'];
    $quantity = $_POST['quantity'];
    $symbol = $_POST['symbolValue'];
    $totalPrice = calculateStockPrice($stockPrice, $quantity);
    echo "<br>Total Price for $symbol and Quantity:$quantity is=$totalPrice<br>";
    include './BuyStocks.php';
}

if ($action == "GoToCart") {
    include 'cart.php';
}
//update quantity from cart
if ($action == "update") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    $quantity = $_POST['cartQty'];
    $stockSymbol = $_POST['stockSymbol'];
    $stockPrice = $_POST['stockPrice'];
    $date = date('m/d/Y');
    $total = calculateStockPrice($stockPrice, $quantity);
    $addTemp = updateTempStock($uid, $stockSymbol, $stockPrice, $quantity, $total, $date);
    include 'cart.php';
}
if ($action == "checkout") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    $retrieveSubtotal = retrieveSubtotal($uid);

    $totalBalance = checkBalance($uid, $retrieveSubtotal);
    if ($totalBalance < $retrieveSubtotal) {
        echo "<br>ERROR:You dont have sufficient Balance in your account<br>";
        include 'cart.php';
    } else {
        $date = date('m/d/Y');
        $totalBalance = $totalBalance - $retrieveSubtotal;
        $updateMoney = updateMoneyTable($uid, $totalBalance,$retrieveSubtotal,$date);
        include '../users/userProfile.php';
    }
}
if ($action == "Retrieve Stocks") {
    include 'purchasedStocks.php';
}
if ($action == "Start selling Now") {
    include 'SellStocks.php';
}
if ($action == "Sell Quantity") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    $sellquantity = $_POST['sellQty'];
    $stockSymbol = $_POST['stockSymbol'];

    // echo $stockSymbol;
    $stockPrice = $_POST['stockPrice'];
    //echo $stockPrice;
    $date = date('m/d/Y');
    $total = calculateSellPrice($stockPrice, $sellquantity);
    //echo $total;
    //$addTemp = updateTempStock($uid, $stockSymbol, $stockPrice, $quantity, $total,$date);
    // include '../Money/checkBalance.php';
    include 'SellingCart.php';
}
if ($action == "Add To Selling Cart") {
    $stockPrice = $_POST['result'];
    $quantity = $_POST['quantity'];
    $symbol = $_POST['symbolValue'];
    echo 'You entered:' . $symbol;
    $date = $_POST['date'];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    $retrieveStocks = retrieveStockSymbol($uid, $symbol);
    if ($retrieveStocks->rowCount()) {
        while ($r = $retrieveStocks->fetch(PDO::FETCH_OBJ)) {
            echo "<li>Stock Symbol        :" . $r->p_stockSymbol . "</li>";

            $matchFound = "Matches found..You have $symbol in your account";
            $total = calculateStockPrice($stockPrice, $quantity);
            $totalQty = $r->p_quantity;
            $purchasedPrice = $r->p_stockPrice;
            include 'sellingCart.php';
        }
    } else {
        $matchNotFound = "You don't have $symbol in your Account...";
        include 'sellingCart.php';
    }




    // echo "<br>stock Price for $symbol is: $stockPrice & Quantity is: $quantity<Br>";
    //  $addTemp = addToTempStock($uid, $symbol, $stockPrice, $quantity, $total,$date);
    //include 'SellStocks.php';
}
if ($action == "Try Again") {
    include 'sellStocks.php';
}
if ($action == "Sell Now") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }
    $symbol = $_POST['symbol'];
    if (!empty($_POST['totalLoss'])) {
        $totalLoss = $_POST['totalLoss'];
    } else {
        $totalLoss = "NO LOSS";
    }
    if (!empty($_POST['totalProfit'])) {
        $totalProfit = $_POST['totalProfit'];
    } else {
        $totalProfit = "NO PROFIT";
    }
    $sellQuantity = $_POST['sellQuantity'];
    $sellPrice = $_POST['sellPrice'];
    $date = $_POST['date'];
    $newQty = $_POST['newQty'];
    echo 'New qty=' . $newQty;
    $purchasedPrice = $_POST['purchasedPrice'];
    $total = calculateStockPrice($sellPrice, $sellQuantity);
    $addSellingRecord = addSellingRecord($uid, $symbol, $sellPrice, $sellQuantity, $total, $date, $totalProfit, $totalLoss);
    $transaction = "Selling Stocks";
    $type = "--";
    $cardnumber = "--";
    $addBalance = add_balance($total, $uid);
    $updateMoneyRecords = depositing_money($uid, $transaction, $total, $type, $cardnumber, $addBalance, $date);
    if ($newQty > 0) {
        $total = calculateStockPrice($purchasedPrice, $newQty);
        $updatePurchasedRecord = updatePurchasedRecord($uid, $symbol, $newQty, $total);
    } else {
        $updatePurchasedRecord = deletePurchasedRecord($uid, $symbol);
    }

    include '../users/userProfile.php';
}
?>