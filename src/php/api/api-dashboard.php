<?php

$array = array();
$array[] = ProductDAO::rowCounting();
$array[] = CategoryDAO::rowCounting();
$array[] = BrandDAO::rowCounting();

