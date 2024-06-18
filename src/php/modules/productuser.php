<?php
class productuser {
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

        
        public function display(){

            return "<div class='telephone_item'>
                             <a href='chitietsp.php?dataId=".$this->getProductId()."&dataType=".$this->getType()."&&trademark=".$this->getTrademark()."' onclick='getDetailHTML()'>
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

        public function displayProductType(){
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

    }

    class ProductUserUI {
        public static function render($displayProductArray) {
            $str = "";
            foreach($displayProductArray as $value) {
                $str .= $value->display();
            }
            return $str;
        }

        public static function renderProduct($displayProductArray){
            $str = "";
            foreach($displayProductArray as $value) {
                $str .= $value->displayProductType();
            }
            return $str;
        }
    }
    
    class ProductUserDAO {
        public static function getRandomProduct($type = 0){
            $typeArray = array('Phone','Laptop','Tablet','Phukien');
            $productArray = ProductUserDAO::filterByType(ProductUserDAO::getAllProduct(),array($typeArray[$type]));
            $leng = count($productArray);
            $tmpArray = array();
            for($i = 0;$i < 5;$i++){
                $tmpArray[] = $productArray[rand(0,$leng - 1)];           
            }
            return $tmpArray;
        }
        public static function getProductType($type = 0){
            $typeArray = array('Phone','Laptop','Tablet','Phukien');
            $productArray = ProductUserDAO::filterByType(ProductUserDAO::getAllProduct(),array($typeArray[$type]));
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
                $x = new productuser($product['TENSP'], $product['GIA'], $product['MASP'], $product['LINK'],
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
                    if(str_contains($value->getProductName(), $keyword)) {
                        $tmpArray[] = $value;
                    }
                }
            }
            return $tmpArray;
        }

        public static function filterAdvanced($typeArray = array(), $brandArray = array(), $keyword = '') {
            return self::filterByKeyword(self::filterByType(self::filterByBrand(ProductUserDAO::getAllProduct(),$brandArray),$typeArray),$keyword);
        }
    
        public static function rowCountingWithCondition($typeArray = array(), $brandArray = array(), $keyword = '') {
            return count(self::filterAdvanced($typeArray, $brandArray, $keyword));
        }

    }
?>