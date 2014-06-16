<?php
require_once('../util.php'); //To make sure that util.php is only required once
head();
//Check that everything is set:
if(!$_POST['uid'] || !$_POST['password']) {
	header('Location: login.php?msg=1');
	$_SESSION['LoggedIn'] = 0;
	exit;
}

$stat = $db->prepare('SELECT * FROM `Users` WHERE `uid`= :uid');

$stat->bindValue(':uid', $_POST['uid'], PDO::PARAM_INT);

$stat->execute();
if ($user = $stat->fetch()){
	if (password_verify($_POST['password'], $user['password'])){
		login($user['uid'], $user['name'], $user['isAdmin'], $user['email'], $user['adress'], $user['zip']);
		header('Location: ../pages/index.php');
		exit;
	}else{
		header('Location: login.php?msg=2');
		exit;
	}
}else{
	header('Location: login.php?msg=2');
	exit;
}



foot();
?>
