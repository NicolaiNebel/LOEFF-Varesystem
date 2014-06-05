<?php

    session_start(); //Start the damn session, maggot!


function head($title = 'L&Oslash;FF') {
            header('Content-Type: application/xhtml+xml;charset=UTF-8');
                ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <title><?php echo $title ?></title>
    </head>
    <body>
    <?php
}

function foot() {
    ?>
    </body>
    </html>
    <?php
}

function menubar() {
	?>
	<ul>
		<li><a href="main.html">Forside</a></li>
		<li><a href="#about">Om LØFF</a></li>
		<li><a href="#news">Nyheder</a></li>
		<li><a href="#member">Bliv Medlem</a></li>
		<li><a href="orders.html">Bestil</a></li>
		<li><a href="#distributors">Leverandør</a></li>
		<li><a href="contact.html">Kontakt</a></li>
		<li><a href="#recipes">Opskrifter</a></li>
		<li><a href="#forum">Forum</a></li>
	</ul>
	<?php
}
function login($uid, $name = "naN", $admin = 0, $email = "naN", $adress = "naN", $zip = 0000) {
	$_SESSION['LoggedIn'] = $uid;
	$_SESSION['Name'] = $name;
	$_SESSION['Admin'] = $admin;
	$_SESSION['Adress'] = $adress.", ".$zip;
}

function loginId() {
	if(!isset($_SESSION['LoggedIn'])){
		$_SESSION['LoggedIn'] = 0;
	}
	return $_SESSION['LoggedIn'];
}

function loginName() {
	if(!isset($_SESSION['Name'])){
		$_SESSION['Name'] = "naN";
	}
	return $_SESSION['Name'];
}

function loginAdmin() {
	if(!isset($_SESSION['Admin'])){
		$_SESSION['Admin'] = 0;
	}
	return $_SESSION['Admin'];
}

function loginAdress() {
	if(!isset($_SESSION['Adress'])){
		$_SESSION['Adress'] = "naN, 0000";
	}
	return $_SESSION['Adress'];
}
?>
