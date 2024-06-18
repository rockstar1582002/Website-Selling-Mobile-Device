<?php
require_once '../db/dbhelper.php';
require_once '../util/utility.php';
require_once '../modules/product.php';
require_once '../modules/type-brand.php';
require_once '../modules/brand-product.php';
require_once '../modules/category-product.php';
$str1 = '';
$str2 = '';


$product = ProductDAO::getProductById($_POST['productId']);
$productType = $_POST['typeId'];
// $stringOptionBrands = TypeBrandUI::render($product->getType(), 1);
// $pos = strpos($stringOptionBrands, $product->getTrademark());
// $stringOptions = substr($stringOptionBrands, $pos) . $product->getTrademark() . "selected" . substr($stringOptionBrands, strlen($stringOptionBrands) - $pos);
$str1 = '<div class="mt-8">
            <label for="product-name">Product Name</label><br>
            <input type="text" id="product-name" name="productName" value="'.$product->getProductName().'" required><br>
        </div>
        <div class="mt-8">
            <label for="product-price">Price</label><br>
            <input type="text" id="product-price" name="productPrice" value="'.$product->getProductPrice().'" required><br>
        </div>
        <div class="input-select">
            <label for="product-name">Category</label>
            <input type="text" readonly  value="'.$product->getType().'">
        </div>
        <div class="edit_brand-status">
            <div class="input-select">
                <label for="product-name">Brand</label>
                <select name="productBrand" id="frm-select-brand" required style="padding:8px;">
                '.TypeBrandUI::render($product->getType(), 1).'
                </select>
            </div>
            <div class="input-select">
                <label for="">Status</label>
                <select name="statusProduct" id="" style="padding:8px;" required>
                    <option value="none" hidden selected disabled>Choose Status</option>
                    <option value="">In Stock</option>
                    <option value="">Stop Selling</option>
                </select>
            </div>
        </div>
        <div class="mt-8 edit-image-product">
            <input type="file" multiple class="input-file" name="files_edit[]">
        </div>';
if ($productType == 'Phone' || $productType == 'Tablet') {
    $sql2 = "Select * from thietbidd where masp='".$_POST['productId']."'";
    $result = executeResult($sql2, true);
    $infoArr = array($result['camtruoc'],$result['camsau'], $result['ktmanhinh'], $result['bonho'],
                $result['dungluongram'], $result['pin'], $result['hdh'], $result['chip'], $result['trongluong'], $$result['kichthuoc']);
    $str2 = json_encode($result);
} else if ($productType == 'Laptop') {
    $sql2 = "Select * from laptop where masp='".$_POST['productId']."'";
    $result = executeResult($sql2, true);
    $infoArr = array($result['ocung'],$result['carddohoa'], $result['loaicpu'], $result['hdh'],
                $result['congnghemh'], $result['trongluong'], $$result['kichthuoc']);
    $str2 = json_encode($result);
} else if ($productType == 'Phukien') {
    $sql2 = "Select * from phukien where masp='".$_POST['productId']."'";
    $result = executeResult($sql2, true);
    $infoArr = array($result['congsuat'],$result['daura'], $result['dauvao'], $result['hang']);
    $str2 = json_encode($result);
}
echo json_encode(array($str1, $str2));