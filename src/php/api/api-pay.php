<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/payment.php');

if(PaymentDAO::AlertQuantity()!=''){
    $arr = explode(",",PaymentDAO::AlertQuantity());
    echo 'Sản phẩm: '.$arr[0].'';
    echo '    Chỉ còn: '.$arr[1].'  (Sản phẩm)';
    // echo PaymentDAO::AlertQuantity();
    // echo 'Thất bại';
}
else {
    PaymentDAO::pay();
    echo 'Thành công';
}
// header("Refresh:0");
?>