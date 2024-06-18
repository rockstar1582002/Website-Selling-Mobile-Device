<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/customer.php');

$i = getPost('CustomerID');
// CustomerDAO::Del_Customer($i);
if(CustomerDAO::checkCustomerActive($i)==true){
    echo"Thất bại !";
}else{
    CustomerDAO::Del_Customer($i);
    echo"Thành công !";
}