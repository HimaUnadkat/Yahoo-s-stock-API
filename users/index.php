
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../model/database_connect.php');
require('../model/stock_repository.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'signup';
}

if ($action == "SignIn") {
   if (!empty($_POST['userid'])) {
    $userid = $_POST['userid'];
    $valid = FALSE;
} else {
    $useridErr = "Required";
    $valid = true;
}
if (!empty($_POST['loginpassword'])) {
    $loginpassword = $_POST['loginpassword'];
    $valid = FALSE;
} else {
    $loginpasswordErr = "Required";
    $valid = true;
}
    if($valid!=true){
            $query = fetchUser($userid, $loginpassword);
            
          
    }else{
        include 'signin.php';
    }
       

}

if ($action == "signup") {


if (!empty($_POST["fname"])) {
    $fname = $_POST['fname'];
    $valid = false;
} else {

    $fnameErr = "Required";
    $valid = true;
}

if (!empty($_POST['lname'])) {
    $lname = $_POST['lname'];
    $valid = false;
} else {
    
    $lnameErr = "Required";
    $valid = true;
}
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $valid = false;
} else {
   
    $emailErr = "Required";
    $valid = true;
}
if (!empty($_POST['password'])) {
    $password = $_POST['password'];
    $valid = false;
} else {
    $passwordErr = "Required";
   // $valid = true;
}
if (!empty($_POST['cpassword'])) {
    $cpassword = $_POST['cpassword'];
    $valid = FALSE;
} else {
    $cpasswordErr = "Required";
    //$valid = true;
}
if(!empty($_POST['password']) && !empty($_POST['cpassword'])){
if ($_POST['password'] != $_POST['cpassword']) {
    $pwNotMatchErr = "Password doesn't match";
    //$valid = true;
}else{
    $valid=FALSE;
}

}
    if ($valid == "true") {

        include 'signup.php';
         echo "signup action err";
    } else{
    
        $final_price = signup($fname, $lname, $email, $password);  //add_order($size, $pizza, $extra, $quantity,$final_price);
        include 'signin.php';
        echo "signup action success";
    }
}
if($action=="userProfile"){
  // include './userProfile.php';
}
if($action=="Update"){
  
   
  $fname = $_POST['fname'];
  
    $lname = $_POST['lname'];
   
    $email = $_POST['email'];
  
if(empty($fname) || empty($lname)){  //means error...
   
    include 'editProfile.php';
    echo 'Please fill all the fields correctly';
}
else{
    
   
    $res=updateProfile($fname,$lname,$email);
   
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    
     $userid=$_SESSION['userEmail'];
     $loginpassword=$_SESSION['password'];
    fetchUser($userid, $loginpassword);
   // include 'editProfile.php';
   }  
}


?>