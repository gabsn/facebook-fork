<?php
include('../fonction.php');

if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
	$pseudo = $_POST["pseudo"];
	$password = $_POST["password"];

	if (!is_pseudo_used($pseudo)) {
		add_user($pseudo, $password);
		connexion($pseudo);
		header('Location: ../drive/');
	} else {
		header('Location: ../inscription/?err=1');
	}
}	
?>
		
	


