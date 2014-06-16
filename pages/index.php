<?php
require_once('../util.php');
head('L&Oslash;FF varesystem');

if (isset($_GET['msg'])){
	echo "<div id='msg'>";
	$end = "</div><br /><br />";
	switch($_GET['msg']){
		case 'admin':
			echo "Du skal være admin, for at kunne se denne side!".$end;
			break;

		default:
			echo "Ukendt besked".$end;
			break;
	}
}

if (loginId()){
	echo "Hej ".loginName();
}else{
	echo "Velkommen til LØFF";
}

foot();
?>
