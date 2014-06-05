<?php

require_once('util.php');
head();
if (!isset($_SESSION['PDO'])) {
    require('connect.php');
}

if (!isset($_SESSION['catalogue'])) {
    require('initStore.php');
}

require_once('admin.php');

//Login kan testes med $_SESSION['LoggedIn']
$_SESSION['user'] = "1";

if (isset($_SESSION['user'])) {
	?>
	<a href="login.php">Login</a>
	<h2>Brugere:</h2>
	<?php
	$_SESSION['users'] = array();
	$statement = "SELECT * FROM 'Users'";
	foreach($_SESSION['PDO']->query($statement) as $row) {
		$_SESSION['users'][strval($row['uid'])]
			= new Product($row['name'], $row['email']);
	}
	?>

	<table>
		<tr>
			<td>uid</td>
			<td>name</td>
		</tr>

	<?php
	foreach($_SESSION['users'] as $id=>$user) {
        print "<tr><td>".$user->name . "</td>";
        print "<td>".$user->email . "</td></tr>";
    }
	?>
	</table>

	<h2>Varer:</h2>

	<table>
		<tr>
			<td>Vare</td>
			<td>Pris</td>
		</tr>
	<?php
/*	foreach($_SESSION['catalogue'] as $id=>$item) {
     //   print $id . "\t";
        print "<tr><td>".$item->name . "</td>";
        print "<td>".$item->price/100.0 . " kr</td></tr>";
    }*/
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
    

    
} else {
//Not logged in yet, do something about it.
}

//takes in an array with $pid => $quantity structure and places the orders in
//the sqlite db.
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
}
foot();
?>
