<?php
	$g1=$v->get('login');
	$g2=$v->get('nom');
	$g3=$v->get('prenom');
	$g11=htmlspecialchars($g1);
	$g21=htmlspecialchars($g2);
	$g31=htmlspecialchars($g3);
	$g12=rawurlencode($g1);

    echo "<p> L'utilisateur au login $g11, qui s'appelle $g21 $g31 .<a href='index.php?controller=utilisateur&action=delete&login=$g12'>		supprimer </a> <a href='index.php?controller=utilisateur&action=update&login=$g12'>		modifier</a></p>";
?>