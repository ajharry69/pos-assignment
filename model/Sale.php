<?php

class Sale
{
    public $id = -1;
    public $clientname = null;
    public $amount = 0.0;
    public $discount = 0.0;
    public $total = 0.0;

    public function __construct($id, $clientname, $amount, $discount, $total)
    {
        $this->id = $id;
        $this->clientname = $clientname;
        $this->amount = $amount;
        $this->discount = $discount;
        $this->total = $total;
    }

    /**
     * @return Sale
     * @throws Exception
     */
    public static function fromJsonRequest()
    {
        $contents = file_get_contents("php://input");
        if (strlen($contents) < 1) throw new Exception('invalid request data');
        return self::fromDbResult(json_decode($contents));
    }

    public static function fromDbResult($object)
    {
        $obj = json_decode(json_encode($object));
        return new Sale(
            isset($obj->id) ? $obj->id : -1,
            isset($obj->clientname) ? $obj->clientname : null,
            isset($obj->amount) ? $obj->amount : 0.0,
            isset($obj->discount) ? $obj->discount : 0.0,
            isset($obj->total) ? $obj->total : 0.0
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getClientname()
    {
        return $this->clientname;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }
}