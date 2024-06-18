<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/order.php';

OrderDao::confirmOrder($_POST['productId']);


