<?php
    require_once('../db/dbhelper.php');
    require_once('../util/utility.php');
    require_once('../modules/customerprofile.php');

    $id = getPost('IdOrder');
    echo $id;
    ProfileDAO::cancelOrder($id);
    header("Refresh:0");
?>