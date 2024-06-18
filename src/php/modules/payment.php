<?php

use function PHPSTORM_META\sql_injection_subst;

class Payment {
    
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
        <div class="TT__product-c">
            <div class="TT__product-img" style="width: 80px;">
                <img src="'.$this->getProductImg().'" alt="">
            </div>
            <div class="TT__product-name" style="width: 580px; padding-left: 20px;">
                <p>'.$this->getProductName().'</p>
            </div>
            <div class="TT__product-price" id="TT__product-price" style="width: 160px; text-align: center;" >
                <p>'.$this->getProductPrice().'</p>
            </div>
            <div class="TT__product-amount" style="width: 125px; text-align: center;">
                <p>'.$this->getQuantity().'</p>
            </div>
            <div class="TT__product-tp" style="width: 255px; text-align: center;">
                <p>'.(int)$this->getProductPrice()*(int)$this->getQuantity().'</p>
            </div>
        </div>
        ';
    }
}
class ShipmetnDetails{
    private $customerName;
    private $customerPhone;
    private $customerAddress;
    
    public function __construct($customerName,$customerPhone,$customerAddress){
        $this->customerName = $customerName;
        $this->customerPhone = $customerPhone;
        $this->customerAddress = $customerAddress;
    }
    public function getCustomerName(){
        return $this->customerName;
    }
    public function setCUstomerName($customerName){
        $this->customerName = $customerName;
        return $this;
    }
    public function getCustomerPhone(){
        return $this->customerPhone;
    }
    public function setCUstomerPhone($customerPhone){
        $this->customerPhone = $customerPhone;
        return $this;
    }
    public function getCustomerAddress(){
        return $this->customerAddress;
    }
    public function setCUstomerAddress($customerAddress){
        $this->customerAddress = $customerAddress;
        return $this;
    }
    public function displayShip(){
        return '
        <form action="" class="TT__form-db">
            <input type="text" name="customername" id="TT__form-name" value="'.$this->getCustomerName().'" placeholder="Họ tên">
            <br>
            <input type="text" name="customerphone" id="TT__form-phone" value="'.$this->getCustomerPhone().'" placeholder="Số điện thoại">
            <br>
            <input type="text" name="customremail" id="TT__form-address" value="'.$this->getCustomerAddress().'" placeholder="Địa chỉ"> 
        </form>
        ';
    }
    public function displayAddress(){
        return '
            <div class="df-name">
                '.$this->getCustomerName().'
            </div>
            <div class="df-phone">
                0'.$this->getCustomerPhone().'
            </div>
            <div class="df-address">
                '.$this->getCustomerAddress().'
            </div>
        ';
    }
}
class PaymentUI{
    public static function Render(){
        
        $total = 0;
        if(PaymentDAO::getData()!=null){
            $s = '';
            foreach(PaymentDAO::getData() as $element) {
                $s .= $element->display();
                $total = $total + (int)$element->getQuantity()*(int)$element->getProductPrice();
            }
            
                echo $s;
                echo '
                    <br>
                    <div class="TT__thanhtoan">
                            <div class="TT__tt-tongthanhtoan">
                                <div class="tt-tongtthanhtoan">Tổng tiền: </div>
                                <div class="tt-tongtt">'.$total.'</div>
                            </div>
                            <button class="TT__tt-muahang" onclick="thanhtoan();">
                                Đặt hàng
                            </button>
                    </div>
                ';
        }else {
            if($total==0){
                echo '<div class="TT__thanhtoan-rong"> 
                        <div class="TT__rong-item1"> <img src="https://cdn-icons-png.flaticon.com/512/645/645652.png" alt=""> </div>
                        <div class="TT__rong-item2"> Mời bạn chọn sản phẩm </div>
                </div>';
            }
        }
    }
    public static function renderEditAddress(){
        $s = '';
        foreach(PaymentDAO::getDataAddress() as $element) {
            $s .= $element->displayShip();
        }
        echo $s;
    }
    public static function renderAddress(){
        $s = '';
        foreach(PaymentDAO::getDataAddress() as $element) {
            $s .= $element->displayAddress();
        }
        echo $s;
    }
}
class PaymentDAO{

    public static function getData(){
        $productArr =array();
       
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        if(isset($_COOKIE['productIDArray'])){
            $i = 0;
            foreach($_COOKIE['productIDArray'] as $index => $values){
                $productArr[$i] = $values ;
                $i++;
            }
            $productArray = array();
            for($i = 0, $n = count($productArr); $i < $n; $i = $i + 1){
                $idP = $productArr[$i] ; 
                $sql = "SELECT sanpham.TENSP, sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH=$idC) GH 
                    ON GH.MASP = sanpham.MASP AND GH.MASP = '$idP';";
                $query = executeResult($sql);
                foreach($query as $product){
                    $tmp = $product['MASP'];
                    $sqlha = "SELECT LINK FROM hinhanh WHERE MASP = '$tmp'  LIMIT 1";
                    $queryha = executeResult($sqlha);
                    foreach($queryha as $link){
                        $l = $link['LINK'];
                    }
                    $x = new Payment($product['TENSP'],$product['GIA'],$product['MASP'],$l,$product['SOLUONG']);
                }
                if(isset($x)){
                    $productArray[$i] = $x;
                }
            }
            // if(!isset($x)){
            //     $x = new Payment('','','','https://cdn-icons-png.flaticon.com/512/869/869129.png','');
            //     $productArray[$i] = $x;
            // }
            return $productArray;
        }else{
            if(isset($_COOKIE['productIDBuyNow'])){
                $productArray = array();
                $i=0;
                $idP = $_COOKIE['productIDBuyNow'];
                $sql = "SELECT sanpham.TENSP, sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH=$idC) GH 
                        ON GH.MASP = sanpham.MASP AND GH.MASP = '$idP';";
                $query = executeResult($sql);
                foreach($query as $product){
                    $tmp = $product['MASP'];
                    $sqlha = "SELECT LINK FROM hinhanh WHERE MASP = '$tmp'  LIMIT 1";
                    $queryha = executeResult($sqlha);
                    foreach($queryha as $link){
                        $l = $link['LINK'];
                    }
                    $x = new Payment($product['TENSP'],$product['GIA'],$product['MASP'],$l,$product['SOLUONG']);
                }
                if(isset($x)){
                    $productArray[$i] = $x;
                }
                // else{
                //     $x = new Payment('','','','https://i.pinimg.com/564x/b1/d7/d0/b1d7d0ee19e211ddbfeda8d1177df84b.jpg','');
                //     $productArray[$i] = $x;
                // }
                return $productArray;
            }
        }
       
    }
    public static function getDataAddress(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "SELECT khachhang.HOTEN, khachhang.SODT, diachi.DIACHI FROM khachhang, diachi WHERE khachhang.MAKH= '$idC' ";
        $query = executeResult($sql);
        $customer = array();
        foreach($query as $address){
            $x = new ShipmetnDetails($address['HOTEN'],$address['SODT'],$address['DIACHI']);
            $customer[] = $x;
        }
        return $customer;
    }
    public static function changeAddress($name,$phone,$address){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "UPDATE diachi, khachhang SET DIACHI = '$address',SODT='$phone',HOTEN = '$name' WHERE diachi.MAKH = '$idC' AND khachhang.MAKH='$idC'";
        execute($sql);
    }
    public static function checkQuantity($idP,$quantity){
        $sql = "SELECT MASP,SLTON FROM sanpham";
        $query = executeResult($sql);
        foreach($query as $product){
            if($idP==$product['MASP'] && $quantity > $product['SLTON']){
                return false;
            }
        }
        return true;
    }
    public static function AlertQuantity(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        
        if(isset($_COOKIE['productIDArray'])){
            foreach($_COOKIE['productIDArray'] as $index => $values){
                $sql = "SELECT SOLUONG,MAKH,giohang.MASP,sanpham.TENSP,sanpham.SLTON FROM giohang,sanpham WHERE sanpham.MASP = giohang.MASP AND MAKH = '$idC' AND giohang.MASP='$values';" ;
                $query = executeResult($sql);
                foreach($query as $product){
                    if(PaymentDAO::checkQuantity($product['MASP'],$product['SOLUONG'])==false){
                        return (String)($product['TENSP'].','.$product['SLTON']);
                    }
                }
            }
        }
    
        if(isset($_COOKIE['productIDBuyNow'])){
            $idP = $_COOKIE['productIDBuyNow'];
            $sql = "SELECT SOLUONG,MAKH,giohang.MASP,sanpham.TENSP,sanpham.SLTON FROM giohang,sanpham WHERE sanpham.MASP = giohang.MASP AND MAKH = '$idC' AND giohang.MASP='$idP';"; 
            $query = executeResult($sql);
            foreach($query as $product){
                if(PaymentDAO::checkQuantity($product['MASP'],$product['SOLUONG'])==false){
                    return (String)($product['TENSP'].','.$product['SLTON']);
                }
            }
        }
        return '';
    }
    public static function pay(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        if(isset($_COOKIE['productIDArray'])){
            $total = 0;
            // $id = strtoupper(substr(md5($idC.microtime().rand(1,10)), -10));
            $id = floor(date_timestamp_get(date_create()));
            foreach($_COOKIE['productIDArray'] as $index => $values){
                $sql = "SELECT sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH='$idC') GH 
                ON GH.MASP = sanpham.MASP AND GH.MASP = '".$values."';";
                $query = executeResult($sql);
                foreach($query as $product){
                    $total = (int)$product['GIA']*(int)$product['SOLUONG'] + $total;
                }
            }
            $sqlDH = "INSERT INTO DONHANG(MADH,MAKH,THANHTIEN,NGAYDAT,TRANGTHAI) VALUES('$id','$idC','$total',CURRENT_DATE,'Đang xử lý')";
            execute($sqlDH);
            foreach($_COOKIE['productIDArray'] as $index => $values){
                $sql = "SELECT sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH=$idC) GH 
                ON GH.MASP = sanpham.MASP AND GH.MASP = '$values';";
                $query = executeResult($sql);
                foreach($query as $product){
                    $quantity = $product['SOLUONG'];
                    $sqlCTDH = "INSERT INTO ctdh(MADH,MASP,SOLUONG) VALUES('$id','$values','$quantity')";
                    execute($sqlCTDH);
                    $sqlProduct = "UPDATE sanpham SET SLTON=SLTON-$quantity WHERE MASP = '$values'";
                    execute($sqlProduct);
                }
            }
            foreach($_COOKIE['productIDArray'] as $index => $values){
                $sqlDEL = "DELETE FROM giohang WHERE MASP = '$values' AND MAKH = '$idC'";
                execute($sqlDEL);
            }
            if(isset($_COOKIE['productIDArray'])){
                foreach($_COOKIE['productIDArray'] as $name => $value ){
                    setcookie('productIDArray['.$name.']',$value,time()-4800,'/');
                }
            }
        }else{
            if(isset($_COOKIE['productIDBuyNow'])){
                $idP = $_COOKIE['productIDBuyNow'];
                $total = 0;
                $id = strtoupper(substr(md5($idC.microtime().rand(1,10)), -10));
                
                $sql = "SELECT sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH='$idC') GH 
                ON GH.MASP = sanpham.MASP AND GH.MASP = '$idP';";
                $query = executeResult($sql);
                foreach($query as $product){
                    $total = (int)$product['GIA']*(int)$product['SOLUONG'] + $total;
                }
                $sqlDH = "INSERT INTO donhang(MADH,MAKH,THANHTIEN,NGAYDAT,TRANGTHAI) VALUES('$id','$idC','$total',CURRENT_DATE,'Đang xử lý')";
                execute($sqlDH);
               
                    $sql = "SELECT sanpham.GIA, GH.SOLUONG, GH.MASP FROM sanpham JOIN (SELECT * FROM giohang WHERE MAKH=$idC) GH 
                    ON GH.MASP = sanpham.MASP AND GH.MASP = '$idP';";
                    $query = executeResult($sql);
                    foreach($query as $product){
                        $quantity = $product['SOLUONG'];
                        $sqlCTDH = "INSERT INTO ctdh(MADH,MASP,SOLUONG) VALUES('$id','$idP','$quantity')";
                        execute($sqlCTDH);
                        $sqlProduct = "UPDATE sanpham SET SLTON=SLTON-$quantity WHERE MASP = '$idP'";
                        execute($sqlProduct);
                    }
                
                    $sqlDEL = "DELETE FROM giohang WHERE MASP = '$idP' AND MAKH = '$idC'";
                    execute($sqlDEL);
                if(isset ($_COOKIE['productIDBuyNow'])){
                    setcookie('productIDBuyNow',$idP,time()-1,'/');
                }
            } 
        }
        header("Refresh:0");
    }
    public static function clearCookie(){
        if(isset ($_COOKIE['productIDArray'])){
            foreach($_COOKIE['productIDArray'] as $name => $value ){
                setcookie('productIDArray['.$name.']','',time()-4800,'/');
            }
        }    
    }

}