<?php
session_start();
include('fonction.php');

if (!isset($_POST["pseudo"]) || !isset($_POST["password"])) {
	header('Location: /');
} else {
	if (is_DB($_POST["pseudo"], $_POST["password"])) {
		connexion($_POST["pseudo"]);
		header("Location: drive/");
	} else {

		header("Location: ../pp/?err=1");
	}
}

?>

