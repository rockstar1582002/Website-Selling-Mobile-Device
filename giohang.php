<?php
require_once ('./src/php/modules/shoppingcart.php');
require_once ('./src/php/modules/customer.php');
CustomerDAO::checklogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/giohang.css">
    
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<script>

</script>
<body>
<div id="main">
    <div id="header">
        <div class="Logo"><a href="didongVN.php"><img src="./assets/img/z3259361943490_ed00241a0d4d5702613f345a4562c89a.jpg" alt=""></a></div>
        <div class="PageName">Giỏ hàng</div>
    </div>
    <div id="content">
        <table class="ShoppingCartTable">
            <thead>
                <tr>
                    <th onclick="total();">
                        <input class="checkbox-input" type="checkbox" onclick="checkall(this);" >
                    </th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr> 
            </thead>
            <tbody>
                <?php 
                    ShoppingCartUI::Render(); 
                ?>
            </tbody>
        </table>
    </div>
    <div id="footer">
        <div class="total">
            <div> <b> Tổng cộng: </b> </div>
            <div id="totalPrice"></div>    
        </div>
        <div class="pay">
            <button onclick="buyInShoppingCart()">Thanh toán</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="./src/js/giohang.js"></script>
</body>
</html>