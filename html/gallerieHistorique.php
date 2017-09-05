<?php

function gallerieHistorique ( $repertoireImages )
{
	// Ouverture du répertoire
	$repertoire = opendir( $repertoireImages );
	$counter = 0;

	$output .="<div class='row'>";

	// Boucle
	while (false !== ($image = readdir($repertoire)))
	{
		// Exclusion des fichiers cachés
		if ($image != '.' && $image != '..')
		{
			$output .= "<div class='col-lg-2 col-sm-12 col-xs-12' id=thumbs>";
			$output .= "<img src='{$repertoireImages}{$image}'/>";
			$output .= "</div>";

			$counter += 1;

			if ($counter % 4 == 0)
			{
				$output .= "<!-- Fin de génération -->";
			}
		}
	}

	$output .="</div>";

	// Fin de scan
	closedir ($repertoire);

	// Ouverture de l'html
	$handle = fopen ("thumbHisto.html", "w");

	// Ecriture de l'html
	fwrite ($handle, $output);
	// Fermé
	fclose ($handle);
}

gallerieHistorique("../dependencies/images/");
?>