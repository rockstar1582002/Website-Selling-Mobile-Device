<?php
class Category {
    private $cateName;
    private $cateId;

    public function __construct($cateId, $cateName)
    {
        $this->cateId = $cateId;
        $this->cateName = $cateName;
    }

    /**
     * Get the value of cateName
     */ 
    public function getCateName()
    {
        return $this->cateName;
    }

    /**
     * Set the value of cateName
     *
     * @return  self
     */ 
    public function setCateName($cateName)
    {
        $this->cateName = $cateName;

        return $this;
    }

    /**
     * Get the value of cateId
     */ 
    public function getCateId()
    {
        return $this->cateId;
    }

    /**
     * Set the value of cateId
     *
     * @return  self
     */ 
    public function setCateId($cateId)
    {
        $this->cateId = $cateId;

        return $this;
    }

    public function display($positionPage) {
        return "<div><input type='checkbox' name='category".$positionPage."[]' class='category".$positionPage."'
                id='".$this->getCateId()."-category-".$positionPage."' value='".$this->getCateId()."'>
                <label for='".$this->getCateId()."-category-".$positionPage."'>".$this->getCateName()."
                </label></div>";
    }

    public function displayFormatSelection() {
        return "<option value='".$this->getCateId()."'>".$this->getCateName()."</option>";
            
    }

    public function displayNameCate() {
        return '<div onclick="getDataByType('.$this->getCateId().')"></div>';
    }
}

class CategoryUI {
    public static function render($positionPage) {
        $categoryArray = CategoryDAO::getData();   
        $html = '';
        foreach($categoryArray as $value) {
            $html .= $value->display($positionPage);
        }
        return $html;
    }

    public static function renderFormatSelection($typeArr) {
        $html = '<option value="none" hidden selected disabled>Chọn Thể Loại</option>';
        foreach($typeArr as $value) {
            $html .= $value->displayFormatSelection();
        }
        return $html;
    }

    public static function renderName() {
        $categoryArray = CategoryDAO::getData();   
        $html = '';
        foreach($categoryArray as $value) {
            $html .= $value->displayNameCate();
        }
        return $html;
    }

}

class CategoryDAO {
    public static function getData() {
        $sql = "SELECT * FROM THELOAI";
        $list = executeResult($sql);
        $categoryArray = array();
        if($list) {
            foreach($list as $value) {
                $categoryArray[] = new Category($value['MATL'], $value['TENTL']);
            }
        }
        return $categoryArray;
    }

    public static function getCateName($id) {
        if($id) {
            $sql = "SELECT * FROM THELOAI WHERE MATL = '$id'";
            $list = executeResult($sql, true);
            return $list['TENTL'];
        }
        return $id;
    }

    public static function rowCounting() {
        return countResult("SELECT * FROM THELOAI");
    }
}

?>