<?php
require_once('util.php');
head("Login");


//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['error'])){
	switch($_GET['error']){

		case 1:
			echo "<span style='color:red;'>Manglende kundenummer eller adgangskode.</span><br /><br />";
			break;

		case 2:
			echo "<span style='color:red;'>Forkert kundenummer eller adgangskode.</span><br /><br />";
			break;

		default:
			echo "<span style='color:red;'>Ukendt fejl.</span><br /><br />";
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
