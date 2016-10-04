<?php
session_start();
include('../fonction.php');

if (isset($_SESSION['pseudo'])) {
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = intval($_GET['id']);

		if ($name = get_name($id)) {
			$extension = pathinfo('../storage_mini/'.$name, PATHINFO_EXTENSION);
			//echo $extension.'</br>';
			$absolute_path = realpath('../storage_mini/'.$name);
			//echo $absolute_path;

			header("Content-Type: image/".$extension);
			ob_clean();
			readfile($absolute_path);
		}
	}
} else {
	header('Location: /');
}
	
?>
