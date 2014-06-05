<?php
require_once('util.php');
require_once('connect.php');
require_once('initStore.php');
head();
?>
<h1>Admin område - liste over ordrer</h1>
<ul>
	<li><a href="main.html">Forside</a></li>
	<li><a href="#about">Om LØFF</a></li>
	<li><a href="#news">Nyheder</a></li>
	<li><a href="#member">Bliv Medlem</a></li>
	<li><a href="orders.html">Bestil</a></li>
	<li><a href="#distributors">Leverandør</a></li>
	<li><a href="contact.html">Kontakt</a></li>
	<li><a href="#recipes">Opskrifter</a></li>
	<li><a href="#forum">Forum</a></li>
</ul>
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