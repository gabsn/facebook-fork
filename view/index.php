<?php
session_start();
include('../fonction.php');

function next_image($id) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT id FROM photos WHERE id > :id");
	$req->execute(array("id"=>$id));
	$ligne = $req->fetch();
	if ($ligne == false) {
		return $id;
	} else {
		return $ligne['id'];
	}
}

function prev_image($id) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT id FROM photos WHERE id < :id ORDER BY id DESC");
	$req->execute(array("id"=>$id));
	$ligne = $req->fetch();
	if ($ligne == false) {
		return $id;
	} else {
		return $ligne['id'];
	}
}

if (!isset($_SESSION['pseudo'])
	|| !isset($_GET['id'])
	|| empty($_GET['id'])){
		header('Location: ../drive');
	} else {
		$id_img = $_GET['id'];
		$img = "<img src='view.php?id=".$id_img."'/>";
		$entete_form_suppimg = '<form style="display: inline" method="post" action="sup_img.php?id='.$id_img.'">';
		$form_delet = "";
		if (is_allowed_to_delete($id_img, $_SESSION['pseudo'])) {
			$form_delete = '<form style="display: inline" method="post" action="sup_img.php?id='.$id_img.'">
					<input type="submit" value="Supprimer" style="margin: 0px 2px 0px 5px">
					</form>';
		}
		$id_next_image = next_image($id_img);
		$id_prev_image = prev_image($id_img);
		$lien_prev = "<a href='../view/?id=".$id_next_image."'><img src='../images/left_arrow.png' /></a>";
		$lien_next = "<a href='../view/?id=".$id_prev_image."'><img src='../images/right_arrow.png' /></a>";
		$next = "'../view?id=".$id_prev_image."'";
		$prev = "'../view?id=".$id_next_image."'";
		$identifications = display_identification($id_img);
	}

?>

<!DOCTYPE html> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>View</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/photos12.png" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>

<script> 
function keyListener(e) {
	switch (e.keyCode) {
	case 37:
		window.location.replace(<?php echo $prev; ?>);
		break;
	case 39:
		window.location.replace(<?php echo $next; ?>);
		break;
	case 8:
		window.location.replace('../drive/');
		break;
	}
};

document.onkeydown = keyListener;
</script>

<div style="margin: 2px">
	<a href="../drive/"> Retour au drive </a>
	<div>
		<div class="arrows">
			<a href=<?php echo $prev; ?> ><img src='../images/left_arrow.png' /></a>
			<a href=<?php echo $next; ?> ><img src='../images/right_arrow.png' /></a>
		</div>

		<form method="post" action="identification.php?id=<?php echo $id_img; ?>" >
			<input id="search" name="identite" type="text" autocomplete="off" />
			<div id="results"></div>
			<input type="submit" value="Identifier" />
		</form>
		
		<div>
			<p>Personnes identifiées sur cette photo :</p>
			<?php echo $identifications; ?>
		</div>

	</div>

	<?php echo $form_delete; ?>
</div>

<div class="hd">
	<?php echo $img; ?>
</div>

<script src="auto.js"></script>
</body>
</html>
