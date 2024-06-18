<?php
    require_once('./src/php/util/utility.php');
    require_once('./src/php/db/dbhelper.php');
    include("page/menu.php");
    include("page/menubar.php");
    $dataID = getGet('dataId');
    $dataType = getGet('dataType');
    $tradeMark = getGet('trademark');
    function renderDetail($id){
        $sql = "SELECT * 
                FROM SANPHAM sp JOIN THUONGHIEU th ON sp.MATH = th.MATH JOIN HINHANH ha ON sp.MASP = ha.MASP
                WHERE sp.MASP = '" . $id . "' ";
        $result = executeResult($sql);
        $htmlImgs = "";
        foreach($result as $item){
            $htmlImgs .= '<div><img src="'.$item['LINK'].'" alt=""></div>';
        }    
            echo '<div class="content">
                    <div class = picture>
                        <div class="slide">
                            <div class="dieu-huong">
                                <i class="fa-solid fa-angle-left" onclick="Back();"></i>
                                <i class="fa-solid fa-angle-right" onclick="Next();"></i>
                            </div>
                            <div class="chuyen-slide">  
                                '.$htmlImgs.'
                            </div>
                        </div>
                    </div>        
                    <div class="info">
                        <div class="name-product"><b>'.$result[0]['TENSP'].'</b></div>
                        <div class="info-product">
                            <div class="cost-product">' . number_format($result[0]['GIA'], 0, ',', '.') . '  đ</div>
                            <div class="situation"><b>Tình trạng: </b>'.$result[0]['TRANGTHAI'].'</div>
                            <div class="accessory"><b>Mới 100%, Nguyên hộp: </b>1 máy, 1 cable, 1 sạc, 1 tai nghe, tài liệu hướng dẫn</div>
                            <div class="description">
                                <ul>
                                    <li><p><i class="fa-solid fa-square-check"></i> Máy được kiểm định trước khi bán</p></li>
                                    <li><p><i class="fa-solid fa-square-check"></i> Chính hãng '.$result[0]['TENTH'].'</p></li>
                                    <li><p><i class="fa-solid fa-square-check"></i> 1 đổi 1 trong 1 năm</p></li>
                                    <li><p><i class="fa-solid fa-square-check"></i> Trả góp nhanh gọn thủ tục đơn giản</p></li>
                                    <li><p><i class="fa-solid fa-square-check"></i> Giao hàng thu tiền trên mọi miền tổ quốc</p></li>
                                </ul>
                            </div>
                        </div> 
                        <div class="button">
                            <button class="btn1" onclick="buynow(\''.$result[0]['MASP'].'\')">Mua hàng</button>
                            <button class="btn2" onclick="addCart(\''.$result[0]['MASP'].'\')">Thêm vào giỏ hàng</button>
                        </div>
                        <div class="info-sale">
                            <div class="header2"><p><b>ƯU ĐÃI THÊM</p></b></div>
                            <div class="sale">
                                <ul>
                                    <li><p href="">Giảm đến 1% cho thành viên Smember (áp dụng tùy sản phẩm)</p></li>
                                    <li><p href="">Mở thẻ tín dụng VietComBank, nhận voucher đến 3.000.000 đồng</p></li>
                                </ul>
                            </div>
                        </div>   
                    </div>
                </div>';    
        }
    function renderSpecifications($id,$type){
        if($type == 'Phone' || $type == 'Tablet' ){
            $tableCat = 'thietbidd';
        } else if($type == 'Laptop'){
            $tableCat = 'laptop';
        } else if($type == 'Phukien'){
            $tableCat = 'phukien';
        }
        $sql = "SELECT * FROM SANPHAM sp JOIN $tableCat ON sp.MASP = $tableCat.MASP ";
        $result = executeResult($sql,true);
            if($type == 'Phone' || $type == 'Tablet' ){
                $mobileInfo = '<ul>
                    <li><p class="active">Cam trước: '.$result['CAMTRUOC'].'</p></li>
                    <li><p>Camera sau: '.$result['CAMSAU'].'</p></li>
                    <li><p class="active">Kích thước màn hình: '.$result['KTMANHINH'].'</p></li>
                    <li><p>Bộ nhớ: '.$result['BONHO'].'</p></li>
                    <li><p class="active">Dung lượng RAM: '.$result['DUNGLUONGRAM'].'</p></li>
                    <li><p>Pin: '.$result['PIN'].'</p></li>
                    <li><p class="active">Hệ điều hành: '.$result['HDH'].'</p></li>
                    <li><p>Chip: '.$result['CHIP'].'</p></li>
                    <li><p class="active">Trọng lượng: '.$result['TRONGLUONG'].'</p></li>
                    <li><p>Kích thước: '.$result['KICHTHUOC'].'</p></li>
            </ul>';
                echo $mobileInfo;
            } else if($type == 'Laptop'){
                $laptopInfo = '<ul>
                    <li><p class="active">Ổ cứng: '.$result['OCUNG'].'</p></li>
                    <li><p>Card đồ họa: '.$result['CARDDOHOA'].'</p></li>
                    <li><p class="active">Loại CPU: '.$result['LOAICPU'].'</p></li>
                    <li><p>Hệ điều hành: '.$result['HDH'].'</p></li>
                    <li><p class="active">Dung lượng RAM: '.$result['DUNGLUONGRAM'].'</p></li>
                    <li><p>Công nghệ màn hình: '.$result['CONGNGHEMH'].'</p></li>
                    <li><p class="active">Trọng lượng: '.$result['TRONGLUONG'].'</p></li>
                    <li><p>Kích thước: '.$result['KICHTHUOC'].'</p></li>
            </ul>';
                echo $laptopInfo;
            } else {
                $phukienInfo ='<ul>
                    <li><p>Công suất: '.$result['CONGSUAT'].'</p></li>
                    <li><p>Đầu ra: '.$result['DAURA'].'</p></li>
                    <li><p class="active">Đầu vào: '.$result['DAUVAO'].'</p></li>
                    <li><p>Hãng: '.$result['HANG'].'</p></li>
                </ul>';
                echo $phukienInfo;
            }   
    }
    function renderNearProduct($mark,$type){
        $sql = "SELECT * FROM SANPHAM sp WHERE sp.MATL = '". $type ."' AND sp.MATH = '" . $mark . "'";
            $prosuctsTop = executeResult($sql);
            $productsTopLeng = count($prosuctsTop);
            for ($i = 0; $i < 5; $i++) {
                $productRandom = rand(0, $productsTopLeng - 1);
                $sqlQueryImgs = "SELECT * FROM HINHANH ha WHERE ha.MASP = '" . $prosuctsTop[$productRandom]["MASP"] . "'";
                $listImgs = executeResult($sqlQueryImgs);
                echo '<div class="product_item">
                <a href="chitietsp.php?dataId='.$prosuctsTop[$productRandom]['MASP'].'&dataType='.$prosuctsTop[$productRandom]['MATL'].'&&trademark='.$prosuctsTop[$productRandom]['MATH'].'">
                    <div class="product">
                        <div><img style="margin-left:14px;margin-top:14px" src="' . $listImgs[rand(0, count($listImgs) - 1)]['LINK'] . '" alt=""></div>
                        <div class="product_name"><h2>' .  $prosuctsTop[$productRandom]['TENSP'] . '</h2></div>
                        <div class="product_cost">' . number_format($prosuctsTop[$productRandom]['GIA'], 0, ',', '.') . ' đ</div>
                    </div>
                </a>
            </div>';
            }
    }
