<?php

require_once('connect.php');
require_once('Product.php');

//Builds the catalogue of available products as an array of Product objects.
$_SESSION['catalogue'] = array();

$stat = $db->prepare('SELECT * FROM Products');

if ($stat and $stat->execute()) {
    $test = $stat->fetchAll();
    foreach($test as $row) {
        $_SESSION['catalogue'][] =
            new Product($row['pid'], $row['name'], $row['price'],
            $row['delivDate'], $row['payDate'], $row['description']);
    }
} else {
    die ('Error: failed to initialise store.');
}

unset($stat);

?>
