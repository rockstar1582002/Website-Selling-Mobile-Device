<?php
require_once('../db/dbhelper.php');
require_once('../util/utility.php');
require_once('../modules/product.php');


ProductDAO::deleteProduct($_POST["idProduct"]);

?>