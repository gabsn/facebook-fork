<?php
session_start();
include('../fonction.php');

$connexion = "";
$afficher_images = "";

if (isset($_SESSION["pseudo"])) {
	$pseudo = $_SESSION["pseudo"];
	$connexion = "Bienvenu à toi cher ".$pseudo." !";
	$afficher_images = '<div class="image_container">'.get_all_pictures().'</div>';	
} else {
	header("Location: ../");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Drive</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/photos12.png" />
	<link rel="stylesheet" href="../style.css"/>
</head>
<body>
	<p><?php echo $connexion; ?><a href="../deconnexion.php">Deconnexion</a></p>
	<p>Viens <a href="../profil/"><?php echo $pseudo; ?></a>, on est bien...</p>
	
	<form method="post" action="upload_files.php" enctype="multipart/form-data">
		<p><input type="file" name="path[]" multiple="multiple"></p>
		<p><input type="submit" value="Upload"></p>
	</form>
	<?php echo $afficher_images; ?>
</body>

</html>
	

