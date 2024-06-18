<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/category-product.php');
require_once('../modules/brand-product.php');
require_once('../modules/product.php');

// echo json_decode($_POST['typeArray']);
// echo (ProductUI::renderWithCondition(ProductDAO::filterAdvanced(
//      json_decode($_POST['typeArray']), json_decode($_POST['brandArray']) , $_POST['keyword']), $_POST['page'], 10));
// var_dump($_POST['keyword']);
// var_dump(explode(',', json_decode($_POST['typeArray'])));


echo (ProductUI::renderWithCondition(ProductDAO::filterAdvanced(explode(',', json_decode($_POST['typeArray'])), 
explode(',', json_decode($_POST['brandArray'])) , $_POST['keyword']), $_POST['page'], 10));
     


// echo ProductUI::renderWithCondition(ProductDAO::getProductByCondition($_POST['typeArray']), $_POST['page'], 10);
?>