<?php
session_start();

$form = "";
$drive = "";
$deconnexion = "";
$inscription = "";

if (!isset($_SESSION["pseudo"])) {
	$form = '<form method="post" action="formulaire.php">
		<input type="text" name="pseudo" placeholder="pseudo" autofocus="true" required="true">
		<p><input type="password" name="password" placeholder="password" required="true"></p>	
		<p><input type="submit" value="Connexion"></p>
		</form>';
	$inscription = '<a href="inscription/">Inscription</a>';

} else {
	$drive = '<a href="drive/">Accès au drive</a>';
	$deconnexion = '<a href="deconnexion.php">Deconnexion</a>';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Bienvenu sur le drive de Geoffrey et Gabin !</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="images/photos12.png" />
</head>

<body>
<?php 
	echo $form;
	echo $drive;
	echo $deconnexion;
	//echo $inscription;
?>


</body>

</html>

