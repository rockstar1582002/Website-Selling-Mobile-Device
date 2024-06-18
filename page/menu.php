<?php
    $fullname = (isset($_COOKIE['fullname'])) ? $fullname = $_COOKIE['fullname']: [];
    $FullnameAd = (isset($_COOKIE['Fullname'])) ? $FullnameAd = $_COOKIE['Fullname']: [];
?>
<div class="menu_top">
        <div class="menu" id="menu">
        <!-- <a href="didongVN.php"><div class="logo"><img src="./assets/img/Ảnh chụp màn hình 2022-05-12 145905.png" alt=""></div></a>          -->
            <ul>
                <!-- <li id="login"><a href="form-login.php"><i class="fa-solid fa-user"></i> Đăng nhập</a></li> -->
                <?php if($fullname){ ?>
                <li>
                    <div class="name"><?php echo $fullname ?> <i class="fa-solid fa-caret-down"></i></div>
                    <div class="dropdown">
                        <ul>
                            <!-- <li><a href="form-login.php"><i class="fa-solid fa-user"></i> Đăng nhập</i></a></li> -->
                            <li><a href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a></li>
                            <li class="active"><a href="khachhang.php"><i class="fa-solid fa-id-card-clip"></i> Profile</a></li>
                        </ul>
                    </div>
                </li>
                <?php }else if($FullnameAd){ ?>
                <li>
                    <div class="name"><?php echo $FullnameAd ?> <i class="fa-solid fa-caret-down"></i></div>
                    <div class="dropdown">
                        <ul>
                            <li><a href="admin.php"><i class="fa-solid fa-user"></i> Admin</i></a></li>
                            <li class="active"><a href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a></li>
                            <li class="active"><a href="khachhang.php"><i class="fa-solid fa-id-card-clip"></i> Profile</a></li>
                        </ul>
                    </div>
                </li>    
                <?php }else { ?>
                <li>
                    <div class="name">Account <i class="fa-solid fa-caret-down"></i></div>
                    <div class="dropdown">
                        <ul>
                            <li><a href="form-login.php"><i class="fa-solid fa-user"></i> Login</i></a></li>
                            <li class="active"><a href="#"><i class="fa-solid fa-id-card-clip"></i> Profile</a></li>
                        </ul>
                    </div>
                </li>
                <?php } ?>        
                <li><a href="giohang.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a href="introduce.php"><i class="fa-solid fa-bell"></i> Introduce</a></li>
                <li>
                    <div class="search">
                        <div class="search_item">
                            <input type="text" placeholder = 'Search here...' name="keyword" class='search-product-user' oninput="getConditions(<?= $_GET['type']; ?>)">
                            <button type="submit" name="search" value="search"><i style="margin-top: 2px;" class="fa-solid fa-magnifying-glass"></i></button>              
                        </div>
                    </div>
                </li>
                <li><a href=""><i class="fa-solid fa-location-dot"></i> Agency</a>
                    <div class="menu_sub">
                        <div class='child-menu-sub'><a href=""><i class="fa-solid fa-location-dot"></i> Miền Nam</a></div>
                        <div class='child-menu-sub'><a href=""><i class="fa-solid fa-location-dot"></i> Miền Trung</a></div>
                        <div class='child-menu-sub'><a href=""><i class="fa-solid fa-location-dot"></i> Miền Bắc</a></div>
                    </div>
                </li>
                <li><a href="didongVN.php"><div class="logo"><img src="./assets/img/logo_30phone.png" alt=""></div></a></li>
            </ul>
        </div>
    </div>