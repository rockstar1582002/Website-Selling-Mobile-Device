<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/payment.php');

// $idP = getPost('ProductID');
setcookie('productIDBuyNow','',time()-4800,'/');
$idP = explode(",",getPost('ProductID'));

foreach ($idP as $arr){
    setcookie('productIDArray['.$arr.']',$arr,time()+3600,'/');
}
header("Refresh:0");
?>