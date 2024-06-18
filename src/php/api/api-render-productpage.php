<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/category-product.php');
require_once('../modules/brand-product.php');
require_once('../modules/product.php');


echo (ProductUI::renderForProductPage(ProductDAO::filterAdvancedForProductPage(explode(',', json_decode($_POST['typeArray'])), 
explode(',', json_decode($_POST['brandArray'])) , $_POST['keyword'], $_POST['from'], $_POST['to']), 
$_POST['page'], 12));
     


?>