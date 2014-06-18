<?php
require_once('../util.php');
head('Bestil');

if(isset($_GET['msg'])){
	echo "<div id='msg'>";
	$end = "</div><br />";
	switch($_GET['msg']){
		case 'empty':
			echo "Du har ikke bestilt noget.".$end;
			break;

		default:
			echo "Ukendt fejl.".$end;
			break;
	}
}
?>
<h2>Varer:</h2>

<form method="post" action="orderBackend.php">
<table>
	<tr>
		<th>Navn</th>
		<th>Pris</th>
		<th>Betalingsfrist</th>
		<th>Leveringsdato</th>
		<th>Beskrivelse</th>
		<th>Antal</th>
	</tr>
		<?php
			foreach ($_SESSION['catalogue'] as $p) {
				$td = '</td><td>';
				$str = '<tr><td>'.
					$p->name.$td.
					'DKK '.$p->price/100.0 .$td.
					$p->payDate->format('D, j M Y').$td.
					$p->delivDate->format('D, j M Y').$td.
					$p->description.$td.
					'<input type="number" name="'.$p->pid.'" min="0"/>'.
					'</td></tr>';
				echo $str;

			}
		?>
</table>
<input type="submit" value="Bestil" name="order" />
</form>
<?php
foot();
?>