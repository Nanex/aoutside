<?php
function createThumbs ( $repertoireImages, $repertoireThumbs, $thumbWidth)
{
	$repertoire = opendir( $repertoireImages );

	while (false !== ($image = readdir($repertoire))) {
		$info = pathinfo($repertoireImages . $image);


		// Création des thumbnails de Jpeg
		if (strtolower($info['extension']) == 'jpg') {
			echo "Création de Thumbnail pour {$image} <br/>";

			$img = imagecreatefromjpeg( "{$repertoireImages}{$image}" );
			$width = imagesx($img);
			$height = imagesy($img);

			// Calcul taille thumbnail
			$n_width = $thumbWidth;
			$n_height = floor ( $height * ( $thumbWidth / $width));

			// Image temp
			$tmp_img = imagecreatetruecolor($n_width, $n_height);

			// Copie et resize
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

			// Sauvegarde des Thumbs
			imagejpeg($tmp_img, "{$repertoireThumbs}{$image}");
		}
	}

	closedir($repertoire);
}

createThumbs ("../dependencies/images/", "../dependencies/images/thumbs/", 250);
?>