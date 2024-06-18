<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/category-product.php');

$position = getGet('position');
if ($position) {
        echo CategoryUI::render($position);
}
