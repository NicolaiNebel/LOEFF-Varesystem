<?php

session_start(); //Start the damn session, maggot!	
require_once('connect.php');
require_once('initStore.php');


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
	<img src='loeff_logo.jpg'/>
	<ul id="topmenu">
		<li><a href="index.php">Forside</a></li>
		<li><a href="news.php">Nyheder</a></li>
		<li><a href="order.php">Bestil</a></li>
		<li><a href="recipes.php">Opskrifter</a></li>
		<li><a href="suppliers.php">Leverandører</a></li>
		<li><a href="about.php">Om LØFF</a></li>
		<li><a href="contact.php">Kontakt</a></li>
		<li><a href="forum.php">Forum</a></li>
		<li><a href="register.php">Bliv Medlem</a></li>
		<li><?php if(loginId()>0){echo '<a href="logOff.php">Logaf</a>';}else{echo '<a href="login.php">Login</a>';}?></li>
	</ul>
	<h1> <?php echo $title; ?> </h1>
    <?php
}

function foot() {
    ?>
    </body>
    </html>
    <?php
}

function login($uid, $name = "naN", $admin = 0, $email = "naN", $adress = "naN", $zip = 0000) {
	$_SESSION['LoggedIn'] = $uid;
	$_SESSION['Name'] = $name;
	$_SESSION['Admin'] = $admin;
	$_SESSION['Adress'] = $adress.", ".$zip;
}

function logOff() {
	$_SESSION['LoggedIn'] = 0;
	$_SESSION['Name'] = "naN";
	$_SESSION['Admin'] = 0;
	$_SESSION['Adress'] = "naN, 0000";
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
