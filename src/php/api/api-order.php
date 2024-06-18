<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/product.php');
require_once('../modules/order.php');

echo ProductUI::renderWithCondition(OrderDAO::getData($_POST['currState'], $_POST['keyword']),
$_POST['page'], 10, $_POST['currState']);
?>
