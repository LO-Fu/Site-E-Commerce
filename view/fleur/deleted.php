<?php
	echo "<p>La fleur d'identifiant $id a été supprimée.</p>";
	require File::build_path(array("view","fleur","list.php"));