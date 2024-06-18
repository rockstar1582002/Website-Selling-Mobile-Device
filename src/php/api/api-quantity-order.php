<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/order.php');

echo OrderDAO::rowCountingWithCondition($_POST['currState'], $_POST['keyword']);
?>