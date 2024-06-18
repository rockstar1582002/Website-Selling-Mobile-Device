<?php
    $fullname = (isset($_COOKIE['fullname'])) ? $fullname = $_COOKIE['fullname']: [];
    $FullnameAd = (isset($_COOKIE['Fullname'])) ? $FullnameAd = $_COOKIE['Fullname']: [];
?>
<div class="menu_top" id="wrapper-menu-top">
        <div class="menu" id="menu">
            <div class="logo_shop">
                <a href="didongVN.php"><div class="logo"><img src="./assets/img/logo_30phone.png" alt=""></div></a>
            </div>
            <div class="agency_shop">
                <div>
                    <a href=""><i class="icon-header uil uil-map-marker"></i> Agency Shop</a>
                    <div class=" agency_shop_menu_sub">
                        <div class='child-menu-sub'><a href="">Miền Nam</a></div>
                        <div class='child-menu-sub'><a href="">Miền Trung</a></div>
                        <div class='child-menu-sub'><a href="">Miền Bắc</a></div>
                    </div>
                </div>
            </div>
            <div class="main_content">
                <div>
                    <a href="didongVN.php">Home</a>
                </div>
                <div>
                    <a href="Sanpham.php?type=0">
                        Shop<i class="uil uil-angle-down"></i>
                    </a>
                </div>
                
                <div>
                    <a href="contact.php">Contact</a>
                </div>
                <div>
                    <a href="introduce.php">Introduce</a>
                </div>
            </div>
            <div class="user_info_content">
                <div>
                    <a class="text-white" href="giohang.php"><i class="icon_header icon_cart uil uil-shopping-cart"></i></a>
                </div>
                <div id="profile" class="profile">
                    <?php if($fullname){ ?>
                    <div>
                        <div id='nameCus' class="name"><?php echo $fullname ?> <i class="fa-solid fa-caret-down"></i></div>
                        <div class="dropdown_profile">
                            <div><a href="logout.php"><i class="fa-solid fa-power-off"></i> Log Out</a></div>
                            <div class="active"><a href="khachhang.php"><i class="fa-solid fa-id-card-clip"></i> Profile</a></div>
                        </div>
                    </div>
                    <?php }else if($FullnameAd){ ?>
                    <div>
                        <div id='nameCus' class="name"><?php echo $FullnameAd ?> <i class="fa-solid fa-caret-down"></i></div>
                        <div class="dropdown_profile" >
                            
                            <div><a href="admin.php"><i class="fa-solid fa-user"></i> Admin</i></a></div>
                            <div class="active"><a href="logout.php"><i class="fa-solid fa-power-off"></i> Log Out</a></div>
                            <div class="active"><a href="khachhang.php"><i class="fa-solid fa-id-card-clip"></i> Profile</a></div>
                            
                        </div>
                    </div>    
                    <?php }else { ?>
                    <div>
                        <div id='nameCus' class="name text-white">Account</div>
                        <div class="dropdown_profile">
                            <div><a href="form-login.php"><i class="fa-solid fa-user"></i> Login</i></a></div>
                            <div class="active"><a href="#"><i class="fa-solid fa-id-card-clip"></i> Profile</a></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
        </div>
    </div>