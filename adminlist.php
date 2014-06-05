<?php
require_once('util.php');
require_once('connect.php');
require_once('initStore.php');
head();
?>
<h1>Admin område - liste over ordrer</h1>
<?php menubar(); ?>
<table border="1">
	<tr>
		<td>Navn</td>
		<td>Pris</td>
		<td>Sendes</td>
		<td>Betalingsdato</td>
		<td>beskrivelse</td>
	</tr>
		<?php
			foreach ($_SESSION['catalogue'] as $p) {
				$td = '</td> <td>';
				$str = '<tr><td>' . $p->name . $td . $p->price . $td . /*$p->delivDate*/'hejhej' . $td . /*$p->payDate*/'hej' . $td . $p->description . '</td></tr>';
				//$str = '<tr><td>' . $p->name . $td . $p->price . $td . $p->delivDate . $td . $p->payDate . $td . $p->description . '</td></tr>';
				//echo htmlspecialchars($str);
				echo $str;

			}
		?>
</table>
<p>Sidebar FULL of news</p>
</body>
</html>