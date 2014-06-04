<?php

require('connect.php');


//Returns two arrays, one is a list of items with combined quantity of items.
//The other is an array of tuples with userid and array of orders.

function getOrders($items = array()) {

    global $db;
    //$items is an array containing $name of the items to get.



    //Gets all orders from the db, grouped by product.
    $sql = "SELECT pid, SUM(quantity) FROM Orders GROUP BY pid";

    $stat = $db->prepare($sql);

    if ($stat->execute()) {
        $allOrders = $stat->fetchAll();
    } else {
        //TODO: Throw exception instead of echoing.
        echo 'Failed to retrieve orders.';
        $allOrders = array();
    }

    //Part one done, allOrders contains all the orders, grouped by products.

    $sql = "SELECT uid FROM Orders GROUP BY uid";
    $users = $db->prepare($sql);
    $users->execute();

    //$users can be fetched repeatedly to return users that have placed orders.

    $sql = "SELECT pid, SUM(quantity) FROM Orders" . 
        " WHERE uid == :uid GROUP BY pid";
    $stat = $db->prepare($sql);
    $stat->bindValue(':uid', $u, PDO::PARAM_INT);

    $groupedByUser = array();


    //Fetch users one at a time
    while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
        $u = $row['uid'];

        if ($stat->execute()) {
            $groupedByUser[] = $stat->fetchAll();
        } else {
            //TODO: Append error message to file.
        }
    }

    return array($allOrders, $groupedByUser);
}

//Clears a product from the db, removes all orders for it.
function clearProduct($pid) {
    $sql = 'DELETE FROM Products WHERE pid == :pid';

    $stat = $db->prepare($sql);
    $stat->bindValue(':pid', $pid, PDO::PARAM_INT);

    if ($stat->execute()) {
        return true;
    } else {
        return false;
    }
}

function addProduct($name, $price, $payDate, $delivDate, $description = '') {
    $sql = 'INSERT INTO Products(name, price, payDate, delivDate, description) 
        VALUES (:name, :price, :payDate, :delivDate, :desc);';

    $stat = $db->prepare($sql);
    $stat->bindValue(':name', $name);
    $stat->bindValue(':price', $price);
    $stat->bindValue(':payDate', $payDate);
    $stat->bindValue(':delivDate', $delivDate);
    $stat->bindValue(':description', $description);

    if ($stat->execute()) {
        return true;
    } else {
        return false;
    }
}


/*

//Adds a onetime product.
function addOneTime($name, $price, $delivered) {
    //adds a new item to the db
    //TODO: Needs more values to the addition
    $sql = 'INSERT INTO actualProducts VALUES (:name, :price, :deliv)';
    $stat = $_SESSION['PDO']->prepare($sql);
    $stat->bindValue(':name', $name, PDO::PARAM_STR);
    $stat->bindValue(':price', $price, PDO::PARAM_INT);
    $stat->bindValue(':deliv', $$delivered, PDO::PARAM_STR);
    if ($stat->execute()) {
        return true;
    } else {
        return false;
    }
}

function removeRecurring($id) {
    //Removes an item from the catalogue and the db, also removes all placed orders.
    $sql = 'DELETE FROM recurringProducts WHERE pid == :id';
    $stat = $_SESSION['PDO']->prepare($sql);
    $stat->bindValue(':id', $id, PDO::PARAM_INT);
    if ($stat->execute()) {
        return true;
    } else {
        return false;
    }
*/
?>
