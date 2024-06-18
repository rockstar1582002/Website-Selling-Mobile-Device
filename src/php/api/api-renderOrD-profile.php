<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/customerprofile.php';

$idOrder = getPost('productId');

ProfileDAO::RenderOrderDetail($idOrder);