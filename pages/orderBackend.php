<?php
require_once('../util.php');
head('F&aelig;rdiggør ordre');

if(!loginId()){
	header('Location: ../user/login.php?msg=login');
} else {
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
	$rid = 0;
	$empty = true;
	foreach ($_SESSION['catalogue'] as $p) {
		$pid = $p->pid;
		$payDate = $p->payDate;
		$price = $p->price / 100.0;
		$amount = $_POST[$pid];
		if ($amount>0 && $empty){
			$empty = false;
			$rec = $db->prepare('INSERT INTO Receipt (uid, paid) VALUES (:uid, 0)');
			$rec->bindValue(':uid', loginId(), PDO::PARAM_STR);
			$rec->execute();
			$rid = $db->lastInsertId();
		}
		
		if ($amount>0){
			$order = $db->prepare('INSERT INTO Orders (rid, pid, quantity) VALUES (:rid, :pid, :quantity)');
			$order->bindValue(':rid', $rid, PDO::PARAM_STR);
			$order->bindValue(':pid', $pid, PDO::PARAM_STR);
			$order->bindValue(':quantity', $amount, PDO::PARAM_STR);
			$order->execute();
			if ($finalPayDate > $payDate){
				$finalPayDate = $payDate;
			}
			$finalPrice += $amount*$price;
			echo '<tr><td>'.$p->name.$td.$amount.$td.'DKK '.$price.$td.'DKK '.$amount*$price.'</td></tr>';
		}
	}

	if ($empty){
		header('Location: order.php?msg=empty');
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
}
foot();
?>
