<?php
class Address {
    private $customerId;
    private $address;

    public function __construct($customerId, $address) {
        $this->customerId = $customerId;
        $this->address = $address;
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
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}

class AddressUI {

}

class AddressDAO {
    public static function getAddressByCustomerId($customerId) {
        $sql = sprintf( "Select * from DIACHI dc where dc.makh = '%s'", $customerId);
        $address = executeResult($sql, true);
        return $address['DIACHI'];
    }
}