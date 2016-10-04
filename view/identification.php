<?php
session_start();
include('../fonction.php');

if (isset($_SESSION['pseudo']) 
	&& isset($_POST['identite']) 
	&& !empty($_POST['identite'])
	&& isset($_GET['id'])
	&& !empty($_GET['id'])) {

	$name = $_POST['identite'];
	$picture_id = $_GET['id'];

	if (is_pseudo_used($name)) {
		$user_id = get_id($name);
		if (!are_already_bound($picture_id, $user_id)) {
			bind($picture_id, $user_id);
		}
	}

	header('Location: ../view/?id='.$picture_id);
} else {
	header('Location: ../drive');
}


