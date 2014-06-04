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

//Places the orders saved in $̣_SESSION['Orders'].
//Clears orders.
function placeOrder() {
    global $db;

    try {

        $db->beginTransaction();

        $sql = 'INSERT INTO Orders(uid, pid, quantity) ' .
            'VALUES (:user, :pid, :quantity)';



        //PHP manual! I choose you! Don't fail me now!
        foreach ($_SESSION['Orders'] as $pid => $q) {
            $stat = $db->prepare($sql);
            $stat->bindValue(':user', $_SESSION['user'], PDO::PARAM_INT);
            $stat->bindParam(':pid', $pid);
            $stat->bindParam(':quantity', $q);
            $stat->execute();
        }

        $db->commit();

        unset($_SESSION['Orders']);

        return true;
    
    } catch (Exception $e) {
        $db->rollBack();
        echo "Failed: " . $e->getMessage();

        return false;
    }
}

?>
