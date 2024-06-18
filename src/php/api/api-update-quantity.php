<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/product.php');

ProductDAO::updateQuantity(json_decode($_POST['idProductArr']), json_decode($_POST['qtyArr']));
echo 1;
