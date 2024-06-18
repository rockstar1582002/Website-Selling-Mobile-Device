<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/category-product.php');
require_once('../modules/product.php');

echo ProductDAO::rowCountingWithConditionProductPage(json_decode($_POST['typeArray']),
json_decode($_POST['brandArray']) , $_POST['keyword'], $_POST['from'], $_POST['to']);

?>