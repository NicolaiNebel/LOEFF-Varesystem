<?php
require_once('../util.php');
head();
//Check that no fields are empty
if(!$_POST['name'] || !$_POST['price'] || !$_POST['delivDate'] || !$_POST['payDate'] || !$_POST['description']){
	header('Location: products.php?msg=1');
	exit;
}

$stat = $db->prepare('INSERT INTO Products (name, price, delivDate, payDate, description) VALUES (:name, :price, :delivDate, :payDate, :description)');
$stat->bindValue(':name', htmlspecialchars($_POST['name']), PDO::PARAM_STR);
$stat->bindValue(':price', htmlspecialchars($_POST['price']), PDO::PARAM_STR);
$stat->bindValue(':delivDate', htmlspecialchars($_POST['delivDate']), PDO::PARAM_STR);
$stat->bindValue(':payDate', htmlspecialchars($_POST['payDate']), PDO::PARAM_STR);
$stat->bindValue(':description', htmlspecialchars($_POST['description']), PDO::PARAM_STR);

if($stat->execute()){
	header('Location: products.php');
}else {
	echo "<b>Failed</b><br />"; var_dump($stat->errorInfo());
}

foot();
?>