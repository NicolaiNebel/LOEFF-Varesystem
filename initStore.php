<?php

class Product {
    public $id;
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;

        /* if ($isAdmin == 1) {
            $this->isAdmin = true;
        } else {
            $this->isAdmin = false;
        } */

        
    }
    public function getNextDeliveryDate() {
        //STUB
    }
}

//Builds the catalogue of available products as an array of Product objects.
$_SESSION['catalogue'] = array();

$statement = 'SELECT * FROM Products';

foreach($_SESSION['PDO']->query($statement) as $row) {

    $_SESSION['catalogue'][strval($row['pid'])]
        = new Product($row['name'], $row['price']);
}

//TODO: Make weekbased system work from here.
?>
