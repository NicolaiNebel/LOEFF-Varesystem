<?php

require_once('connect.php');
require_once('util.php');

//takes in an array with $pid => $quantity structure and places the orders in
//the sqlite db.
//
//Assumes $_SESSION['uid'] is set.

if (!isset($_SESSION['Orders'])) {
    $_SESSION['Orders'] = array();
}

//Items are added as a Product-object and a quantity.
function addItem($product, $quantity) {
    if (!isset($_SESSION['Orders'][strval($product->pid)])) {
        $_SESSION['Orders'][strval($product->pid)] = $quantity;
    } else {
        $_SESSION['Orders'][strval($product->pid)] += $quantity;
    }
}

function placeOrder() {

    global $db;

    $sql = 'INSERT INTO Orders(uid, pid, quantity) ' .
           'VALUES (:user, :pid, :quantity)';

    $stat = $db->prepare($sql);
    $stat->bindValue(':user', $_SESSION['user'], PDO::PARAM_INT);

    $stat->bindParam(':pid', $pid);
    $stat->bindParam(':quantity', $q);

    //PHP manual! I choose you! Don't fail me now!
    foreach ($_SESSION['Orders'] as $pid => $q) {
        if (!$stat->execute()) {
            echo 'Failed to insert order for uid = ',
                $_SESSION['user'], 'and pid = ', $pid, '.';
        }
    }
}

?>
