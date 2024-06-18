<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/brand-product.php');

$position = getGet('position');
if ($position) {
        echo BrandUI::render($position);
}
