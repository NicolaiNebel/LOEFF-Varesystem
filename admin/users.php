<?php
require_once('../util.php');
admin(' - Brugere');

if (isset($_POST['admin'])){
	$admin = $db->prepare('UPDATE Users SET isAdmin="1" WHERE uid = :uid');
	$admin->bindValue(':uid', htmlspecialchars($_POST['admin']), PDO::PARAM_STR);
	$admin->execute();
	header('Location: users.php');
}
if (isset($_POST['delete'])){
	$admin = $db->prepare('DELETE FROM Users WHERE uid = :uid');
	$admin->bindValue(':uid', htmlspecialchars($_POST['delete']), PDO::PARAM_STR);
	$admin->execute();
	header('Location: users.php');
}

$stat = $db->prepare('SELECT * FROM Users');

if ($stat and $stat->execute()) {
	?>
	<table>
		<tr>
			<th>Kundenr</th>
			<th>Navn</th>
			<th>Adresse</th>
			<th>Postnummer</th>
			<th>E-mail</th>
			<th>Admin</th>
			<th>Slet bruger</th>
		</tr>
	<?php
    $test = $stat->fetchAll();
	$td = "</td><td>";
    foreach($test as $row) {
        print "<tr><td>".
				$row['uid'].$td.
				$row['name'].$td.
				$row['adress'].$td.
				$row['zip'].$td.
				$row['email'].$td;
				if ($row['isAdmin']){
					print "Ja";
				} else {
					?>
					<form action="users.php" method="post">
						<input type="hidden" name="admin" value="<?php echo $row['uid']; ?>"/>
						<input type="submit" value="Gør til admin"/>
					</form>
					<?php
				}
				print $td;
				?>
				<form action="users.php" method="post">
					<input type="hidden" name="delete" value="<?php echo $row['uid']; ?>"/>
					<input type="submit" value="Slet"/>
				</form>
				<?php
		print "</td></tr>";
    }
	echo "</table>";
}

foot();
?>