<?php
class TypeBrand {
    private $typeId;
    private $brandId;

    public function __construct($typeId, $brandId) {
        $this->typeId = $typeId;
        $this->brandId = $brandId;
    }

    /**
     * Get the value of typeId
     */ 
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set the value of typeId
     *
     * @return  self
     */ 
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
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
     * Display typeName or brandName
     * 
     * @param string $status decide what is displayed
     * @return string html string
     */
    public function display($status = 0) {
        $typeName = CategoryDAO::getCateName($this->getTypeId());
        $brandName = BrandDAO::getBrandName($this->getBrandId());
        $strArr = [
            "<option value='".$this->getTypeId()."'>".$typeName."</option>",
            "<option value='".$this->getBrandId()."'>".$brandName."</option>"
        ];
        return $strArr[$status];
    }

    public function displayType2() {
        $brandName = BrandDAO::getBrandName($this->getBrandId());
        return "<input type='checkbox' class='brand_productpage' name='' value='".$this->getBrandId()."'
                id='".$this->getBrandId()."'>
                <label for='".$this->getBrandId()."'>".$brandName."</label><br>";
    }

}

class TypeBrandUI {
    public static function render($typeId = '', $status) {
        $s = '<option value="none" hidden selected disabled>Choose Brand</option>';
        foreach(TypeBrandDAO::getBrandByType($typeId) as $value) {
            $s .= $value->display($status);
        }
        return $s;
    }
    
    public static function renderCheckbox($typeId = '') {
        $s = '';
        foreach(TypeBrandDAO::getBrandByType($typeId) as $value) {
            $s .= $value->displayType2();
        }
        return $s;

    }
}

class TypeBrandDAO {
    public static function getBrandByType($typeId = '') {
        $tmpArray = array();
        if($typeId != '') {
            $sql = "SELECT * FROM TLTH WHERE MATL = '".$typeId."'";
        } else {
            $sql = "SELECT distinct MATH FROM TLTH";
        }
        $list = executeResult($sql);
        foreach($list as $value) {
            $tmpArray[] = new TypeBrand($value['MATL'], $value['MATH']);
        }
        return $tmpArray;
    }  
}
?>