<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/OrderDetail.php';
require_once '../modules/product.php';

echo (OrderDetailUI::renderWithCondition(
    OrderDetailDAO::statisticAdvanced($_POST['start'], $_POST['end'],
    json_decode($_POST['typeArray']), 
    json_decode($_POST['brandArray']),
    $_POST['keyword'])
));


// echo (json_decode($_POST['typeArray']));
  
