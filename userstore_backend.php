<?php

//takes in an array with $pid => $quantity structure and places the orders in
//the sqlite db.
//
//Assumes $_SESSION['uid'] is set.

if (!isset($_SESSION['Orders'])) {
    $_SESSION['Orders'] = array();
}

//Items are added as a Product-object and a quantity.
function addItem($product, $quantity) {
    $_SESSION['Orders'][] = array($product->pid, $quantity);
}

function placeOrder() {
    $sql = 'INSERT INTO Orders(uid, pid, quantity) ' .
           'VALUES (:uid, :pid, :quantity)';

    $stat = $_SESSION['PDO']->prepare($sql);
    $stat->bindValue(':uid', $_SESSION['uid'], PDO::PARAM_INT);

    $stat->bindParam(':pid', $pid);
    $stat->bindParam(':quantity', $q);

    //PHP manual! I choose you! Don't fail me now!
    foreach ($_SESSION['Orders'] as $pid => $q) {
        if (!$stat->execute()) {
            echo 'Failed to insert order for uid = ',
                $_SESSION['uid'], 'and pid = ', $pid, '.';
        }
    }
}

?>
