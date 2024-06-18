<?php

class Product {
    private  $productName;
    private  $productPrice;
    private  $productId;
    private  $productImg;
    private  $type;
    private  $trademark;
    private  $state;
    private  $quantityInStore;

    public function __construct($productName, $productPrice, $productId, $productImg, $type, $trademark, $state, $quantityInStore) 
    {
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productId = $productId;
        $this->productImg = $productImg;
        $this->type = $type;
        $this->trademark = $trademark;
        $this->state = $state;
        $this->quantityInStore = $quantityInStore;
    }
    

    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of productPrice
     */ 
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set the value of productPrice
     *
     * @return  self
     */ 
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of productImg
     */ 
    public function getProductImg()
    {
        return $this->productImg;
    }

    /**
     * Set the value of productImg
     *
     * @return  self
     */ 
    public function setProductImg($productImg)
    {
        $this->productImg = $productImg;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of trademark
     */ 
    public function getTrademark()
    {
        return $this->trademark;
    }

    /**
     * Set the value of trademark
     *
     * @return  self
     */ 
    public function setTrademark($trademark)
    {
        $this->trademark = $trademark;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of quantityInStore
     */ 
    public function getQuantityInStore()
    {
        return $this->quantityInStore;
    }

    /**
     * Set the value of quantityInStore
     *
     * @return  self
     */ 
    public function setQuantityInStore($quantityInStore)
    {
        $this->quantityInStore = $quantityInStore;

        return $this;
    }

    public function display($status = 0)
    {
        $typeName = CategoryDAO::getCateName($this->getType());
        $brandName = BrandDAO::getBrandName($this->getTrademark());
        
        return "<tr>
                    <td>".$this->getProductId()."</td>
                    <td><img src='".$this->getProductImg()."' style='width:50%'></td>
                    <td>".$this->getProductName()."</td>
                    <td>".$typeName."</td>
                    <td>".$brandName."</td>
                    <td>".number_format($this->getProductPrice(), 0, ',', '.')."đ</td>
                    <td>".$this->getQuantityInStore()."</td>
                    <td>".$this->getState()."</td>
                    <td><i class='uil uil-edit-alt text-center icon-edit' onclick='editProduct(\"".$this->getProductId()."\", \"".$this->getType()."\");'></i></td>
                    <td><i onclick='deleteProduct(\"".$this->getProductId()."\")' class='uil uil-trash-alt text-center icon-trash'></i></td>
             </tr>";
    }
    public function displayForProductPage()
    {
        // $typeName = CategoryDAO::getCateName($this->getType());
        // $brandName = BrandDAO::getBrandName($this->getTrademark());
        return "<div class='filter_product' id='product'>
                             <a href='chitietsp.php?dataId=".$this->getProductId()."&dataType=".$this->getType()."&&trademark=".$this->getTrademark()."''>
                                <div class='product'>
                                    <div><img style='margin-left:14px;margin-top:14px' src=".$this->getProductImg()." alt=''></div>
                                    <div class='product-random-info'>
                                        <div class='product_name'><h2 style='font-size: 14px; color:black'>".$this->getProductName()."</h2></div>
                                        <div class='product_cost' style='color:red;'>".number_format($this->getProductPrice(), 0, ',', '.')." đ</div>
                                    </div>
                                 </div>
                             </a>
                         </div>";
    }

    public function displayInUpdatePage() {
        $typeName = CategoryDAO::getCateName($this->getType());
        $brandName = BrandDAO::getBrandName($this->getTrademark());
        return "<tr>
                    <td>".$this->getProductId()."</td>
                    <td>".$this->getProductName()."</td>
                    <td>".$typeName."</td>
                    <td>".$brandName."</td>
                    <td>".$this->getQuantityInStore()."</td>
                    <td>".$this->getState()."</td>
             </tr>";
    }

    public function displayNameProductOption() {
        return "<option id='".$this->getType()."-".$this->getTrademark()."' 
        class='item' value='".$this->getProductId()."'>".$this->getProductName()."</option>";
    }
}

class ProductUI {
    public static function renderForProductPage($displayProductArray, $page, $limit) {
        $s = '';
        $length = count($displayProductArray);
        for($i = ($page-1)*$limit; ($i < $limit*$page) && ($i<$length); $i++) {
            $s .= $displayProductArray[$i]->displayForProductPage();
        }
        return $s;
    }

    public static function renderWithCondition($displayProductArray, $page, $limit, $status = 0) {
        $s = '';
        $length = count($displayProductArray);
        for($i = ($page-1)*$limit; ($i < $limit*$page) && ($i<$length); $i++) {
            $s .= $displayProductArray[$i]->display($status);
        }
        return $s;
    }

    public static function renderNameProductOption($displayProductArray) {
        $s = '<option value="none" hidden selected disabled>Product Name</option>';
        foreach($displayProductArray as $value) {
            $s .= $value->displayNameProductOption();
        }
        return $s;
    }
}


class ProductDAO {
    
    public static function rowCounting() {
        return countResult('SELECT * FROM SANPHAM');
    }

    public static function typeFilter($typeConditions) {
        $str = '';
        if(count($typeConditions) > 0) {
            $str .= 'THELOAI = '.$typeConditions[0].' ';
            for($i = 1; $i < count($typeConditions); $i++) {
                $str .= 'OR THELOAI = '.$typeConditions[$i].' ';
            }
        }
        return $str;
    }

    public static function trademarkFilter($trademarkConditions) {
        $str = '';
        if(count($trademarkConditions) > 0) {
            $str .= 'THUONGHIEU = '.$trademarkConditions[0].' ';
            for($i = 1; $i < count($trademarkConditions); $i++) {
                $str .= 'OR THUONGHIEU = '.$trademarkConditions[$i].' ';
            }
        }
        return $str;
    }

    public static function searchByName($keyword) {
        $str = '';
        if($keyword) {
            $str = 'TENSP LIKE \'%'.$keyword.'%\' ';
        }
        return $str;
    }

    public static function getData($page, $rows, $conditions = array('type' => array(), 'trade' => array()),
                                    $keyword = '') {
        $sqlTypeCon = '';
        $sqlTMCon = '';
        $sqlKeywordCon = self::searchByName($keyword);
        $limit = ($page - 1) * $rows;
        if($conditions['type'] != array()) {
            $sqlTypeCon = self::typeFilter($conditions['type']);           
        }
        if($conditions['trade'] != array()) {
            $sqlTMCon = self::trademarkFilter($conditions['trade']);
        }
        $sqlCond = $sqlTypeCon."".$sqlTMCon."".$sqlKeywordCon ?: '1=1';
        $sql = "SELECT *, (SELECT ha.LINK
                            FROM HINHANH ha
                            WHERE ha.MASP = sp.MASP LIMIT 1
                                    ) as LINK
        FROM SANPHAM sp
        WHERE $sqlCond LIMIT $limit, " . $rows;
        $listProduct = executeResult($sql);
        foreach($listProduct as $product) {
            $x = new Product($product['TENSP'], $product['GIA'], $product['MASP'], $product['LINK'],
                            $product['MATL'], $product['MATH'], $product['TRANGTHAI'], $product['SLTON']);
            $productArray[] = $x;
        }
        return $productArray;
    }

    public static function getAllProduct() {
        $sql = "SELECT *, (SELECT ha.LINK
                            FROM HINHANH ha
                            WHERE ha.MASP = sp.MASP LIMIT 1
                                    ) as LINK
                FROM SANPHAM sp";
        $tmpArray = array();
        $listProduct = executeResult($sql);
        foreach($listProduct as $product) {
            $x = new Product($product['TENSP'], $product['GIA'], $product['MASP'], $product['LINK'],
                            $product['MATL'], $product['MATH'], $product['TRANGTHAI'], $product['SLTON']);
            $tmpArray[] = $x;
        }
        return $tmpArray;
    }

    public static function getProductByCondition($type = '', $brand = '', $keyword = '') {
        $array = array();
        foreach(self::getAllProduct() as $value) {
            if(str_contains($type, $value->getType()) || str_contains($brand, $value->getTrademark()) || str_contains($value->getProductName(), $keyword)) {
                $array[] = $value;
            }
        }
        return $array;
    }


    public static function filterByType($productArray, $typeArray = array()) {
        $tmpArray = array();
        if(($typeArray[0]) == 'undefined' || $typeArray[0] == '') {
            $tmpArray = $productArray;
        } else {
            foreach($productArray as $value) {
                if(in_array($value->getType(), $typeArray)) {
                    $tmpArray[] = $value;
                }
            }
        }
        return $tmpArray;
    }

    public static function filterByBrand($productArray, $brandArray = array()) {
        $tmpArray = array();
        if(($brandArray[0]) == 'undefined' || $brandArray[0] == '') {
            $tmpArray = $productArray;
        } else {
            foreach($productArray as $value) {
                if(in_array($value->getTrademark(), $brandArray)) {
                    $tmpArray[] = $value;
                }
            }
        }
        return $tmpArray;
    }

    public static function filterByKeyword($productArray, $keyword = '') {
        $tmpArray = array();
        if($keyword == 'undefined' || $keyword == '') {
            $tmpArray = $productArray;
        } else {
            foreach($productArray as $value) {
                if(str_contains(strtoupper($value->getProductName()), strtoupper($keyword))) {
                    $tmpArray[] = $value;
                }
            }
        }
        return $tmpArray;
    }

    public static function filterByPrice($productArray, $from = 0, $to = 0) {
        $tmpArray = array();
        if($to == 0) {
            $tmpArray = $productArray;
        } else {
            foreach($productArray as $value) {
                if($value->getProductPrice() >= $from && $value->getProductPrice() <= $to) {
                    $tmpArray[] = $value;
                }
            }
        }
        return $tmpArray;
    }


    public static function filterAdvanced($typeArray = array(), $brandArray = array(), $keyword = '') {
        return self::filterByKeyword(self::filterByType(self::filterByBrand(ProductDAO::getAllProduct(),$brandArray),$typeArray),$keyword);
    }

    public static function rowCountingWithCondition($typeArray = array(), $brandArray = array(), $keyword = '') {
        return count(self::filterAdvanced($typeArray, $brandArray, $keyword));
    }

    public static function filterAdvancedForProductPage($typeArray = array(), $brandArray = array(), $keyword = '', $from = 0, $to = 0) {
        return self::filterByKeyword(self::filterByType(self::filterByBrand(self::filterByPrice(ProductDAO::getAllProduct(), $from, $to),$brandArray),$typeArray),$keyword);
    }

    public static function rowCountingWithConditionProductPage($typeArray = array(), $brandArray = array(), $keyword = '', $from = 0, $to = 0) {
        return count(self::filterAdvancedForProductPage($typeArray, $brandArray, $keyword, $from, $to));
    }

    public static function getProductById($id) {
        $sql = sprintf("Select * from SANPHAM where MASP LIKE '%s'", $id);
        $product = executeResult($sql, true);
        $x = new Product($product['TENSP'], $product['GIA'], $product['MASP'], $product['LINK'],
                            $product['MATL'], $product['MATH'], $product['TRANGTHAI'], $product['SLTON']);
        return $x;
    }

    public static function deleteProduct($id) {
        $sql = "Select * from CTDH where masp = '".$id."'";
        $result = checkExists($sql);
        if(mysqli_num_rows($result) == 0) {
            $sql1 = "DELETE FROM HINHANH WHERE MASP = '".$id."'";
            $sql2 = "DELETE FROM PHUKIEN WHERE MASP = '".$id."'";
            $sql3 = "DELETE FROM THIETBIDD WHERE MASP = '".$id."'";
            $sql4 = "DELETE FROM LAPTOP WHERE MASP = '".$id."'";
            $sql5 = "DELETE FROM GIOHANG WHERE MASP = '".$id."'";
            $sql6 = "DELETE FROM SANPHAM WHERE MASP = '".$id."'";
            execute($sql1);
            execute($sql2);
            execute($sql3);
            execute($sql4);
            execute($sql5);
            execute($sql6);
            echo 1;
        } else {
            echo 0;
        }
    }
    // Thêm sản phẩm vào giỏ hàng
    public static function AddCart($idP){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        $sql="INSERT INTO giohang(MASP,MAKH,SOLUONG) VALUES ('$idP',$idC,1) ON DUPLICATE KEY UPDATE SOLUONG = SOLUONG+1";
        execute($sql);
        // $query = $conn->query($sql);
        mysqli_close($conn);
    }

    public static function updateQuantity($idProductArr, $qtyArr) {
        $length = count($idProductArr);
        for($i = 0; $i < $length; $i++) {
            $sql = "Update SANPHAM set SLTON = SLTON + ".$qtyArr[$i]." where MASP = '".$idProductArr[$i]."'";
            execute($sql);
        }
    }


    

}

?>