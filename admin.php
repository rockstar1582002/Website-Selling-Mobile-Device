<?php
require_once('./src/php/db/dbhelper.php');
require_once('./src/php/util/utility.php');
require_once('./src/php/modules/product.php');
require_once('./src/php/modules/category-product.php');
require_once('./src/php/modules/order.php');
require_once('./src/php/modules/brand-product.php');
require_once('./src/php/api/api-dashboard.php');
require_once('./src/php/modules/customer.php');


// Render data on Dashboard
$sqlCntCustomers = "SELECT * FROM KHACHHANG";
$rowsCustomer = countResult($sqlCntCustomers);

$sqlTLTH = "SELECT COUNT(*) as SOLUONG, tl.TENTL, th.TENTH
            from SANPHAM sp JOIN TLTH on (sp.MATL = TLTH.MATL) and (sp.MATH = TLTH.MATH)
            JOIN THELOAI tl on tl.MATL = tlth.MATL
            JOIN THUONGHIEU th on th.MATH = TLTH.MATH
            GROUP BY TLTH.MATH, TLTH.MATL, tl.TENTL, th.TENTH";
$listTLTH = executeResult($sqlTLTH);

$sqlQueryTotalQty = "Select sum(Soluong) as totalQty from CTDH join Donhang on CTDH.madh = Donhang.madh "
    . "where trangthai = 'Đã xử lý'";
$totalQty = executeResult($sqlQueryTotalQty, true);

$sqlQueryTotalSale = "Select sum(Thanhtien) as totalSale from Donhang where trangthai = 'Đã xử lý'";
$totalSale = executeResult($sqlQueryTotalSale, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Icon -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css" echo time(); ?>">
    <!-- <link rel="stylesheet" href="./asset/css/style.css"> -->
    <link rel="stylesheet" href="./assets/css/grid.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar">
            <div id="container-sidebar">
                <div class="top-content-sidebar">
                    <a href="#"><img src="./assets/img/1,286 copy.png" alt="logo shop"></a>
                </div>
                <div class="sidebar-menu">
                    <div class="active">
                        <i class="uil uil-dashboard"></i>Dashboard
                    </div>
                    <div class="">
                        <i class="uil uil-chart-line"></i>Statistic
                    </div>
                    <div>
                        <i class="uil uil-box"></i>Products
                    </div>
                    <div>
                        <i class="uil uil-receipt-alt"></i>Orders
                    </div>
                    <div>
                        <i class="uil uil-users-alt"></i>Customers
                    </div>
                    <div>
                        <i class="uil uil-signout"></i><a href="diDongVN.php" style="color:#000">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End sidebar menu -->
        <div id="main">
            <div class="block-content">
                <div class="body-content grid">
                    <div class="topbar row">
                        <div class="col l-1"><i class="uil uil-bars"></i></div>
                    </div>
                    <div class="card-box row">
                        <div class="col l-4 m-6 c-12">
                            <div class="card white">
                                <div>
                                    <div class="number-customers">
                                        <?= $rowsCustomer ?>
                                    </div>
                                    <div>Customers</div>
                                </div>
                                <div><i class="uil uil-user"></i></div>
                            </div>
                        </div>
                        <div class="col l-4 m-6 c-12">
                            <div class="card blue">
                                <div>
                                    <div class="number-customers">
                                        <?= $array[0] ?>
                                    </div>
                                    <div>Products</div>
                                </div>
                                <div><i class="uil uil-box"></i></div>
                            </div>
                        </div>
                        <div class="col l-4 m-6 c-12">
                            <div class="card white">
                                <div>
                                    <div class="number-customers">
                                        <?= $array[1] ?>
                                    </div>
                                    <div>Classify</div>
                                </div>
                                <div><i class="uil uil-file-alt"></i></div>
                            </div>
                        </div>
                        <div class="col l-4 m-6 c-12">
                            <div class="card blue">
                                <div>
                                    <div class="number-customers">
                                        <?= $array[2] ?>
                                    </div>
                                    <div>Trademark</div>
                                </div>
                                <div><i class="uil uil-trademark-circle"></i></i></div>
                            </div>
                        </div>
                        <div class="col l-4 m-6 c-12">
                            <div class="card white">
                                <div>
                                    <div class="number-customers"><?= $totalQty['totalQty'] ?></div>
                                    <div>Total Quantity</div>
                                </div>
                                <div><i class="uil uil-usd-circle"></i></div>
                            </div>
                        </div>
                        <div class="col l-4 m-6 c-12">
                            <div class="card blue">
                                <div>
                                    <div class="number-customers"><?= number_format($totalSale['totalSale'], 0, ',', '.') . ' đ'; ?></div>
                                    <div>Total Sales</div>
                                </div>
                                <div><i class="uil uil-chart" style="font-size: 2.5rem;"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- End card-box -->
                    <div class="row">
                        <div id="table-classify-trademark" class="col l-12 m-12 c-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Thể loại</th>
                                        <th>Thương hiệu</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-classify-trademark">
                                    <?php
                                    foreach ($listTLTH as $row) {
                                        echo '
            <tr class="text-center">
                <td>' . $row["TENTL"] . '</td>
                <td>' . $row["TENTH"] . '</td>
                <td>' . $row["SOLUONG"] . '</td>
            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End dashboard -->
            <!-- Begin Statistic -->
            <div class="block-content">
                <div class="body-content grid">
                    <div class="topbar row">
                        <div class="col l-1"><i class="uil uil-bars"></i></div>
                    </div>
                    <div class="row">
                        <div class="col l-3 form-search">
                            <input type="text" class="form-control-search search-product search-statistic" placeholder="Search..." oninput="getStatisticCondition();">
                            <i class="uil uil-search icon-search" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                    <div class="row mt-16">
                        <div class="col l-2">
                            <input onchange="getStatisticCondition();" type="date" name="date-from" id="" class="form-control date-picker date-from">
                        </div>
                        <div>&#8594;</div>
                        <div class="col l-2">
                            <input onchange="getStatisticCondition();" type="date" name="date-to" id="" class="form-control date-picker date-to">
                        </div>
                    </div>
                    <div class="row mt-16">
                        <div class="col l-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Sản Phẩm</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th class="col-classify">
                                            <div class="title-col">Thể Loại <i class="uil uil-angle-up"></i></div>
                                            <div id="filter-category-statistic" class="checkbox-list" onchange="getStatisticCondition();"></div>
                                        </th>
                                        <th class="col-trademark">
                                            <div class="title-col">Thương Hiệu <i class="uil uil-angle-up"></i></div>
                                            <div id="filter-brand-statistic" class="checkbox-list" onchange="getStatisticCondition();"></div>
                                        </th>
                                        <th>Tổng Sale <i class="uil uil-sort"></i></th>
                                        <th>Tổng số lượng bán <i class="uil uil-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="footer-statistic"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Statistic -->
            <!-- Begin Products -->
            <div class="block-content" id="product-content">
                <div class="body-content grid">
                    <div class="topbar row">
                        <div class="col l-1"><i class="uil uil-bars"></i></div>
                        <div class="col l-3">
                            <div class="btn-product btn-top active">
                                <div>Tất Cả Sản Phẩm</div>
                            </div>
                        </div>
                        <div class="col l-3">
                            <div class="btn-product btn-top">
                                <div><i class="uil uil-plus"></i>Thêm Sản Phẩm</div>
                            </div>
                        </div>
                        <div class="col l-3">
                            <div class="btn-product btn-top">
                                <div><i class="uil uil-plus"></i>Nhập Số Lượng</div>
                            </div>
                        </div>
                    </div>
                    <div class="product-container" style="display: block;">
                        <div class="row">
                            <div class="col l-3 form-search">
                                <input type="text" class="form-control-search search-product-1" placeholder="Search..." oninput="getConditions();">
                                <i class="uil uil-search icon-search" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-16 col l-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Mã Sản Phẩm</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th class="col-classify">
                                                <div class="title-col">Thể Loại <i class="uil uil-angle-up"></i></div>
                                                <div class="checkbox-list" id="filter-category-prod" onchange="getConditions();"></div>
                                            </th>
                                            <th class="col-trademark">
                                                <div class="title-col">Thương Hiệu <i class="uil uil-angle-up"></i></div>
                                                <div class="checkbox-list" id="filter-brand-prod" onchange="getConditions();"></div>
                                            </th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-product">
                                        <?php
                                        /*$tmp = 'Asus';
                                        $arr[] = $tmp;
                                        echo ProductUI::renderWithCondition(ProductDAO::filterAdvanced( 
                                            null, null, ''), 1, 10);*/
                                        ?>
                                    </tbody>
                                </table>
                                <div id="footer-product" class="footer-pages footer-product mt-16 text-right">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-container new-product-page">
                        <form action="./src/php/api/api-add-new-prod.php" method="post" class="row" enctype="multipart/form-data">
                            <div class="col l-8">
                                <h2>Basic information of the product</h2>
                            </div>
                            <div class="col l-8 l-o-2">
                                <label for="product-name">Product Name</label><br>
                                <input type="text" id="product-name" name="productName" required><br>
                            </div>
                            <div class="col l-8 l-o-2">
                                <label for="product-price">Price</label><br>
                                <input type="text" id="product-price" name="productPrice" required><br>
                            </div>
                            <div class="col l-4 l-o-2 input-select">
                                <label for="product-name">Category</label>
                                <select name="productType" id="frm-select-type" required onchange="getHtmlBrandByType(this); displayForm(this);">

                                </select>
                            </div>
                            <div class="col l-4 input-select">
                                <label for="product-name">Brand</label>
                                <select name="productBrand" id="frm-select-brand" required>

                                </select>
                            </div>
                            <div class="col l-8 l-o-2">
                                <input type="file" multiple class="input-file" name="files[]">
                            </div>
                            <div class="col l-8 l-o-2">
                                <label for="">Quantity</label>
                                <input type="number" id="" name="quantity">
                            </div>

                            <div class="col l-8">
                                <h2 style="padding-top: 12px">Product specifications</h2>
                            </div>
                            <div class="product-info description" style="width:100%;" id="product-description">
                                <div class="col l-8 l-o-2">
                                    <p style="color: #ccc; text-align:center; font-size:1.2rem">Please Choose Category of Product</p>
                                </div>
                            
                            </div>
                            <div class="col l-1 l-o-2">
                                <input type="submit" value="Add" class="type-btn">
                            </div>
                            <div class="col l-1 l-o-2">
                                <input type="reset" value="Reset" class="type-btn">
                            </div>
                        </form>
                    </div>
                    <div class="product-container">
                        <!-- <div class="row">
                            <div class="col l-3 form-search">
                                <input type="text" class="form-control-search search-product" placeholder="Search...">
                                <i class="uil uil-search icon-search" style="font-size: 1.2rem;"></i>
                            </div>
                        </div> -->
                        <div class="row mt-16">
                            <div class="col l-3">
                                <div class="">
                                    <label for="product-update lbl_product_update">Choose a product:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l-5 ">
                                <div class=''>
                                    <select id="product-update" class='slc_opt slc_product_update'>
                                    </select>
                                </div>
                            </div>
                            <div class="col l-2 ">
                                <div class=''>
                                    <input type="text" id='id-chosen-item' class="slc_product_update text-center" readonly placeholder="ID Product">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-16">
                            <div class="col l-3">
                                <div>
                                    <label for="qty-update">Enter receive quantity:</label>
                                    <input type="number" name="" class="qty_update slc_product_update" id='qty-update' placeholder="Receive Quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-16">
                            <div class="col l-2">
                                <div>
                                    <div class="btn-confirm text-center" id='' onclick='addChosenItem();'>Add</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-16 col l-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th class="col-classify">
                                                <div class="title-col">Category <i class="uil uil-angle-up"></i></div>
                                                <div class="checkbox-list" id="filter-category-edit-quan"></div>
                                            </th>
                                            <th class="col-trademark">
                                                <div class="title-col">Brand <i class="uil uil-angle-up"></i></div>
                                                <div class="checkbox-list" id="filter-brand-edit-quan"></div>
                                            </th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-product-update-qty">
                                    </tbody>
                                </table>
                                <div id="footer-product-update-qty" class="footer-pages footer-product mt-16 text-right">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-16">
                            <div class="col l-3 l-o-10">
                                <div>
                                    <div class="btn-confirm text-center" id='' onclick='confirmUpdate();'>Confirm Update</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Products -->
            <!-- Begin Orders -->
            <div class="block-content" id="order">
                <div class="body-content grid">
                    <div class="topbar row type-order-list">
                        <div class="col l-1"><i class="uil uil-bars"></i></div>
                        <div class="col l-2">
                            <div class="type-order btn-top active">
                                <div><i class="uil uil-clipboard"></i>Tất cả</div>
                            </div>
                        </div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div>Đang xử lý</div>
                            </div>
                        </div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div>Đã xử lý</div>
                            </div>
                        </div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div>Đã hủy</div>
                            </div>
                        </div>

                    </div>
                    <div class=" row">
                        <div class="col l-3 form-search">
                            <input type="text" class="form-control-search search-product search-order" placeholder="Search..." oninput="getOrderCondition();getOrderCondition(1);getOrderCondition(2);getOrderCondition(3);">
                            <i class="uil uil-search icon-search" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-order mt-16 col l-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Đơn</th>
                                        <th>Mã Khách Hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày Đặt <i class="uil uil-sort"></i></th>
                                        <th>Tình Trạng</th>
                                        <th>Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody id="all-orders">
                                    <?php
                                    echo ProductUI::renderWithCondition(OrderDAO::getData(), 1, 10);
                                    ?>
                                </tbody>
                            </table>
                            <div id="footer-all-order" class="footer-pages  mt-16 text-right">
                            </div>
                        </div>
                        <div class="table-order mt-16 col l-12" id="processing-orders-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Đơn</th>
                                        <th>Mã Khách Hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày Đặt <i class="uil uil-sort"></i></th>
                                        <th>Xử Lý</th>
                                        <th>Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody id="processing-orders">
                                    <?php
                                    echo ProductUI::renderWithCondition(OrderDAO::getData(1), 1, 10, 1);
                                    ?>
                                </tbody>
                            </table>
                            <div id="footer-processing-order" class="footer-pages mt-16 text-right">
                            </div>
                        </div>
                        <div class="table-order mt-16 col l-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Đơn</th>
                                        <th>Mã Khách Hàng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Ngày Đặt <i class="uil uil-sort"></i></th>
                                        <th>Ngày xử lý</th>
                                        <th>Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody id="processed-orders">
                                    <?php
                                    echo ProductUI::renderWithCondition(OrderDAO::getData(2), 1, 10, 2);
                                    ?>
                                </tbody>
                            </table>
                            <div id="footer-processed-order" class="footer-pages mt-16 text-right">
                            </div>
                        </div>
                        <div class="table-order mt-16 col l-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Đơn</th>
                                        <th>Mã Khách Hàng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Ngày Đặt <i class="uil uil-sort"></i></th>
                                        <th>Ngày hủy</th>
                                        <th>Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody id="canceled-orders">
                                    <?php
                                    echo ProductUI::renderWithCondition(OrderDAO::getData(3), 1, 10, 3);
                                    ?>
                                </tbody>
                            </table>
                            <div id="footer-canceled-order" class="footer-pages mt-16 text-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Orders -->
            <!-- Begin Customers -->
            <div class="block-content" id="customer-page">
                <div class="body-content grid">
                    <div class="row topbar">
                        <div class="col l-1"><i class="uil uil-bars"></i></div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div onclick="DelAllCus()">Xóa</div>
                            </div>
                        </div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div onclick="BlockCheckbox()">Chặn</div>
                            </div>
                        </div>
                        <div class="col l-2">
                            <div class="type-order btn-top">
                                <div onclick="UnblockCheckbox()">Bỏ chặn</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col l-3 form-search">
                            <input type="text" class="form-control-search " id="search-customer" placeholder="Search..." onkeyup="searchFun()">
                            <i class="uil uil-search icon-search" style="font-size: 1.2rem;"></i>
                        </div>
                        <div class="mt-16 col l-12">
                            <table class="table" id="table-customer">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkbox-customer" type="checkbox">
                                                <input type="checkbox" id="checkbox-customer" onclick="checkall(this)">
                                            </label>
                                        </th>
                                        <th>STT</th>
                                        <th>Mã khách hàng</th>
                                        <th>Họ Tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        CustomerUI::Render();
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Customer -->
            <!-- Begin Log out -->
            <div class="block-content">
                <div class="body-content">
                </div>
            </div>
            <!-- End Log out -->
        </div>
    </div>
    <!-- The Modal Detail Order-->
    <div id="order-detail-modal" class="modal_wrapper">
        <!-- Modal content -->
        <div class="modal_content">
            <span class="close_modal"><i class="uil uil-multiply"></i></span>
            <div class='order_content'>
                <div>
                    <div class='btn-info'><i class='uil uil-info-circle'></i> Information</div>
                    <div class='top_content' id='top-content-ord-detail'>
                        <div>Order ID: </div>
                        <div>Order Date: </div>
                        <div>Customer Name: </div>
                        <div>Customer Address: </div>
                    </div>
                </div>
                <div>
                    <div class='btn-info'><i class="uil uil-receipt"></i> Information</div>
                    <div class="body_content mt-8">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="table-body-order-detail">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class='bottom_content text-right' id='bottom-content-ord-detail'>
                        <div>Total: </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- The modal detail product -->
    <div id="product-detail-modal" class="modal_wrapper">
        <!-- Modal content -->
        <div class="modal_content_product">
            <span class="close_modal"><i class="uil uil-multiply"></i></span>
            <div>
                <div class='product_content'>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="">
                            <h2>Basic information of the product</h2>
                        </div>
                        <div style="padding-left: 32px" id='product-detail-top'>
                            <!-- <div class="mt-8">
                                <label for="product-name">Product Name</label><br>
                                <input type="text" id="product-name" name="productName" required><br>
                            </div>
                            <div class="mt-8">
                                <label for="product-price">Price</label><br>
                                <input type="text" id="product-price" name="productPrice" required><br>
                            </div>
                            <div class="input-select">
                                <label for="product-name">Category</label>
                                <input type="text" editable="false">
                            </div>
                            <div class="edit_brand-status">
                                <div class="input-select">
                                    <label for="product-name">Brand</label>
                                    <select name="productBrand" id="frm-select-brand" required style='padding:8px;'>
                                    </select>
                                </div>
                                <div class="input-select">
                                    <label for="">Status</label>
                                    <select name="statusProduct" id="" style='padding:8px;' required>
                                        <option value="">In Stock</option>
                                        <option value="">Stop Selling</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-8 edit-image-product">
                                <input type="file" multiple class="input-file" name="files_edit[]">
                            </div> -->
                        </div>
        
                        <div class="">
                            <h2 style="padding-top: 12px">Product specifications</h2>
                        </div>
                        <div class="" style="width:100%;padding-left: 32px;" id="product-detail-bottom">
                        </div>
                        <div class="btn-confirm text-center btn-min mt-16" width="20%" style="margin-left: 80%;">
                            <input type="submit" value="Save">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script src="./src/js/main.js"></script>
    <script src="./src/js/control.js"></script>
    <script src="./src/js/AdminOrderController.js"></script>
    <script src="./src/js/AdminStatisticController.js"></script>
    <script src="./src/js/AdminQuantityProductController.js"></script>
    <!-- <script src="./src/js/AdminProductController.js"></script> -->
    <script>
        getConditions();
        getOrderCondition();
        getOrderCondition(1);
        getOrderCondition(2);
        getOrderCondition(3);
        getNameProduct();
    </script>
</body>

</html>