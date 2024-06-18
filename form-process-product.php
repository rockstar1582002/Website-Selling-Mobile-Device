<?php
require_once './src/php/db/dbhelper.php';
require_once './src/php/util/utility.php';

$dataId = getGet('dataId');
$dataType = getGet('dataType');

$sqlQueryProd = "SELECT * FROM SANPHAM sp WHERE sp.MASP = '$dataId'";
$dataProd = executeResult($sqlQueryProd, true);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./asset/css/grid.css">
</head>
<body>
    <div class="wrapper">
        <form action="" class="row">
            <div class="col l-8">
                <h2>Thông tin cơ bản của sản phẩm</h2>
            </div>
            <div class="col l-8 l-o-2">
                <label for="product-name">Tên Sản Phẩm</label><br>
                <input type="text" id="product-name"><br>
                <label for="product-name">Giá Bán</label><br>
                <input type="text" id="product-name"><br>
            </div>
            <div class="col l-4 l-o-2">
                <label for="product-name">Thể loại</label>
                <select name="" id="">
                    <option value="none" hidden selected disabled>Chọn Thể Loại</option>
                    <option value="">Điện thoại</option>
                    <option value="">Laptop</option>
                    <option value="">Máy tính bảng</option>
                    <option value="">Phụ kiện</option>
                </select>
            </div>
            <div class="col l-4">
                <label for="product-name">Thương Hiệu</label>
                <select name="" id="">
                    <option value="none" hidden selected disabled>Chọn Thương Hiệu</option>
                    <option value="">Điện thoại</option>
                    <option value="">Laptop</option>
                    <option value="">Máy tính bảng</option>
                    <option value="">Phụ kiện</option>
                </select>
            </div>
            <div class="col l-8 l-o-2">
                <input type="file">
            </div>
            <div class="col l-8 l-o-2">
                <label for="">Số Lượng Bán</label>
                <input type="text" id="product-name">
            </div>
            <div class="col l-1 l-o-2">
                <input type="submit" value="Add">
            </div>
        </form>
    </div>
</body>

</html>