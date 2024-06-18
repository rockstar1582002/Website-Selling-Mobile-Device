<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/type-brand.php';
require_once '../modules/brand-product.php';

echo TypeBrandUI::renderCheckbox($_GET['category']);