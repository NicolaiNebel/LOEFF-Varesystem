<?php
require_once('../util.php');
head("Login");


//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['msg'])){
	echo "<div id='msg'>";
	$end = "</div><br /><br />";
	switch($_GET['msg']){
		case 1:
			echo "Manglende kundenummer eller adgangskode.".$end;
			break;

		case 2:
			echo "Forkert kundenummer eller adgangskode.".$end;
			break;

		default:
			echo "Ukendt fejl.".$end;
			break;
	}
}
?>

<!-- Loginform -->
<form action="loginBackend.php" method="post">
	Kundenummer:<br />
	<input type="text" name="uid" />
	<br />

	Adgangskode:<br />
	<input type="password" name="password" />
	<br />

	<input type="submit" value="Login" />
</form>

Ingen bruger endnu? <a href="register.php">Registrer dig her!</a>

<?php
foot();
?>
