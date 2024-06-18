<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/product.php';
$productName = getPost('productName');
$productPrice = getPost('productPrice');
$productType = getPost('productType');
$productBrand = getPost('productBrand');
$quantity = getPost('quantity');


if ($productType == 'Phone' || $productType == 'Tablet') {
    $camTrc = getPost('camTrc');
    $camSau = getPost('camSau');
    $ktmh = getPost('ktmh');
    $storage = getPost('storage');
    $ram = getPost('ram');
    $pin = getPost('pin');
    $os = getPost('os');
    $cpu = getPost('cpu');
    $weight = getPost('weight');
    $size = getPost('size');
} else if ($productType == 'Laptop') {
    $disk = getPost('disk');
    $gc = getPost('gc');
    $cpu = getPost('cpu');
    $os = getPost('os');
    $ram = getPost('ram');
    $cnmh = getPost('cnmh');
    $weight = getPost('weight');
    $size = getPost('size');
} else if ($productType == 'Phukien') {
    $congsuat = getPost('congsuat');
    $daura = getPost('daura');
    $dauvao = getPost('dauvao');
    $hang = getPost('hang');
}

$newProduct = new Product(
    $productName,
    $productPrice,
    floor(date_timestamp_get(date_create())),
    $target_file,
    $productType,
    $productBrand,
    "In stock",
    $quantity
);



$sql = "INSERT INTO SANPHAM(MASP, TENSP, GIA, SLTON, TRANGTHAI, MATL, MATH) VALUES 
('" . $newProduct->getProductId() . "', '" . $newProduct->getProductName() . "', '" . $newProduct->getProductPrice() . "',
'" . $newProduct->getQuantityInStore() . "', '" . $newProduct->getState() . "',
'" . $newProduct->getType() . "', '" . $newProduct->getTrademark() . "')";
execute($sql);


$target_dir = "../../../assets/productImages/";

foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
    $uploadOk = 1;

    $target_file = $target_dir . basename($_FILES["files"]["name"][$key]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["files"]["tmp_name"][$key]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product-image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)) {
            $sql = sprintf("Insert into hinhanh(masp, link) values ('%s', './assets/productImages/%s')", $newProduct->getProductId(), $_FILES["files"]["name"][$key]);
            execute($sql);
            echo "The file " . htmlspecialchars(basename($_FILES["files"]["tmp_name"][$key])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


if ($productType == 'Phone' || $productType == 'Tablet') {
    $sql2 = "INSERT INTO THIETBIDD(MASP, CAMTRUOC, CAMSAU, KTMANHINH, BONHO, DUNGLUONGRAM, PIN, HDH, CHIP, TRONGLUONG, KICHTHUOC) VALUES 
    ('" . $newProduct->getProductId() . "', '" . $camTrc . "', '" . $camSau . "', '" . $ktmh . "',
    '" . $storage . "', '" . $ram . "', '" . $pin . "', '" . $os . "', '" . $cpu . "',
    '" . $weight . "', '" . $size . "')";
} else if ($productType == 'Laptop') {
    $sql2 = "INSERT INTO LAPTOP(MASP, OCUNG, CAMSAU, CARDDOHOA, LOAICPU, DUNGLUONGRAM, CONGNGHEMH, TRONGLUONG, KICHTHUOC) VALUES 
    ('" . $newProduct->getProductId() . "', '" . $disk . "', '" . $gc . "', '" . $cpu . "',
    '" . $os . "', '" . $ram . "', '" . $cnmh . "','" . $weight . "', '" . $size . "')";
} else if ($productType == 'Phukien') {
    $sql2 = "INSERT INTO PHUKIEN(MASP, CONGSUAT, DAURA, DAUVAO, HANG) VALUES 
    ('" . $newProduct->getProductId() . "', '" . $congsuat . "', '" . $daura . "', '" . $dauvao . "','" . $hang . "')";
}

execute($sql2);
header('Location: ../../../admin.php');
