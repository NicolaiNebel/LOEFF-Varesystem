<?php
require_once('util.php');
head('Registrer en ny bruger');

//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['error'])){
	switch($_GET['error']){

		case 1:
			echo '<span style="color:red;">Alle felter skal udfyldes.</span><br /><br />';
			break;

		case 2:
			echo '<span style="color:red;">De to passwords er ikker ens.</span><br /><br />';
			break;

		default:
			echo '<span style="color:red;">Ukendt fejl.</span><br /><br />';
			break;
	}
}

?>
<form method="post" action="registerBackend.php">
	Navn <br />
	<input type="text" name="name" /><br /><br />
	Adresse <br />
	<input type="text" name="adress" /><br /><br />
	Postnummer <br />
	<input type="integer" name="zip" /><br /><br />
	E-mail <br />
	<input type="text" name="email" /><br /><br />
	Password: <br />
	<input type="password" name="password1" /><br /><br />
	Gentag password: <br />
	<input type="password" name="password2" /><br /><br />
	<input type="submit" value="Registrer" name="register" />
</form>
<?php
foot();
?>
