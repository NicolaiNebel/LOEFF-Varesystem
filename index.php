<?php

require_once('util.php');
require_once('connect.php');

require_once('initStore.php');

#require_once('admin.php');

//Login kan testes med $_SESSION['LoggedIn'] ----ikke færdigt!
$_SESSION['user'] = "1";

if (isset($_SESSION['user'])) {
    head();
	?>
	<img src='loeff_logo.jpg'/>
	<h1>L&Oslash;FF varesystem</h1>

	<h2>Varer:</h2>

	<table>
		<tr>
			<td>Vare</td>
			<td>Pris</td>
		</tr>
	<?php
	foreach($_SESSION['catalogue'] as $id=>$item) {
        print "<tr><td>".$item->name . "</td>";
        print "<td>".$item->price/100.0 . " kr</td></tr>";
    }
	?>
	</table>
	<?php
	
    //echo "does this work.\n";
    /*
     * testing af funktioner.
    foreach($_SESSION['catalogue'] as $id=>$item) {
        print $id . "\t";
        print $item->name . "\t";
        print $item->price . "<br />";

    }

    print "<br />";
    print "<br />";
    
    list($a, $b) = getOrders(array());

    var_dump($b);

    foreach($a as $x) {
        print $x['pid'] . "\t";
        print $x['SUM(quantity)'] . "<br />";
    }

    foreach($b as $uid=>$x) {
        print $uid . "<br />";
        
        foreach($x as $pid=>$q) {
            print "wat\t" . $pid . "\t" . $q . "<br />";
        }
    }
     */

    echo var_dump($_SESSION['catalogue'][0]);

    // MOAR TESTING 
    /*
    require('userstore_backend.php');
    
    print var_dump($_SESSION['Orders']);
    addItem($_SESSION['catalogue'][0], 5);
    addItem($_SESSION['catalogue'][0], 5);

    print var_dump($_SESSION['Orders']);
    placeOrder();

    print var_dump($_SESSION['Orders']);

    unset($_SESSION['Orders']);
    */
    foot();
} else {
//Not logged in yet, do something about it.
}

//takes in an array with $pid => $quantity structure and places the orders in
//the sqlite db.
/*
function placeOrder($orderArray) {
    $str = 'INSERT INTO  Orders(uid, pid, quantity) 
        VALUES ';

    foreach($orderArray as $pid => $quantity) {
        $str = $str . '(' . $_SESSION['user'] . ', ' . $pid . ', ' . $quantity 
            . ') ,';
    }

    $str = substr($str, 0, -2) . ';';

    $_SESSION['PDO']->beginTransaction();
    $_SESSION['PDO']->exec($str);
    $_SESSION['PDO']->commit();

} */

?>
