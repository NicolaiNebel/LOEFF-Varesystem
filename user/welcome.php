<?php
require_once('../util.php'); //To make sure that util.php is only required once
head("Velkommen ".loginName()."!");
?>
For at logge ind fremover skal du bruge dit brugerid: <b><?php echo loginId() ?></b>, samt det kodeord du netop har valgt.<br />
Du kan nu bestille varer <a href="../pages/order.php">her</a>, eller snakke med de andre medlemmer i <a href="../pages/forum.php">vores forum</a>.
<?php
foot();
?>