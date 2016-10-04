<?php
$err = "";

if (isset($_GET['err'])) {
	if ($_GET['err'] == 1) {
		$err = '<span style="color:red">Ce pseudo est déjà pris.</span>';
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Inscription</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/photos12.png" />
</head>

<body>
<form method="post" action="inscription.php">
	<p><input type="text" name="pseudo" placeholder="pseudo" autofocus="true" required="true"><?php echo $err; ?></p>
	<p><input type="password" name="password" placeholder="password" required="true"></p>	
	<!-- <p><input type="submit" value="Inscription"></p> -->
</form>

<a href="../">Accueil</a>

</body>

</html>
