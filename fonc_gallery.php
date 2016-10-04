<?php

function resize_image($name) {
	$final_width = 300;
	echo "final_width :".$final_width;
	$imagick = new Imagick('../storage/'.$name);
	echo "création de imagick";
	$original_width = $imagick->getImageWidth();
	echo "obtention de la largeur :".$original_width;
	$ratio = $original_width / $final_width;
	echo "obtention du ratio :".$ratio;
	$final_height = $imagick->getImageHeight() / $ratio;
	echo "obtention de la hauteur :".$final_height;

	$imagick->adaptiveResizeImage($final_width, $final_height);
	echo "redimensionnement de l'image.";
	$imagick->writeImage('../storage_mini/'.$name);
	echo "écriture du fichier image redimensionner";
}

?>




