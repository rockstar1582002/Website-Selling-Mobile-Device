<?php
    require_once('../db/dbhelper.php');
    require_once('../util/utility.php');
    require_once('../modules/customerprofile.php');
    
    $password = explode(",",getPost('Password'));
    
    if(ProfileDAO::checkPass($password[0])==false){
        // echo $password[0];
        echo "Sai mật khẩu";
    }else{
        ProfileDAO::changePass($password[1]);
        // echo $password[1];
        echo "Thành công !";
    }
?>