<?php
require_once('util.php');
head();
//Check that no fields are empty
echo $_POST['name']."<br />";
echo $_POST['adress']."<br />";
echo $_POST['zip']."<br />";
echo $_POST['email']."<br />";
echo $_POST['password1']."<br />";
echo $_POST['password2']."<br />";

if(!$_POST['name'] || !$_POST['adress'] || !$_POST['zip'] || !$_POST['email'] || !$_POST['password1'] || !$_POST['password2']){
	header('Location: register.php?error=1');
	exit;
}else{
	echo "noError1<br />";
}
//Check that the two passwords match
if($_POST['password1'] != $_POST['password2']){
	header('Location: register.php?error=2'); //Passwords are not alike
	exit;
}else{
	echo 'noError2<br />';
}

$stat = $db->prepare( 'INSERT INTO Users (name, password, isAdmin, email, adress, zip) VALUES (:name, :password, 0, :email, :adress, :zip)');
//$stat = $db->prepare( 'INSERT INTO Users (name, password, isAdmin, email, adress, zip) VALUES ("Hr Test", "test", 0, "test@test.com", "Testroad", 1337)');

// Sanitize input and get the hash-value of the password
$stat->bindValue(':name', htmlspecialchars($_POST['name']), PDO::PARAM_STR);
$stat->bindValue(':adress', htmlspecialchars($_POST['adress']), PDO::PARAM_STR);
$stat->bindValue(':zip', htmlspecialchars($_POST['zip']), PDO::PARAM_INT);
$stat->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
$stat->bindValue(':password', password_hash($_POST['password1'], PASSWORD_BCRYPT), PDO::PARAM_STR);
/*$stat->bindValue(':name', 'Hr Test', PDO::PARAM_STR);
$stat->bindValue(':adress', 'Testroad', PDO::PARAM_STR);
$stat->bindValue(':zip', 1337, PDO::PARAM_INT);
$stat->bindValue(':email', 'test@test.com', PDO::PARAM_STR);
$stat->bindValue(':password', 'test', PDO::PARAM_STR);*/
echo var_dump($stat);
if($stat->execute()){
	header('Location: index.php');
	exit;
}else { echo "Failed to add user: "; var_dump($stat->errorInfo()); }
echo 'watwat?!';


foot();
?>
