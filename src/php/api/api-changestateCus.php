<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/customer.php');

$i = getPost('CustomerID');
CustomerDAO::ChangeState_Customer($i);
