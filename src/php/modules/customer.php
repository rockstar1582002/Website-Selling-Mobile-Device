<?php
class Customer {
    private $customerName;
    private $customerId;
    private $customerDob;
    private $customerPhone;
    private $customerEmail;
    private $customerState;
    private $password;
    private $type;
    private $question;
    private $answer;

    function __construct($customerId, $customerName, $customerPhone, $customerEmail, $customerDob, $customerState, $password, $type, $question, $answer){
        $this->customerId = $customerId;
        $this->customerName = $customerName;
        $this->customerPhone = $customerPhone;
        $this->customerEmail = $customerEmail;
        $this->customerDob = $customerDob;
        $this->customerState = $customerState;
        $this->password = $password;
        $this->type = $type;
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Get the value of customerEmail
     */ 
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set the value of customerEmail
     *
     * @return  self
     */ 
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Get the value of customerId
     */ 
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set the value of customerId
     *
     * @return  self
     */ 
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }
    public function getCustomerName(){
        return $this->customerName;
    }
    public function setCustomerName( $customerName){
        $this->customerName = $customerName ;
        return $this;
    }
    public function getCustomerDob(){
        return $this->customerDob;
    }
    public function setCustomerDob($customerDob){
        $this->customerDob = $customerDob ;
        return $this;
    }
    public function getCustomerPhone(){
        return $this->customerPhone;
    }
    public function setCustomerPhone($customerPhone){
        $this->customerPhone = $customerPhone ;
        return $this;
    }
    public function getCustomerState(){
        return $this->customerState;
    }
    public function setCustomerState($customerState){
        $this->customerState = $customerState ;
        return $this;
    }
    public function getQuestion(){
        return $this->question;
    }
    public function setQuetion($question){
        $this->question = $question;
        return $this;
    }
    public function getAnswer(){
        return $this->answer;
    }
    public function setAnswer($answer){
        $this->answer = $answer;
        return $this;
    }
    public function display($i){
        return '
        <tr>
            <td>  
                <input class="checkbox1" type="checkbox" id="" name="check[]" value="'.$this->getCustomerID().'" >
            </td>
            <td onclick="DelAllCus()">'.$i.'</td>
            <td>'.$this->getCustomerID().'</td>
            <td>'.$this->getCustomerName().'</td>
            <td>'.$this->getCustomerDob().'</td>
            <td>'.$this->getCustomerPhone().'</td>
            <td>'.$this->getCustomerEmail().'</td>
            <td>'.$this->getCustomerState().'</td>
            <th class="del-customer">
                <i class="fas fa-trash-alt"  onclick="delCustomer('.$this->getCustomerID().')" name="cusID" value="'.$this->getCustomerID().'"></i>
            </th>
            <th class="block-customer" >
                <i class="fas fa-lock" onclick="changestateCustomer('.$this->getCustomerID().')" name="cusID" value="'.$this->getCustomerID().'"></i>
            </th>
        </tr>
        ';
    }
}
class CustomerUI{
    public static function Render(){
        $s = '';
        $i=1;
        foreach(CustomerDAO::getData() as $element) {
            $s .= $element->display($i);
            $i++;
        }
        echo $s;
        // $x = new Customer(1,1,1,1,1,1);
        // echo $x->display();
    }
}


class CustomerDAO {
    public static function getData() {
        $sql = "SELECT * FROM KHACHHANG";
        $list = executeResult($sql);
        $tmpArray = array();
        foreach ($list as $row) {
            $tmpArray[] = new Customer($row['MAKH'], $row['HOTEN'], $row['SODT'], $row['EMAIL'], $row['NGAYSINH'],
                        $row['TRANGTHAI'], $row['PASSWORD'], $row['LOAI'], $row['CAUHOI'], $row['CAUTRALOI']);
        }
        return $tmpArray;
    }


    public static function login($email, $password) {
        $flag = 1;
        $cusArr = self::getData();
        if($email != '' && $password != '') {
            foreach ($cusArr as $value) {
                if($value->getCustomerEmail() == $email && $value->getPassword() == $password) {
                    if($value->getCustomerState() == "Bị chặn") {
                        $flag = 2;
                    } else {
                        if($value->getType() == 'customer') {
                            setcookie('fullname', $value->getCustomerName(), time() + 24*36000, '/');
                            setcookie('customerId', $value->getCustomerId(), time() + 24*36000, '/');
                            Header('Location: didongVN.php');
                            die();
                            break;
                        } else if($value->getType() == 'admin') {
                            setcookie('Fullname', $value->getCustomerName(), time() + 24*36000, '/');
                            setcookie('customerId', $value->getCustomerId(), time() + 24*36000, '/');
                            Header('Location: didongVN.php');
                            die();
                            break;
                        }
                    }
                    
                } else{
                    $flag = 0;
                }
            }
        }
        return $flag;
    }

    public static function retore($email, $question, $answer){
        $flag3 = true;
        $cusArr = self::getData();
        if($email != '' && $question != '' && $answer != ''){
            foreach($cusArr as $value) {
                if($value->getCustomerEmail() == $email && $value->getQuestion() == $question && $value->getAnswer() == $answer){
                    $sql = "UPDATE KHACHHANG SET PASSWORD = 'abc123456' WHERE EMAIL = '".$email."' AND CAUHOI = '".$question."' AND CAUTRALOI = '".$answer."'";
                    execute($sql);
                    echo '<script>alert("your new Password is abc123456 ")</script>';
                    // var_dump($sql);
                } else {
                    $flag3 = false;
                }
            }
        }
        return $flag3;
    }

    public static function signup($fullname, $email, $password, $repass, $birthday, $phone, $question, $answer) {
        $flag2 = true;
        if($fullname != '' && $email != '' && $password != '' && $birthday && $phone != '' && $repass != ''){
            if($repass == $password) {
                $sql = "INSERT INTO KHACHHANG(MAKH, HOTEN, NGAYSINH, SODT, EMAIL, PASSWORD, TRANGTHAI, LOAI, CAUHOI, CAUTRALOI) VALUES
                ('".floor(date_timestamp_get(date_create()))."','".$fullname."', '".$birthday."', '".$phone."', '".$email."', '".$password."', 'Hoạt động', 'customer', '".$question."', '".$answer."')";
                // echo 1;
                execute($sql);
                // var_dump($sql);
            } else {
                $flag2 = false;
            }
        }
        return $flag2;
    }

    public static function checklogin(){
        if(!$_COOKIE['customerId']){
            header('location: form-login.php');
            exit;
        }
    }
    // Xóa một khách hàng
    public static function checkCustomerActive($id){
        $sql = "SELECT COUNT(*) FROM donhang WHERE MAKH = '$id'";
        $query = countResult_1($sql);

        if($query>0){
            return true;
        }
        return false;
    }
    public static function Del_Customer($id){
        // $conn = mysqli_connect('localhost', 'root','','qlbh');
        $sql ="DELETE FROM khachhang WHERE MAKH=$id";
        execute($sql);
        // $query = mysqli_query($conn,$sql);
        // mysqli_close($conn);
    }
    // Chặn hoặc bỏ chặn cho một khách hàng
    public  static function ChangeState_Customer($id){
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        $sql ="SELECT TRANGTHAI FROM khachhang WHERE MAKH=$id";
        $b = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($b);
        if( $row[0] === "Đang hoạt động"){
            $update = "UPDATE khachhang SET TRANGTHAI='Bị chặn' WHERE MAKH=$id";
            $query = mysqli_query($conn, $update);
        }else {
            $update = "UPDATE khachhang SET TRANGTHAI='Đang hoạt động' WHERE MAKH=$id";
            $query = mysqli_query($conn, $update);
        }
        mysqli_close($conn);
    }
    public static function BlockCustomer($id){
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        $sql ="SELECT TRANGTHAI FROM khachhang WHERE MAKH=$id";
        $b = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($b);
        if( $row[0] === "Hoạt động"){
            $update = "UPDATE khachhang SET TRANGTHAI='Bị chặn' WHERE MAKH=$id";
            $query = mysqli_query($conn, $update);
        }
    }
    public static function unBlockCustomer($id){
        $conn = mysqli_connect('localhost', 'root','','qlbh');
        $sql ="SELECT TRANGTHAI FROM khachhang WHERE MAKH=$id";
        $b = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($b);
        if( $row[0] === "Bị chặn"){
            $update = "UPDATE khachhang SET TRANGTHAI='Hoạt động' WHERE MAKH=$id";
            $query = mysqli_query($conn, $update);
        }
    }
    public static function getCustomerNameById($id) {
        $sql = sprintf("Select hoten from khachhang where makh = '%s'", $id);
        $result = executeResult($sql, true);
        return $result['hoten'];
    }
}
// ".floor(date_timestamp_get(date_create()) * rand())."
?>