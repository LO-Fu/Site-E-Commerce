<?php
	$tab_v=ModelVoiture::getAllVoitures();
	echo "<p>La voiture d\'immatriculation $p a bien été modifié.</p>";
	require File::build_path(array("view","voiture","list.php"));
?>