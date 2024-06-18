<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/payment.php');

// $phone = getPost('Phone');

// $address = getPost('Address');

// $name = getPost('Name');
$arr = explode(",",getPost('Customer'));
echo $arr[0];
echo $arr[1];
echo $arr[2];
PaymentDAO::changeAddress($arr[0],$arr[1],$arr[2]);
header("Refresh:0");
