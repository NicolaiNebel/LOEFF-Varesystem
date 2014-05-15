<?php

require_once('Product.php');

//Builds the catalogue of available products as an array of Product objects.
$_SESSION['catalogue'] = array();

$stat = $_SESSION['PDO']->prepare('SELECT pid, name, price, deliv ' .
                                  'FROM actualProducts');

if ($stat->execute()) {
    foreach($stat->fetchAll() as $row) {

        $_SESSION['catalogue'][]
            = new Product($row['pid'], $row['name'], $row['price'],
                $row['delivDate'], $row['payDate'], $row['description']);
    }
} else {
    die ('Error: failed to initialise store.');
}

unset($stat);

?>
