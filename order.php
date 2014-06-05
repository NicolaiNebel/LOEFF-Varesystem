<?php
require_once('util.php');
head('Bestil');
?>
<h2>Varer:</h2>

<form method="post" action="orderBackend.php">
<table>
	<tr>
		<td>Navn</td>
		<td>Pris</td>
		<td>Betalingsdato</td>
		<td>Leveringsdato</td>
		<td>Beskrivelse</td>
		<td>Antal</td>
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
					'<input type="integer" name="'.$p->pid.'" />'.
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