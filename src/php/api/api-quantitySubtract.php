<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/shoppingcart.php';

$idP = getPost('ProductID');
ShoppingCartDAO::subtraction($idP);