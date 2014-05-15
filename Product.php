<?php

class Product {
    public $pid;
    public $name;
    public $price;
    public $delivDate;
    public $payDate;
    public $description;
    
    public function __construct($pid, $name, $price, $deliv, $pay, $desc = '') {
        $this->pid = $pid;
        $this->name = $name;
        $this->price = $price;
        $this->delivDate = 
            new DateTime($deliv, new DateTimeZone("Europe/Copenhagen"));
        $this->payDate =
            new DateTime($deliv, new DateTimeZone("Europe/Copenhagen"));
        $this->description = $desc;
    }
}

?>
