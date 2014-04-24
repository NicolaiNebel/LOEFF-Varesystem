<?php

//Returns two arrays, one is a list of items with combined quantity of items.
//The other is an array of tuples with username and array of orders.
function getOrders($items) {
    //STUB
    //$items is an array containing $name of the items to get.
    //Gets orders from the db.
    $sql1 = "SELECT pid, SUM(quantity) FROM Orders GROUP BY pid";
    $allOrders = $_SESSION['PDO']->query($sql1)->fetchAll();

    $selectUsers = "SELECT uid FROM Users";

    $orderList = array();

    foreach($_SESSION['PDO']->query($selectUsers) as $row) {
        $selectHisOrders = "SELECT pid, SUM(quantity)
                            FROM Orders
                            WHERE uid == " . $row['uid'] .
                            " GROUP BY pid";
        $temp = array();

        foreach($_SESSION['PDO']->query($selectHisOrders) as $o) {
            //I hope this works
            $temp[$o['pid']] = $o[1];
        }
        
        //Add the combined orders of the user to the list.
        $orderList[$row['uid']] = $temp;
    }

    return array($allOrders, $orderList);
}

function clearOrders($items) {
    //STUB
    //$items is an array containing $name of the items to clear.
    //Moves completed orders from Orders to History table.
    //History doesn't exist yet.
}

function addItem($name, $price, $recurrence) {
    //STUB
    //adds a new item to the db
}

function removeItem($name) {
    //STUB
    //Removes an item from the catalogue and the db, also removes all placed orders.
}
?>
