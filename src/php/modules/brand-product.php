<?php

class Brand {
    private $brandId;
    private $brandName;

    public function __construct($brandId, $brandName)
    {
        $this->brandId = $brandId;
        $this->brandName = $brandName;
    }
    

    /**
     * Get the value of brandId
     */ 
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set the value of brandId
     *
     * @return  self
     */ 
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * Get the value of brandName
     */ 
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Set the value of brandName
     *
     * @return  self
     */ 
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTypeId($typeId){
        $this->typeId = $typeId;

        return $this;
    }
    public function display($positionPage) {
        return "<div><input type='checkbox' name='brand".$positionPage."' class='brand".$positionPage."'
                id='".$this->getBrandId()."-brand-".$positionPage."' value='".$this->getBrandId()."'>
                <label for='".$this->getBrandId()."-brand-".$positionPage."'>".$this->getBrandName()."
                </label></div>";
    }

    public function displayName(){
        return "<li><a href='sanpham.php?datatype=".$this->getTypeId().
            "&trademark=".$this->getBrandId()."'>".$this->getBrandName()."</a></li>";
    }
}

class BrandUI {

    public static function render($positionPage) {
        $brandArray = BrandDAO::getData();   
        $html = '';
        foreach($brandArray as $value) {
            $html .= $value->display($positionPage);
        }
        return $html;
    }

    // public static function renderName($type = 0) {
    //     $typeArray = array('Phone','Laptop','Tablet','Phukien');
    //     $brandArray = BrandDAO::getTypeBrand($typeArray[$type]);   
    //     $html = '';
    //     foreach($brandArray as $value) {
    //         $html .= $value->displayName();
    //     }
    //     return $html;
    // }

    // public static function renderTypeMark($type = 0){
    //     $typeArray = array('Phone','Laptop','Tablet','Phukien');
    //     $markArray = BrandDAO::getTypeBrand($typeArray[$type]);   
    //     $html = '';
    //     foreach($markArray as $value) {
    //         $html .= $value->displayName();
    //     }
    //     return $html;
    // }
}


class BrandDAO {
    public static function getData() {
        $sql = "SELECT * FROM THUONGHIEU";
        $list = executeResult($sql);
        $brandArray = array();
        if($list){
            foreach($list as $value) {
                $brandArray[] = new Brand($value['MATH'], $value['TENTH']);
            }
        }
        return $brandArray;
    }

    // public static function getTypeMark($type = 0){
    //     $typeArray = array('Phone','Laptop','Tablet','Phukien');
    //     $markArray = BrandDAO::getTypeBrand($typeArray[$type]);
    //     return $markArray;
    // }

    // public static function getTypeBrand($typeArray) {
    //     $sql = "SELECT * FROM tlth tlth JOIN THUONGHIEU th ON tlth.MATH = th.MATH WHERE MATL = '$typeArray'";
    //     $list = executeResult($sql);
    //     $brandArray = array();
    //     if($list){
    //         foreach($list as $value) {
    //             $brandArray[] = new Brand($value['MATH'], $value['TENTH'], $value['MATL']);
    //         }
    //     }
    //     return $brandArray;
    // }

    public static function getbrandName($id) {
        if($id) {
            $sql = "SELECT * FROM THUONGHIEU WHERE MATH = '$id'";
            $list = executeResult($sql, true);
            return $list['TENTH'];
        }
        return $id;
    }

    public static function rowCounting() {
        return countResult("SELECT * FROM THUONGHIEU");
    }

    

    
}