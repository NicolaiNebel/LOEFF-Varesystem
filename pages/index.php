<?php
require_once('../util.php');
head('L&Oslash;FF varesystem');

if (loginId()){
	echo "Hej ".loginName();
}else{
	echo "Velkommen til LØFF";
}

foot();
?>
