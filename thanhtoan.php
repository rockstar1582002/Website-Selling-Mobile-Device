<?php
require_once ('./src/php/modules/payment.php');
require_once('./src/php/db/dbhelper.php');
require_once('./src/php/util/utility.php');
require_once ('./src/php/modules/customer.php');
CustomerDAO::checklogin();
// require_once('./src/php/modules/productuser.php');
// require_once ('./src/php/modules/shoppingcart.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GioHang</title>
    <link rel="stylesheet" href="./assets/css/giohang.css">
    <link rel="stylesheet" href="./src/js/giohang.js">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

<div id="main">
    <div id="header">
        <div class="Logo"><a href="didongVN.php"><img src="./assets/img/z3259361943490_ed00241a0d4d5702613f345a4562c89a.jpg" alt=""></a></div>
        <div class="PageName">Thanh Toán</div>
    </div>
    <div id="ThanhToan">
        <div class="TT__container">
            <div class="TT__form-back">
                <a href="giohang.php"><i class="fa-solid fa-angle-left"></i>Trở lại</a>
            </div>
            <div class="TT__profile-df">
                <h3> <i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng</h3>
                <div class="profile-df">
                    <!-- <div class="df-name">
                        Nguyễn Hoàng Gia Đại
                    </div>
                    <div class="df-phone">
                        0357802648
                    </div>
                    <div class="df-address">
                        Thành phố Hồ Chí Minh
                    </div> -->
                    <?= PaymentUI::renderAddress(); ?>
                    <a href="#" class="profile-change" onclick="thaydoi();">
                        Thay đổi
                    </a>
                </div>
            </div>
            <div class="TT__product">
                <div class="TT__product-h">
                    <h3 style="margin-left: 50px;">Sản phẩm</h3>
                    <div class="TT__h-dg" style="margin-left: 580px;">Đơn giá</div>
                    <div class="TT__h-sl" style="margin-left: 80px;">Số lượng</div>
                    <div class="TT__h-tt" style="margin-left: 120px;">Thành tiền</div>
                </div>
                    <?php 
                        PaymentUI::Render();
                    ?>
            </div>
            <div class="overlay" style="display: none">
                <div class="TT__form">
                <h2>Thông tin đặt hàng</h2>
                <!-- <form action="" class="TT__form-db">
                    <input type="text" name="customerphone" id="TT__form-phone" value="" placeholder="Số điện thoại">
                    <br>
                    <input type="text" name="customremail" id="TT__form-address" value="" placeholder="Địa chỉ"> 
                </form> -->
                    <?php PaymentUI::renderEditAddress() ?>
                <button class="TT__xacnhan" onclick="xacnhan();">
                    <span>Xác nhận</span>
                </button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="./src/js/giohang.js">

    </script>
</div>    
</body>
</html>