<?php
class OrderDetail {
    private $orderId;
    private $productId;
    private $quantity;
    private $productName;
    private $type;
    private $trademark;

    private $singlePrice;


    public function __construct($productId, $quantity) {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }
    
    /**
     * Get the value of orderId
     */ 
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the value of orderId
     *
     * @return  self
     */ 
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

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
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

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
     * Get the value of singlePrice
     */ 
    public function getSinglePrice()
    {
        return $this->singlePrice;
    }

    /**
     * Set the value of singlePrice
     *
     * @return  self
     */ 
    public function setSinglePrice($singlePrice)
    {
        $this->singlePrice = $singlePrice;

        return $this;
    }

    public function display() {
        // $typeName = CategoryDAO::getCateName($this->getType());
        // $brandName = BrandDAO::getBrandName($this->getTrademark());
        return "<tr class='text-center'>
               <td>".$this->getProductId()."</td>
               <td>".$this->getProductName()."</td>
               <td>".$this->getType()."</td>
               <td>".$this->getTrademark()."</td>
               <td>".$this->getQuantity()."</td>
               <td>".number_format(($this->getQuantity())*($this->getSinglePrice()), 0, ',', '.')." đ</td>
        </tr>";
    }

    public function displayOrderDetails() {
        $typeName = CategoryDAO::getCateName($this->getType());
        $brandName = BrandDAO::getBrandName($this->getTrademark());
        return
                "<tr>
                    <td>".$this->getProductId()."</td>
                    <td>".$this->getProductName()."</td>
                    <td>".$typeName."</td>
                    <td>".$brandName."</td>
                    <td>".$this->getSinglePrice()."</td>
                    <td>".$this->getquantity()."</td>
                </tr>";
    }
}

class OrderDetailUI {
    public static function renderWithCondition($orderDetailArr) {
        $s = '';
        $length = count($orderDetailArr);
        for($i = 0; $i<$length; $i++) {
            $s .= $orderDetailArr[$i]->display();
        }
        return $s;        
    }

    public static function renderOrderDetails($orderDetailArr) {
        $s = '';
        $length = count($orderDetailArr);
        for($i = 0; $i<$length; $i++) {
            $s .= $orderDetailArr[$i]->displayOrderDetails();
        }
        return $s;        
    }
}

class OrderDetailDAO {
    public static function getStatistic($start, $end) {
        
        // $start = '2022-04-09'; $end = '2022-06-08';
        $sql = sprintf("Select ct.MASP, Sum(SOLUONG) as totalqty from CTDH ct join DONHANG dh on ct.MADH = dh.MADH join Sanpham sp on sp.MASP = ct.MASP where dh.TRANGTHAI = 'Đã xử lý' and dh.ngaytt >= '%s' and dh.ngaytt <= '%s' group by ct.MASP", $start, $end);
        // $sql = "Select ct.MASP, Sum(SOLUONG) as totalqty from CTDH ct join DONHANG dh on ct.MADH = dh.MADH join Sanpham sp on sp.MASP = ct.MASP where dh.ngaytt >= '2022-04-09' and dh.ngaytt <= '2022-06-08' group by ct.MASP";
        $list = executeResult($sql);
        
        $data = array();
        foreach($list as $value) {
            $tmp = new OrderDetail($value['MASP'], $value['totalqty']);
            $product = ProductDAO::getProductById($value['MASP']);
            if($product != null) {
                $tmp->setProductName($product->getProductName());
                $tmp->setTrademark($product->getTrademark());
                $tmp->setType($product->getType());
                $tmp->setSinglePrice($product->getProductPrice());
            }
            // var_dump($tmp);
            $data[] = $tmp;
        }
        return $data;
    }

    

    public static function statisticAdvanced($start, $end, $typeArray = array(), $brandArray = array(), $keyword = '') {
        return ProductDAO::filterByKeyword(ProductDAO::filterByType(ProductDAO::filterByBrand(
            self::getStatistic($start, $end),$brandArray),$typeArray),$keyword);
            // return self::getStatistic();
    }

    public static function getOrderDetail($id) {
        $sql = sprintf("Select sp.masp, sp.tensp, sp.math, sp.matl, sp.gia, ct.soluong 
                from CTDH ct join Sanpham sp on sp.masp = ct.masp where ct.madh = '%s'", $id);
        $list = executeResult($sql);
        
        $data = array();
        foreach($list as $value) {
            $tmp = new OrderDetail($value['masp'], $value['soluong']);
            $tmp->setProductName($value['tensp']);
            $tmp->setTrademark($value['math']);
            $tmp->setType($value['matl']);
            $tmp->setSinglePrice($value['gia']);
            $data[] = $tmp;
        }
        return $data;
    }


    
}