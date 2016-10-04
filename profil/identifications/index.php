<?php
session_start();
include('../../fonction.php');

$afficher_images = "";

if (isset($_SESSION["pseudo"])) {
	$pseudo = $_SESSION["pseudo"];
	$id = get_id($pseudo);
	$afficher_images = '<div class="image_container">'.get_my_identifications($id).'</div>';	
} else {
	header("Location: ../");
}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Drive</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/photos12.png" />
	<link rel="stylesheet" href="../../style.css"/>
</head>

<body>
	<p><a href="../../drive/">Retour au drive</a></p>
	
	<?php echo $afficher_images; ?>
</body>

</html>
	

