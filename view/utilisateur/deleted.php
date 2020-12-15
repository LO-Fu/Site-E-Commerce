<?php
	echo "<p>L'utilisateur au login $p a été supprimé.</p>";
	require File::build_path(array("view","utilisateur","list.php"));