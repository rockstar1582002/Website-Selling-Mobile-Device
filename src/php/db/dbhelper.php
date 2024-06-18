<?php
require_once('config.php');

/**
 * Su dung cho cac lenh: insert, update, delete
 */
function initDB($sql)
{
    //Mo ket noi toi database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($conn, 'utf8');

    //query
    mysqli_query($conn, $sql);

    //Dong ket noi
    mysqli_close($conn);
}

/**
 * Su dung cho cac lenh: insert, update, delete
 */
function execute($sql)
{
    //Mo ket noi toi database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    //query
    mysqli_query($conn, $sql);

    //Dong ket noi
    mysqli_close($conn);
}

function checkExists($sql)
{
    //Mo ket noi toi database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    //query
    $flag = mysqli_query($conn, $sql);

    //Dong ket noi
    mysqli_close($conn);
    return $flag;
}

/**
 * Su dung cho cac lenh: select
 */
function executeResult($sql, $onlyOne = false)
{
    //Mo ket noi toi database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    //query
    $resultset = mysqli_query($conn, $sql);

    if ($onlyOne) {
        $data = mysqli_fetch_array($resultset);
    } else {
        $data = [];
        while (($row = mysqli_fetch_array($resultset, 1)) != null) {
            $data[] = $row;
        }
    }
    //Dong ket noi
    mysqli_close($conn);

    return $data;
}

// Su dung cho lenh count

// cau lenh sql khong co count
function countResult($sql)
{
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    // query
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    mysqli_close($conn);
    return $count;
}

// Cau lenh sql co count
function countResult_1($sql)
{
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // query
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $count = $row['COUNT(*)'];
    }
    mysqli_close($conn);
    return $count;
}
// Insert image
function db($sql){
    $sql = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    return $sql;
}