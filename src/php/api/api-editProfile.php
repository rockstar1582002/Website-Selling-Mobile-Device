<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/customerprofile.php';

$str = explode(",",getPost('String'));
ProfileDAO::editProfile($str[0],$str[1],$str[2],$str[3]);
header("Refresh:0");