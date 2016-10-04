<?php
session_start();

if (!isset($_SESSION['pseudo'])) {
	header('Location: ../');
}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Bienvenu sur le drive de Geoffrey et Gabin !</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="images/photos12.png" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<a href="identifications/">Accéder à mes identifications</a>
	<p><a href="../drive/">Retour vers le drive</a></p>
</body>

</html>

