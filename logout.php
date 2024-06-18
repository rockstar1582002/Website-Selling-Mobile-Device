<?php
    if(isset( $_COOKIE['fullname'] )){
        setcookie('fullname', NULL, time() - 24*36000, '/');
    }
    if(isset ( $_COOKIE['customerId'] )){
        setcookie('customerId', NULL, time() - 24*36000, '/');
    }
    if(isset( $_COOKIE['Fullname'] )){
        setcookie('Fullname', NULL, time() - 24*36000, '/');
    }
    if(isset ( $_COOKIE['CusId'] )){
        setcookie('CusId', NULL, time() - 24*36000, '/');
    }
    if(isset ($_COOKIE['productIDArray'])){
        foreach($_COOKIE['productIDArray'] as $name => $value ){
            setcookie('productIDArray['.$name.']',$value,time()-4800,'/');
        }
    }
    header('location:didongVN.php');
?>