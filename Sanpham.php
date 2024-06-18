<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>30 Stores</title>
    <link rel="stylesheet" href="./assets/css/sanpham.css">
    <link rel="stylesheet" href="./assets/css/style-menu-1.css">
    <link rel="stylesheet" href="./assets/css/style-menu-bottom.css">
    <link rel="stylesheet" href="./assets/css/style-footer.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <?php
    require_once('page/menu.php');
    require_once('page/menubar.php');
    ?>
    <div class="content">
        <div class="filter">
            <div class="left">
                <div class="header-left"><i class="uil uil-filter filter-icon"></i>
                    <div class="title-filter">Filter</div>
                </div>

                <div class='price'>
                    <div class="filter-price">Price</div>
                    <div class="price-input">
                        <div class="field">
                            <!-- <span>Min</span> -->
                            <input type="number" class="input-min" value="0" oninput="getConditions(<?= $_GET['type']; ?>)">
                        </div>
                        <div class="separator">-</div>
                        <div class="field">
                            <!-- <span>Max</span> -->
                            <input type="number" class="input-max" value="100000" oninput="getConditions(<?= $_GET['type']; ?>)">
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max="100000" value="0" step="100" onchange="getConditions(<?= $_GET['type']; ?>)">
                        <input type="range" class="range-max" min="0" max="100000" value="100000" step="100" onchange="getConditions(<?= $_GET['type']; ?>)">
                    </div>
                </div>

                <div>
                    <div class='filter-brand'>Producer</div>
                    <div class='brand-checkbox' id="filter__brand" onchange="getConditions(<?= $_GET['type']; ?>)">
                        
                    </div>
                </div>



            </div>
            <div class="right" id="Product" style="min-height: 600px">

            </div>
        </div>
        <div style="clear:both"></div>
        <div id="number_page_product" class="number__page__product">

        </div>
    </div>
    <?php
        require_once('page/footer.php');
    ?>
    <script>
        getBrandForProductPage(<?= $_GET['type']; ?>);
        getConditions(<?= $_GET['type']; ?>);
    </script>
</body>
<script src="./src/js/price-range-product.js"></script>
<script src="./src/js/controluser.js"></script>
</html>
