<?php
session_start();
include('../fonction.php');
include('../fonc_gallery.php');

if (isset($_SESSION['pseudo']) && !empty($_FILES['path']['name'][0])) {
	foreach ($_FILES['path']['name'] as $k => $picture_name) {
		$path_parts = pathinfo($_FILES['path']['name'][$k]);
		$extension = $path_parts['extension'];
		$allowed_extensions = array("jpg", "jpeg", "png", "gif", "bmp", "JPG", "PNG");

		if (in_array($extension, $allowed_extensions)) {
			$name = $path_parts['basename'];
			if (!is_file_in_DB($name)) {
				move_uploaded_file($_FILES['path']['tmp_name'][$k], "../storage/".$picture_name);
				add_files_to_DB($picture_name, $_SESSION['pseudo']);
				resize_image($picture_name);
			}
		}
		header('Location: ../drive/');
	}
} else {
	header('Location: ../drive/');
}

?>
