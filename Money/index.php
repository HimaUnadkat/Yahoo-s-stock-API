<?php

require_once('validate.php');
require_once('../model/database_connect.php');
require_once('../model/money_repository.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'checkBalance';
}




if ($action == "Continue") { //checkout action
    //echo "Actino=$action";
    $date=$_POST['date'];
    $transaction=$_POST['transaction'];
    if (empty($_POST['amount'])) {
        $amountErr = "Please select amount";
        $valid = true;
    } else {
        $amount = $_POST['amount'];
        $valid = FALSE;
    }
    if (empty($_POST['type'])) {
        $typeErr = "Please select the type of credit";
        $valid = true;
    } else {
        $type = $_POST['type'];
        // echo "TYPE=$type";
        if ($type == "ax") {   //american Express
            if (empty($_POST['cardnumber'])) {
                $cardnumErr = "Required";
                $valid = true;
            } else {
                $cardnumber = $_POST['cardnumber'];
                $cardnumber = checkCardNumber($cardnumber);
                if ($cardnumber != FALSE) {
                    //  echo $cardnumber;
                    //   $valid=FALSE;
                } else {
                    echo $cardnumErr = "Invalid Americal Express Card Number";
                    $valid = true;
                }
            }
        }
        if ($type == "v") {
            if (empty($_POST['cardnumber'])) {
                $cardnumErr = "Required";
                $valid = true;
            } else {
                $cardnumber = $_POST['cardnumber'];
                $cardnumber = checkVisaCardNumber($cardnumber);
                if ($cardnumber != false) {
                    //  echo $cardnumber;
                    //  $valid=FALSE;
                } else {
                    echo $cardnumErr = "Invalid Visa Card Number";
                    $valid = true;
                }
            }
        }
    }
    if ($_POST['expireMM'] == "Month" || $_POST['expireYY'] == "Year") {
        $monthyearErr = "Required";
        $valid = true;
    } else {
        $expireMM = $_POST['expireMM'];
        $expireYY = $_POST['expireYY'];
        $currentMonth = date("m");
        $currentYear = date("Y");


        $input_time = mktime(0, 0, 0, $_POST['expireMM'] + 1, 0, $_POST['expireYY']);

        if ($input_time < time()) {
            $monthErr = "Date has elapsed";
            $valid = true;
        }
    }


    if ($valid == "true") {
        
        include  'depositMoney.php';
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $uid = $_SESSION['uid'];
       
        $addBalance = add_balance($amount, $uid);
        echo '<br>Available Balance is : ' . $addBalance . "<br>";
         
        $id = depositing_money($uid,$transaction, $amount, $type, $cardnumber, $addBalance,$date );
      // echo $id;
        include 'checkBalance.php';
    }
}
if ($action == "Withdraw") {
      
     $transaction=$_POST['transaction'];
     
    
    if (empty($_POST['withdrawAmt'])) {
        $withdrawAmtErr = "Please Enter amount to withdraw";
        $valid = true;
    } else {
        $withdrawAmt = $_POST['withdrawAmt'];
        $valid = FALSE;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $uid = $_SESSION['uid'];
        $getBalance = getCurrentBalance($uid);
        // echo '<br>Availale Balance='.$getBalance."<br>";

        if ($getBalance < $withdrawAmt) {
            $lessAmtErr = "You don't have $withdrawAmt$ in your Account";
            include 'withdrawMoney.php';
        } else if ($withdrawAmt <= 0) {
            $negativeAmtErr = "You can't withdraw $withdrawAmt";
            include 'withdrawMoney.php';
        } else {
             $withdrawdate=$_POST['withdrawdate'];
            $amt = withdrawAmt($uid, $getBalance, $withdrawAmt,$transaction,$withdrawdate);
            // echo '<br><br>Current Balance in Withdraw action'.$getBalance;
            include 'withdrawMoney.php';
        }
    }
}
?>