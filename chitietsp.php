<?php
   require_once './src/php/modules/detail.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>30PhoneStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/chitiet.css">
    <link rel="stylesheet" href="./assets/css/style-footer.css">
</head>
<body>
    <?php
        renderDetail($dataID);
    ?>
    <div class="near-product">
        <div class="header"><p><b>Các sản phẩm khác của hãng</b></p></div>
        <div class="near-product-item">
            <?php
                renderNearProduct($tradeMark,$dataType);
            ?>
        </div>
    </div>
    <div class="content2">
        <div class="feedback">
            <div class="btn">
                <p>Bạn đánh giá sản phẩm này như thế nào?</p>
                <button onclick="appear()">Đánh giá ngay</button>
            </div>
        </div>
        <div class="specifications">
            <div class="header3"><b><p>Thông số kỹ thuật</p></b></div>
            <div class="info-specifications">
                <?php
                    renderSpecifications($dataID,$dataType);
                ?>
            </div>
        </div>
    </div>
    <div class="modal" id="modal">
        <div class="modal-overplay"></div>
        
        <div class="modal-body">
            <div class="modal-inner">
                <div class="header">
                    <h3>Nhận xét sản phẩm</h3>
                    <button onclick="hide()"><b>X Đóng</b></button>
                </div>
                <form action="">
                    <input type="text" placeholder="Họ tên" name="hoten">
                    <input type="text" placeholder="Số Điện thoại" name="telephone">
                    <input type="text" placeholder="Email" name="Email">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm"></textarea>
                    <div class="btn">
                        <input type="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        include("page/footer.php")
    ?>
    <script type="text/javascript" src="./src/js/change-slide.js"></script>
    <script type="text/javascript" src="./src/js/hide.js"></script>
</body>
</html>