<?php
require_once('../util.php');
head('F&aelig;rdiggør ordre');

$stat = $db->prepare('ORDRE?!');
?>
Du har bestilt:<br />
<table>
	<tr>
		<th>Vare</th>
		<th>Antal</th>
		<th>Styk pris</th>
		<th>Samlet pris</th>
	</tr>
<?php
	$finalPayDate = date_create('9999-12-31');
	$finalPrice = 0;
	$td = "</td><td>";
	foreach ($_SESSION['catalogue'] as $p) {
		$pid = $p->pid;
		$payDate = $p->payDate;
		$price = $p->price / 100.0;
		$amount = htmlspecialchars($_POST[$pid]);
		
		if ($amount){
			//$stat->bindValue(':name', $name, PDO::PARAM_STR);
			if ($finalPayDate > $payDate){
				$finalPayDate = $payDate;
			}
			$finalPrice += $amount*$price;
			echo '<tr><td>'.$p->name.$td.$amount.$td.'DKK '.$price.$td.'DKK '.$amount*$price.'</td></tr>';
		}
	}
?>
	<tr></tr>
	<tr>
		<td>I alt</td>
		<td></td>
		<td></td>
		<td><u>DKK <?php echo $finalPrice;?></u></td>
	</tr>
</table>
<br /><br />
Betalingsdato: <?php echo $finalPayDate->format('l, j M Y');?><br /><br />
Betalingen foregår ved at du overfører pengene til <i>kontonummer</i>, med teksten <?php echo "$rid"?>.
<?php
foot();
?>
