<?php
// require_once('../db/dbhelper.php');
// require_once('../util/utility.php');
// require_once('./productuser.php');

use JetBrains\PhpStorm\ArrayShape;
use LDAP\Result;

class ShoppingCart {
    // private $productID;
    // private $customerID;
    private  $productName;
    private  $productPrice;
    private  $productId;
    private  $productImg;
    private $quantity;
    public function __construct($productName, $productPrice, $productId, $productImg,$quantity) 
    {
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productId = $productId;
        $this->productImg = $productImg;
        $this->quantity = $quantity;
    }

    // public function getProductID(){
    //     return $this->productID;
    // }
    // public function setProductID($productID){
    //     $this->productID = $productID;
    //     return $this;
    // }
    // public function getCustomerID(){
    //     return $this->customerID;
    // }
    // public function setCustomerID($customerID){
    //     $this->customerID = $customerID;
    //     return $this;
    // }
    public function getQuantity(){
        return $this->quantity;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        return $this;
    }
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
    public function display(){
        return '
            <tr>
                <td style="width: 50px" onclick="total();">
                    <input class="" type="checkbox" name="check[]" value="'.$this->getProductID().'">
                </td>
                <td style="display: flex; width: 400px">
                        <img src="'.$this->getProductImg().'" alt="">
                        <p>'.$this->getProductName().'</p>
                </td>
                <td>'.number_format($this->getProductPrice(), 0, ',', '.').' VND</td>
                <td>
                    <button onclick="subtract(\''.$this->getProductID().'\')">-</button>
                    <input style="width: 40px;height: 20px; text-align: center;" type="text" name="" id="quantityProduct" value="'.$this->getQuantity().'">
                    <button onclick="add(\''.$this->getProductID().'\')">+</button>
                </td>
                <td> <input class="PriceProduct" type="text" name = "totalP[]" value="'.$this->getProductPrice()*$this->getQuantity().'"></td>
                <td class="delete" onclick="deleteProduct(\''.$this->getProductID().'\')">Xóa</td>
            </tr>
        ';
    }
}
class ShoppingCartUI{
    public static function Render(){
        $s = '';
        foreach(ShoppingCartDAO::getData() as $element) {
            $s .= $element->display();
        }
        if($s ==''){
            
        }else{
            echo $s ;
        }
    }
}   
class ShoppingCartDAO{
    public static function getData(){
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "SELECT sanpham.TENSP, sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH=$idC) GH ON GH.MASP = sanpham.MASP;";
        $query = $conn->query($sql);
        $productArray = array();
        while($product = $query->fetch_assoc()) {
            $tmp = $product['MASP'];
            $sqlha = "SELECT LINK FROM hinhanh WHERE MASP = '$tmp'  LIMIT 1";
            $hinhanh = mysqli_query($conn, $sqlha);
            $link = mysqli_fetch_row($hinhanh);
            $x = new ShoppingCart($product['TENSP'],$product['GIA'],$product['MASP'],$link[0],$product['SOLUONG']);
            $productArray[] = $x;
        }
        mysqli_close($conn);
        return $productArray;
    }
    public static function addition($idP){
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "UPDATE giohang SET SOLUONG = SOLUONG + 1 WHERE MASP='$idP' AND MAKH =$idC ";
        $query = $conn->query($sql);
    }
    public static function subtraction($idP){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        $select = "SELECT SOLUONG FROM giohang WHERE MASP ='$idP' AND MAKH = $idC";
        $tmp = mysqli_query($conn, $select);
        $quantity = mysqli_fetch_row($tmp);;
        if($quantity[0] > 1){
            $sql = "UPDATE giohang SET SOLUONG = SOLUONG - 1 WHERE MASP='$idP' AND MAKH =$idC";
            execute($sql);
        }else{
            self::delProduct($idP);
        }
    }
    public static function delProduct($idP){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "DELETE FROM giohang WHERE MASP='$idP' AND MAKH =$idC ";
        execute($sql);
    }
}
