<?php
require_once('../util.php');
head('Registrer en ny bruger');

//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['msg'])){
	echo "<div id='msg'>";
	$end = "</div><br /><br />";
	switch($_GET['msg']){

		case 1:
			echo 'Alle felter skal udfyldes.'.$end;
			break;

		case 2:
			echo 'De to passwords er ikker ens.'.$end;
			break;

		default:
			echo 'Ukendt fejl.'.$end;
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
	<input type="integer" name="zip" size="4" maxlength="4"/><br /><br />
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
