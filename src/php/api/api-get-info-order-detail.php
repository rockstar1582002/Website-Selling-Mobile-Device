<?php
    require_once('../db/dbhelper.php');
    require_once('../util/utility.php');
    require_once('../modules/order.php');
    require_once('../modules/customer.php');
    require_once('../modules/address.php');

    echo (OrderUI::getInfoOrder(OrderDAO::getOrderById($_POST['productId'])));

?>