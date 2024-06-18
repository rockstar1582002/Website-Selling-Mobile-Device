<?php
require_once './src/php/db/dbhelper.php';
require_once './src/php/modules/brand-product.php';
require_once './src/php/modules/customer.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link Icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="./assets/css/style-menu-2.css">
    <link rel="stylesheet" href="./assets/css/style-menu-bottom.css">
    <link rel="stylesheet" href="./assets/css/user.css">
    <link rel="stylesheet" href="./assets/css/style-footer.css">

    <title>30 Stores</title>
</head>

<body>
    <div class="crapper">
        <?php
        require_once('./page/menu-type-2.php');
        // require_once('page/menubar.php');
        ?>
        <div class="content">
            <?php
            require_once("page/banner.php");
            ?>
            <div class="header_telephone">
                <p><b>Điện thoại nổi bật</b></p>
            </div>
            <div class="menu_telephone" id="menu_telephone">
                <div class="menu2">
                    <ul id="menu2">
                        <li><a href="Sanpham.php?type=1">Xem tất cả</a></li>
                    </ul>
                </div>
            </div>
            <div class="telephone_product" id="telephone_product">
            </div>
            <div class="header_laptop">
                <p><b>Laptop nổi bật</b></p>
            </div>
            <div class="menu_laptop" id="menu_laptop">
                <div class="menu3">
                    <ul id="menu3">
                        <li><a href="Sanpham.php?type=2">Xem tất cả</a></li>
                    </ul>
                </div>
            </div>
            <div class="laptop_product" id="laptop_product">
            </div>
            <div class="header_tablet">
                <p><b>Tablet nổi bật</b></p>
            </div>
            <div class="menu_tablet" id="menu_tablet">
                <div class="menu4">
                    <ul id="menu4">
                        <li><a href="Sanpham.php?type=3">Xem tất cả</a></li>
                    </ul>
                </div>
            </div>
            <div class="tablet_product" id="tablet_product">
            </div>
            <div class="header_sound">
                <p><b>Phụ kiện nổi bật</b></p>
            </div>
            <div class="menu_sound" id="menu_sound">
                <div class="menu6">
                    <ul id="menu6">
                        <li><a href="Sanpham.php?type=4">Xem tất cả</a></li>
                    </ul>
                </div>
            </div>
            <div class="sound_product" id="sound_product">
            </div>
        </div>
    </div>

    <?php
    include("page/footer.php")
    ?>
    <script src="./src/js/slideshow.js"></script>
    <script src="./src/js/controluser.js"></script>
    <script>
        getProductHTML(0, 0)
        getProductHTML(1, 1)
        getProductHTML(2, 2)
        getProductHTML(3, 3)
        // getCustomerName()
    </script>
</body>

</html>