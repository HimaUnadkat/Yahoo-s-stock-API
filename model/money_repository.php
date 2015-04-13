
<?php

if(!function_exists('depositing_money'))
{
function depositing_money($uid, $transaction,$amount, $type, $cardnumber, $addBalance,$date) {
    
    global $dbstock;
 
    $query2 = "INSERT INTO money
        (m_uid, m_transaction,m_amount,m_creditcardtype, m_creditcardno,m_totalBalance,m_Date)
        VALUES
        ('$uid','$transaction','$amount','$type','$cardnumber','$addBalance',STR_TO_DATE('$date', '%m/%d/%Y'))";
    
    $dbstock->exec($query2);
            
}}

?>
<?php
if(!function_exists('add_balance'))
{
function add_balance($amount, $uid) {
    global $dbstock;

    $query = "select * from money where m_uid='$uid'";
      $stmt = $dbstock->query($query);
    $row = $stmt->fetchObject();
    $result = $stmt->rowCount();


    if ($result >0){
        $balance= getCurrentBalance($uid);
  //  $balance = $row->m_totalBalance;
        
    }else{
        $balance=0;
    }
    
    if ($balance == 0) {
        $add_balance = 0 + $amount;
        echo "<br>New amount is: $balance + $amount= $add_balance<br>";
        return $add_balance;
    } else {
        $add_balance = $balance + $amount;
        echo "<br>New amount is: $balance + $amount= $add_balance<br>";
        return $add_balance;
    }
}}
if(!function_exists('getCurrentBalance'))
{
function getCurrentBalance($uid){
    global $dbstock;
   $query=" SELECT * FROM money where m_uid='$uid' ORDER BY m_id DESC LIMIT 1";
    $stmt = $dbstock->query($query);
    $row = $stmt->fetchObject();
    $result = $stmt->rowCount();
    $balance = $row->m_totalBalance;
   echo '<br>Availale Balance='.$balance."<br>";
    
    return $balance;
    
}
}
if(!function_exists('withdrawAmt'))
{
function withdrawAmt($uid, $getBalance, $withdrawAmt,$transaction,$withdrawdate){
    global $dbstock;
    $finalAmt=$getBalance-$withdrawAmt;
    
   $query1="INSERT INTO money
        (m_uid, m_transaction,m_amount,m_creditcardtype, m_creditcardno,m_totalBalance,m_Date)
        VALUES
        ('$uid','$transaction','$withdrawAmt','','','$finalAmt',STR_TO_DATE('$withdrawdate', '%m/%d/%Y'))";
    
    //var_dump($query1);
    $dbstock->exec($query1);
    $getBalance=getCurrentBalance($uid);
        echo '<br>Availale Balance='.$getBalance."<br>";
}
    
}
?>
