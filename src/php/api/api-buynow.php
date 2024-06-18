<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/payment.php');
require_once '../modules/product.php';

PaymentDAO::clearCookie();
$idP = getPost('ProductID');
setcookie('productIDBuyNow',$idP,time()+3600,'/');    
ProductDAO::AddCart($idP);
// echo $idP;
// echo $_COOKIE['productIDBuyNow'];
header("Refresh:0");
?>