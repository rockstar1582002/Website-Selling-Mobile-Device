<?php
require_once '../db/dbhelper.php';
require_once('../util/utility.php');
require_once '../modules/productuser.php';
require_once '../modules/brand-product.php';
require_once '../modules/category-product.php';
echo ProductUserUI::renderProduct(ProductUserDAO::getProductType($_GET['classify']));