<?php

function signup($fname, $lname, $email, $password) {
    global $dbstock;
    $query = "INSERT INTO users
        (ufname, ulname, uemail, upassword)
        VALUES
        ('$fname', '$lname', '$email', '$password')";
    //var_dump($query);
    $dbstock->exec($query);
   
    
    $id = $dbstock->lastInsertId();
     print $id;
     $query2 = "INSERT INTO money
        (m_uid, m_amount,m_creditcardtype, m_creditcardno,m_totalBalance)
        VALUES
        ('$id', 0, '', '',0)";
    //var_dump($query);
    $dbstock->exec($query2);
   
    return $id;
}

function fetchUser($userid, $loginpassword) {
   // echo "inside fetch user function";
    global $dbstock;
    $query = "select * from users where uemail='$userid' AND upassword='$loginpassword'";
    // return $sql;
    $stmt = $dbstock->query($query);
    $row = $stmt->fetchObject();
    $result = $stmt->rowCount();
    if ($result != 0) {
        // echo 'user exists';
      //  session_start();
         if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
        $_SESSION = array();
        $_SESSION['uid'] = $row->uid;
        $_SESSION['userEmail'] = $row->uemail;
        $_SESSION['fname'] = $row->ufname;
        $_SESSION['lname'] = $row->ulname;

        $_SESSION['password'] = $row->upassword;
        echo "<br>Current Session ID is: " . $_SESSION["uid"];
        $_SESSION['status'] = true;
        include './userProfile.php';
    } else {
        echo "User doesn't exists!!";
        
        
    }
}
function updateProfile($fname,$lname,$email){
     global $dbstock;
    $query1 = "UPDATE  users
        set ufname= '$fname',"
            . "ulname='$lname' where uemail='$email'";
   // var_dump($query1);
    $dbstock->exec($query1);
}

?>