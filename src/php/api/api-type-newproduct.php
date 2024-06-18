<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/category-product.php');

echo CategoryUI::renderFormatSelection(CategoryDAO::getData());
?>