<?php
function checkCardNumber($cardnumber){
    //Prefix=34 or 37, Length=15 (Mod10) for american Express
    if(preg_match("/^(3[47][0-9]{13})*$/", $cardnumber)){
        return $cardnumber;
    }else{
        return false;
    }
}
function checkVisaCardNumber($cardnumber){
      
    if(preg_match("/^(4[0-9]{12}(?:[0-9]{3})?)*$/", $cardnumber)){
        return $cardnumber;
    }else{
        return false;
    }
}
?>