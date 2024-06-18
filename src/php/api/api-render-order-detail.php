<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/product.php');
require_once('../modules/OrderDetail.php');
require_once('../modules/brand-product.php');
require_once('../modules/category-product.php');


echo OrderDetailUI::renderOrderDetails(OrderDetailDAO::getOrderDetail($_POST['productId']));

?>