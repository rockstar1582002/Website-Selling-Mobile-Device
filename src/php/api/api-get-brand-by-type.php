<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/brand-product.php');
require_once('../modules/category-product.php');
require_once('../modules/type-brand.php');
echo TypeBrandUI::render(getPost('typeId'), getPost('status'));
?>