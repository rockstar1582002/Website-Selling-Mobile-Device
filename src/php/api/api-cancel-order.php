<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/order.php';

OrderDao::cancelOrder($_POST['productId']);


