<?php
require_once('../util.php');
admin(' - Varer');

if (isset($_POST['delete']) && loginAdmin()){
	$admin = $db->prepare('DELETE FROM Products WHERE pid = :pid');
	$admin->bindValue(':pid', $_POST['delete'], PDO::PARAM_INT);
	$admin->execute();
	header('Location: products.php');
}

?>
<table>
	<tr>
		<th>Produkt</th>
		<th>Pris</th>
		<th>Betalingsdato</th>
		<th>Leveringsdato</th>
		<th>Beskrivelse</th>
		<th>Slet</th>
	</tr>
		<?php
			foreach ($_SESSION['catalogue'] as $p) {
				$td = '</td><td>';
				echo '<tr><td>'.
					$p->name.$td.
					'DKK '.$p->price/100.0 .$td.
					$p->payDate->format('D, j M Y').$td.
					$p->delivDate->format('D, j M Y').$td.
					$p->description.$td;
					?>
					<form action="products.php" method="post">
						<input type="hidden" name="delete" value="<?php echo $p->pid; ?>"/>
						<input type="submit" value="Slet"/>
					</form>
					<?php
					echo'</td></tr>';
			}
		?>
</table>

<br /><br />
<h2>Opret ny vare</h2>
<form method="post" action="productsBackend.php">
	Produktnavn <br />
	<input type="text" name="name" /><br /><br />
	Pris i ører!<br />
	<input type="integer" name="price" /><br /><br />
	Leverings dato <em>(Vælg en dato, eller skriv det på formen 'YYYY-MM-DD')</em><br />
	<input type="date" name="delivDate" /><br /><br /> <!--This is nice! But week or date?-->
	Betalings dato <em>(Vælg en dato, eller skriv det på formen 'YYYY-MM-DD')</em><br />
	<input type="date" name="payDate" /><br /><br />
	Beskrivelse: <br />
	<!--<input type="text" name="description" /><br /><br />-->
	<textarea name="description" cols="25" rows="5"></textarea><br /><br />
	<input type="submit" value="Opret" name="create" />
</form>
<?php
foot();
?>