<?php
class Order
{
    private $orderId;
    private $customerId;
    private $paymentDate;
    private $payment;
    private $orderDate;
    private $state;
    private $canceledDate;

    public function __construct($orderId, $customerId, $paymentDate, $payment, $orderDate, $state, $canceledDate)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->paymentDate = $paymentDate;
        $this->payment = $payment;
        $this->orderDate = $orderDate;
        $this->state = $state;
        $this->canceledDate = $canceledDate;
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

    /**
     * Get the value of paymentDate
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set the value of paymentDate
     *
     * @return  self
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get the value of payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     *
     * @return  self
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get the value of orderDate
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set the value of orderDate
     *
     * @return  self
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

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
     * Get the value of canceledDate
     */ 
    public function getCanceledDate()
    {
        return $this->canceledDate;
    }

    /**
     * Set the value of canceledDate
     *
     * @return  self
     */ 
    public function setCanceledDate($canceledDate)
    {
        $this->canceledDate = $canceledDate;

        return $this;
    }

    public function display($status = 0)
    {
        $strArray = array(
            "<td>".$this->getState()."</td>
                <td><i onclick='openDetailOrder(".$this->getOrderId().");
                openInfoOrder(".$this->getOrderId().");' 
                class='uil uil-receipt-alt icon-edit'></i></td>
            </tr>",
            "<td>   
                    <i onclick='cancelOrder(" . $this->getOrderId() . ")' class='uil uil-times-circle icon-trash'>
                    <i onclick='confirmOrder(" . $this->getOrderId() . ")' class='uil uil-check-circle icon-edit'></i>
            </td>
                <td><i onclick='openDetailOrder(".$this->getOrderId().");
                openInfoOrder(".$this->getOrderId().");' 
                class='uil uil-receipt-alt icon-edit'></i></td>
            </tr>",
            "<td>" . $this->getPaymentDate() . "</td>
                <td><i onclick='openDetailOrder(".$this->getOrderId().");
                openInfoOrder(".$this->getOrderId().");' 
                class='uil uil-receipt-alt icon-edit'></i></td>
            </tr>",
            "<td>" . $this->getCanceledDate() . "</td>
            <td><i onclick='openDetailOrder(".$this->getOrderId().");
            openInfoOrder(".$this->getOrderId().");' 
            class='uil uil-receipt-alt icon-edit'></i></td>
            </tr>");
        return "<tr class='text-center'>
                    <td>" . $this->getOrderId() . "</td>
                    <td>" . $this->getCustomerId() . "</td>
                    <td>" . $this->getPayment() . "</td>
                    <td>" . $this->getOrderDate() . "</td>".$strArray[$status];
    }
}

class OrderUI
{
    public static function getInfoOrder($order) {

        $address = AddressDAO::getAddressByCustomerId($order->getCustomerId());
        $customerName = CustomerDAO::getCustomerNameById($order->getCustomerId());
        $tmp = array("<div>Order ID: ".$order->getOrderId()."</div>
                    <div>Order Date: ".$order->getOrderDate()."</div>
                    <div>Customer Name: ".$customerName."</div>
                    <div>Customer Address: ".$address."</div>",
                "<div>Total: ".number_format(($order->getPayment()), 0, ',', '.')."</div>");
        return json_encode($tmp);
    }
}

class OrderDAO
{

    public static function rowCounting()
    {
        return countResult("SELECT * FROM DONHANG");
    }

    public static function getData($status = 0, $keyword = '')
    {
        $statusArray = ['',
                        'WHERE TRANGTHAI = \'Đang xử lý\'',
                        'WHERE TRANGTHAI = \'Đã xử lý\'',
                        'WHERE TRANGTHAI = \'Đã hủy\''];
        if($keyword != '') {
            if($status == 0) {
                $sqlFilterByKeyword = 'WHERE MADH like \'%'.$keyword.'%\'';
                
            } else {
                $sqlFilterByKeyword = ' AND MADH like \'%'.$keyword.'%\'';
            }
        }
        $sql = "SELECT * FROM DONHANG ".$statusArray[$status].$sqlFilterByKeyword;
        $tmpArray = array();
        $list = executeResult($sql);
        foreach ($list as $order) {
            $x = new Order(
                $order['MADH'],
                $order['MAKH'],
                $order['NGAYTT'],
                $order['THANHTIEN'],
                $order['NGAYDAT'],
                $order['TRANGTHAI'],
                $order['NGAYHUY']
            );
            $tmpArray[] = $x;
        }
        return $tmpArray;
    }

    public static function rowCountingWithCondition($status = '', $keyword = '') {
        return count(self::getData($status, $keyword));
    }

    public static function cancelOrder($id) {
        $now = date("Y-m-d");
        $sql2 = "Update DONHANG set ngayhuy = '".$now."' where MADH = '".$id."'";
        execute($sql2);
        $sql = "Update DONHANG set trangthai = 'Đã hủy' where MADH = '".$id."'";
        execute($sql);
    }

    public static function confirmOrder($id) {
        $now = date("Y-m-d");
        echo $now;
        $sql2 = "Update DONHANG set ngaytt = '".$now."' where MADH = '".$id."'";
        execute($sql2);
        $sql = "Update DONHANG set trangthai = 'Đã xử lý' where MADH = '".$id."'";
        execute($sql);
    }

    public static function getOrderById($id) {
        $sql = sprintf("Select * from Donhang where madh = '%s'", $id);
        $result = executeResult($sql, true);
        $x = new Order(
            $result['MADH'],
            $result['MAKH'],
            $result['NGAYTT'],
            $result['THANHTIEN'],
            $result['NGAYDAT'],
            $result['TRANGTHAI'],
            $result['NGAYHUY']
        );
        return $x;
    }
   
}
