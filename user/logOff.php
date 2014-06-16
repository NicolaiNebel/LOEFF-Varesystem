<?php
require_once('../util.php'); //To make sure that util.php is only required once
head();

logOff();
header('Location: ../pages/index.php');
exit;

foot();
?>