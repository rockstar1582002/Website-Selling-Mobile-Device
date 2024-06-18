<?php
class Profile{
    private $name ;
    private $dob  ;
    private $phone;
    private $email;
    private $username;
    private $password;
    
    public function __construct($name,$dob,$phone,$email,$username,$password){
        $this->name = $name;
        $this->dob = $dob;
        $this->phone = $phone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function getDob(){
        return $this->dob;
    }
    public function setDob($dob){
        $this->dob = $dob;
        return $this;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function setPhone($phone){
        $this->phone = $phone;
        return $this;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    public function display(){
        return '
            <div class="c__name">
            '.$this->getName().'
            </div>
            <ul class="c__list">
                <li class="c__item">
                    <p>Sinh nhật  </p>
                    <i class="fas fa-birthday-cake"></i>
                    <p> '.$this->getDob().' </p>
                </li>
                <li class="c__item">
                    <p>Số điện thoại </p>
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <p>0'.$this->getPhone().'</p>
                </li>
                <li class="c__item">
                    <p>Email</p>
                    <i class="fas fa-envelope"></i>
                    <p> '.$this->getEmail().'</p>
                </li>
            </ul>
        ';
    } 
    public function displayEidt(){
        return '
            <div class="e__content-item">
                <label for="">Họ và tên</label> <br>
                <input type="text" name="" id="e__content-name" value=" '.$this->getName().'">
            </div>
            <div class="e__content-item">
                <label for="">Ngày sinh</label> <br>
                <input type="text" name="" id="e__content-dob" value="'.$this->getDob().'">
            </div>
            <div class="e__content-item">
                <label for="">Số điện thoại</label> <br>
                <input type="text" name="" id="e__content-phone" value="'.$this->getPhone().'">
            </div>
            <div class="e__content-item">
                <label for="">Email</label> <br>
                <input type="text" name="" id="e__content-email" value="'.$this->getEmail().'">
            </div>
        ';
    }
}
class Order{
    private $id ;
    private $date ;
    private $total;
    private $state;

    public function __construct($id,$date,$total,$state)
    {   
        $this->id = $id;
        $this->date = $date;
        $this->total = $total;
        $this->state = $state;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate($date){
        $this->date = $date ;
        return $this;
    }
    public function getTotal(){
        return $this->total;
    }
    public function setTotal($total){
        $this->total= $total ;
        return $this;
    }
    public function getState(){
        return $this->state;
    }
    public function setState($state){
        $this->state = $state;
        return $this;
    }
    public function displayOrder(){
        $s = '';
        if($this->getState()=="Đang xử lý"){
            $s = '<td class="cancelOrder" onclick="cancelOrder('.$this->getId().')">Hủy</td>';
        }else{
            $s = '<td><del>Hủy</del></td>';
        }
        return '
        <tr>
            <td>'.$this->getId().'</td>
            <td>'.$this->getDate().'</td>
            <td>'.number_format($this->getTotal()).' VNĐ</td>
            <td>'.$this->getState().'</td>
            <td class = "orderDetail" onclick="openDetailOrder('.$this->getId().')">Xem chi tiết</td>
            '.$s.'
        </tr>
        ';
    }
}
class ProfileUI{
    public static function Render(){
        $s = '';
        foreach(ProfileDAO::getData() as $element) {
            $s .= $element->display();
        }
        echo $s;
    }
    public static function RenderEdit(){
        $s = '';
        foreach(ProfileDAO::getData() as $element) {
            $s .= $element->displayEidt();
        }
        echo $s;
    }
    public static function RenderOrder(){
        $s = '';
        foreach(ProfileDAO::getDataOrder() as $element) {
            $s .= $element->displayOrder();
        }
        echo $s;
    }
    public static function RenderAvt(){
        $s = '';
        $s = ProfileDAO::getDataImage();
        echo '<img src="./uploads/'.$s.'" alt="">';
    }
}
class ProfileDAO{
    public static function getData(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $personArr = array();
        $sql = "SELECT * FROM khachhang WHERE MAKH = '$idC'";
        $query = executeResult($sql);
        foreach($query as $person){
            $x = new Profile($person['HOTEN'], $person['NGAYSINH'],$person['SODT'],$person['EMAIL'],'','');    
            $personArr[] = $x;
        }
        return $personArr;
    }
    public static function getDataOrder(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "SELECT MADH,NGAYDAT,THANHTIEN,TRANGTHAI FROM donhang ";
        $query = executeResult($sql);
        $orderArr = array();
        foreach($query as $order){
            $x = new Order($order['MADH'],$order['NGAYDAT'],$order['THANHTIEN'],$order['TRANGTHAI']);
            $orderArr[] = $x;
        }
        return $orderArr;
    }
    public static function editProfile($name, $dob, $phone, $email){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "UPDATE khachhang SET HOTEN='$name',NGAYSINH='$dob',SODT='$phone',EMAIL='$email' WHERE MAKH='$idC'";
        execute($sql);
    }
    public static function getDataImage(){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "SELECT file_name FROM images WHERE MAKH = '$idC' ORDER BY uploaded_on DESC  LIMIT 1";
        $query = executeResult($sql);
        $imageArr = array();
        foreach($query as $image){
            $x = $image['file_name'];
        }
        return $x;
    }
    public static function checkPass($password){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "SELECT PASSWORD FROM khachhang WHERE MAKH = '$idC'";
        $query = executeResult($sql);
        foreach($query as $pass){
            if($pass['PASSWORD'] == $password){
                return true;
            }
        }
        return false;       
    }
    public static function changePass($password){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        // $pass = md5($password);
        $sql = "UPDATE khachhang SET PASSWORD = '$password' WHERE MAKH='$idC' ";
        execute($sql);
    }
    public static function cancelOrder($idOrder){
        if(isset($_COOKIE['customerId'])){
            $idC = $_COOKIE['customerId'];
        }
        $sql = "UPDATE donhang SET TRANGTHAI='Đã hủy' WHERE MAKH = '$idC' AND MADH = '$idOrder'";
        execute($sql);
        $sqlProduct = "SELECT * FROM ctdh WHERE MADH = '$idOrder' ";
        $query = executeResult($sqlProduct);
        foreach($query as $product){
            $quantity = $product['SOLUONG'];
            $id = $product['MASP'];
            $sqlPro = "UPDATE sanpham SET SLTON= SLTON + $quantity WHERE MASP = '$id'";
            execute($sqlPro);
        }
    }
    public static function RenderOrderDetail($idOrder){
        $sql = "SELECT sanpham.TENSP , sanpham.GIA , ctdh.SOLUONG FROM ctdh,sanpham WHERE ctdh.MASP = sanpham.MASP AND ctdh.MADH = '$idOrder' ";
        $query = executeResult($sql);
        foreach($query as $order){
            echo '
               <tr>
                    <td>'.$order['TENSP'].'</td>
                    <td>'.number_format($order['GIA']).' VNĐ</td>
                    <td>'.$order['SOLUONG'].'</td>
               </tr>
            ';
        }
    }
}