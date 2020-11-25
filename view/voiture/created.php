<p>La voiture a bien été créée !</p>
<?php
	$tab_v = ModelVoiture::getAllVoitures();
	require File::build_path(array("view","voiture","list.php"));
?>