<?php
require_once('util.php');
head('Admin område - liste over brugere');

$stat = $db->prepare('SELECT * FROM Users');

if ($stat and $stat->execute()) {
	echo "<table>";
	echo "<tr><td>Bruger ID</td><td>Navn</td><td>Adresse</td><td>postnummer</td></tr>";
    $test = $stat->fetchAll();
	$td = "</td><td>";
    foreach($test as $row) {
        print "<tr><td>".$row['uid'].$td.$row['name'].$td.$row['adress'].$td.$row['zip']."</td></tr>";
    }
	echo "</table>";
}

foot();
?>