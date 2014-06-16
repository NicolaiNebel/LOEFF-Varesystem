<?php
require_once('../util.php');
head();
//Check that no fields are empty
if(!$_POST['name'] || !$_POST['adress'] || !$_POST['zip'] || !$_POST['email'] || !$_POST['password1'] || !$_POST['password2']){
	header('Location: register.php?msg=1');
	exit;
}else{
	echo "noError1<br />";
}
//Check that the two passwords match
if($_POST['password1'] != $_POST['password2']){
	header('Location: register.php?msg=2'); //Passwords are not alike
	exit;
}else{
	echo 'noError2<br />';
}

$stat = $db->prepare( 'INSERT INTO Users (name, password, isAdmin, email, adress, zip) VALUES (:name, :password, 0, :email, :adress, :zip)');
$name = htmlspecialchars($_POST['name']);
$adress = htmlspecialchars($_POST['adress']);
$zip = htmlspecialchars($_POST['zip']);
$email = htmlspecialchars($_POST['email']);
// Sanitize input and get the hash-value of the password
$stat->bindValue(':name', $name, PDO::PARAM_STR);
$stat->bindValue(':adress', $adress, PDO::PARAM_STR);
$stat->bindValue(':zip', $zip, PDO::PARAM_INT);
$stat->bindValue(':email', $email, PDO::PARAM_STR);
$stat->bindValue(':password', password_hash($_POST['password1'], PASSWORD_BCRYPT), PDO::PARAM_STR);
echo var_dump($stat);
if($stat->execute()){
	login($db->lastInsertId(), $name, 0, $email, $adress, $zip);
	header('Location: welcome.php');
	//exit;
}else { echo "Failed to add user: "; var_dump($stat->errorInfo()); }
echo 'watwat?!';


foot();
?>
