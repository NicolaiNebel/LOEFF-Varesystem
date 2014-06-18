<?php
require_once('../util.php');
admin(' - Bestillinger');

if (isset($_POST['paid']) && loginAdmin()){
	$paid = $db->prepare('UPDATE Receipt SET paid="1" WHERE rid = :rid');
	$paid->bindValue(':rid', $_POST['paid'], PDO::PARAM_INT);
	$paid->execute();
	header('Location: orders.php');
}

$receipt = $db->prepare('SELECT rid, uid, SUM(quantity*price) AS price, paid FROM Receipt NATURAL JOIN Orders NATURAL JOIN Products GROUP BY rid;');
$td = '</td><td>';
if ($receipt && $receipt->execute()){
	?>
	<h2>Bestillinger</h2>
	<table>
		<tr>
			<th>Ordre nr</th>
			<th>Kunde nr</th>
			<th>Beløb</th>
			<th>Betalt</th>
		</tr>
			<?php
				$r = $receipt->fetchAll();
				foreach ($r as $row) {
					echo '<tr><td>'.
						$row['rid'].$td.
						$row['uid'].$td.
						'DKK '.$row['price']/100.0 .$td;
						if ($row['paid']){
							echo 'Ja';
						} else {
							?>
							<form action="orders.php" method="post">
								<input type="hidden" name="paid" value="<?php echo $row['rid']; ?>"/>
								<input type="submit" value="Betalt"/>
							</form>
							<?php
						}
						echo'</td></tr>';
				}
			?>
	</table>
	<?php
} else {
	echo 'Kunne ikke finde bestillingerne';
}

$products = $db->prepare('SELECT name, SUM(quantity) AS quantity, payDate FROM Receipt NATURAL JOIN Orders NATURAL JOIN Products WHERE paid=1 GROUP BY pid ORDER BY payDate;');
if ($products && $products->execute()){
	?>
	<h2>Bestilte, betalte varer</h2>
	<table>
		<tr>
			<th>Produkt</th>
			<th>Mængde</th>
			<th>Betalingsfrist</th>
		</tr>
		<?php
		$p = $products->fetchAll();
		foreach ($p as $row) {
			echo '<tr><td>'.
						$row['name'].$td.
						$row['quantity'].$td.
						date_create($row['payDate'])->format('D, j M Y').
						'</td></tr>';
		}
		?>
	</table>
	<?php
} else {
	echo 'Kunne ikke finde de betalte varer';
}
	

foot();
?>
