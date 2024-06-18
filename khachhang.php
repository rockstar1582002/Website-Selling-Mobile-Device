<?php
require_once './src/php/db/dbhelper.php';
require_once ('./src/php/modules/customer.php');
require_once ('./src/php/modules/customerprofile.php');

CustomerDAO::checklogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/khachhang.css">
    <!-- <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css"> -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./src/js/khachhang.js">
</head>
<script>

</script>
<body>
<div id="main">
    <div id="header">
        
    </div> 
    <div id="container__customer" >
        <div class="c__content-menu">
            <div class="c__nav">
                <ul class="c__navbar">
                    <li class="c__navbar-item"><a onclick="openHome()" href="didongVN.php" class="nav-item"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li class="c__navbar-item"><a onclick="openHistory()" href="#" class="nav-item"> <i class="fa-solid fa-clock-rotate-left"></i> Lịch sử mua hàng</a></li>
                    <li class="c__navbar-item"><a onclick="openCustomer()" class="nav-item"><i class="fa-solid fa-user"></i> Tài khoản của bạn</a></li>
                    <li class="c__navbar-item"><a onclick="openChangePass()" class="nav-item"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a></li>
                    <li class="c__navbar-item"><a onclick="openSupport()" href="#" class="nav-item"><i class="fa-solid fa-headset"></i> Hỗ trợ </a></li>
                    <li class="c__navbar-item"><a href="#" class="nav-item"><i class="fa-solid fa-right-from-bracket"></i> Thoát tài khoản</a></li>
                </ul>
            </div>
        </div>
        <div class="c__content-home">

        </div>
        <div class="c__content-history">
            <div class="history-title">
                Quản lý đơn hàng
            </div>
            <div class="history-find">
                <input type="text" placeholder="Tìm kiếm">
            </div>
            <div class="history-content">
                <table id="history-table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ProfileUI::RenderOrder()?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="c__content-support">
            <ul class="support-list">
                <div class="support-title">
                    Hồ trợ khách hàng 
                </div>
                <li class="support-item">
                    <div class="support-item__icon">
                        <img src="https://cellphones.com.vn/smember/_nuxt/img/headphones1.aa8d3ef.png" alt="">
                    </div>
                    <div class="support-item__text">
                        <p>Tư vấn mua hàng (8h00 - 20h00)</p>
                        <p>Miền Bắc:  <a href=""> 18002097</a> </p>
                        <p>Miền Nam: <a href=""> 18002044</a></p>
                    </div>
                </li>
                <li class="support-item">
                    <div class="support-item__icon">
                        <img src="https://cellphones.com.vn/smember/_nuxt/img/waranty1.0738a44.png" alt="">
                    </div>
                    <div class="support-item__text">
                        <p>Bảo hành (8h00 - 21h00)</p>
                        <p><a href=""> 1800.2064</a> </p>
                    </div>
                </li>
                <li class="support-item">
                    <div class="support-item__icon">
                        <img src="https://cellphones.com.vn/smember/_nuxt/img/bad-review1.c5f81ab.png" alt="">
                    </div>
                    <div class="support-item__text">
                        <p>Khiếu nại (8h00 - 21h30)</p>
                        <p><a href="">1800.2063</a> </p>
                    </div>
                </li>
                <li class="support-item">
                    <div class="support-item__icon">
                        <img src="https://cellphones.com.vn/smember/_nuxt/img/message1.62a328e.png" alt="">
                    </div>
                    <div class="support-item__text">
                        <p>Email</p>
                        <p>cskh@30Stores.vn</a> </p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="c__content-infor" id="test">
            <div class="c__infor-top">
                <figure class="c__avt" onclick="openUpload()">
                    <!-- <img src="./assets/img/3.png" alt="avatar">  -->
                    <?php ProfileUI::RenderAvt()?>
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                </figure>
                
                <button class="c__edit" onclick="openEdit()">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button> 
            </div>
            <div class="c__infor-bottom">
                <?php ProfileUI::Render() ?>;
            </div>
        </div>
        <div class="c__content-changepass">
            <div class="history-title">
                Đổi mật khẩu
            </div>
            <form action="" class="changePass">
                <div class="form-group">
                    <div><label for="user_signin">Mật khẩu cũ</label></div>
                    <input type="password" class="form-control" id="old_pass">
	  			</div>
	  			<div class="form-group">
	    			<div><label for="user_signin">Mật khẩu mới</label></div>
	    			<input type="password" class="form-control" id="new_pass">
	  			</div>
	  			<div class="form-group">
                    <div><label for="user_signin">Nhập lại mật khẩu mới</label></div>
	    			<input type="password" class="form-control" id="re_new_pass">
                </div>
	  			<button type="button" class="btn btn-primary" id="submit_change_pass" onclick="submitChangePass()">
	  				<span class="glyphicon glyphicon-ok"></span> Xác nhận
	  			</button>
	  			<br><br>
	  			<div class="alert alert-danger hidden"></div>
            </form>
        </div>
    </div>
    <div class="overlay" style="display: none;">
        <div class="form__edit-Profile">
            <div class="edit__Profile-header">
                <h3>Chỉnh sửa thông tin cá nhân</h3>
                <div class="edit__Profile-header-exit" onclick="closeEdit();"><i class="fa-solid fa-circle-xmark"></i></div>
            </div>
            <div class="edit__Profile-content">
        
                <?php ProfileUI::RenderEdit()?>
                <div class="e__content-item">
                    <button onclick="submit()">Xác nhận</button>
                </div>

            </div>
        </div>
    </div>    
    <div class="overlayUpload" style="display: none;">
        <div class="uploadImage">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="formUploadHeader">
                    <h3>Select Image File to Upload</h3>
                    <div class="exitFormUpload" onclick="closeEdit()"><i class="fa-solid fa-circle-xmark"></i></div>
                </div>
                <br>
                <input type="file" name="file">
                <br>
                <input type="submit" name="submit" value="Upload" class="submitImage" onclick="closeEdit()">
            </form>
            <?php   
            if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
                $statusMsg = '';

                // File upload path
                $targetDir = "uploads/";
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        $idC = $_COOKIE['customerId'];
                        // Insert image file name into database
                        execute("INSERT into images (file_name, uploaded_on,MAKH) VALUES ('".$fileName."', NOW(),'".$idC."')");
                    }    
                }else{
                    $statusMsg = 'Please select a file to upload.';
                }
            } 
            ?>
        </div>
    </div>  
    <!-- <div class="overlayOrderDetail" style="display:none"> -->
    <div id="order-detail-modal" class="modal_wrapper">
        <!-- Modal content -->
        <div class="modal_content">
            <span class="close_modal"><i class="uil uil-multiply" onclick="closeOrderDetail()"></i></span>
            <div class='order_content'>
                <div>
                    <div class='btn-info'><i class="uil uil-receipt"></i> Chi tiết đơn hàng</div>
                    <div class="body_content mt-8">
                        <table class="OrderDetail-table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody id="table-body-order-detail">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    
</div> 

<script type="text/javascript" src="./src/js/khachhang.js"></script>

</body>
</html>