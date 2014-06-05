<?php
require_once('util.php'); //To make sure that util.php is only required once
head();
echo "hej";
//Check that everything is set:
if(!$_POST['uid'] || !$_POST['password']) {
	header('Location: login.php?error=1');
	$_SESSION['LoggedIn'] = 0;
	exit;
}

$stat = $db->prepare('SELECT * FROM `Users` WHERE `uid`= :uid');

$stat->bindValue(':uid', $_POST['uid'], PDO::PARAM_INT);

$stat->execute();
if ($user = $stat->fetch()){
	echo "hello";
	if (password_verify($_POST['password'], $user['password'])){
		//echo"hai";
		login($user['uid'], $user['name'], $user['admin'], $user['email'], $user['adress'], $user['zip']);
	}else{
		echo "fejl";
	}
}else{
	echo "error!";
}

header('Location: index.php');
exit;

foot();
?>
