<?php
	$g1=$v->getImmatriculation();
	$g2=$v->getMarque();
	$g3=$v->getCouleur();
	$g11=htmlspecialchars($g1);
	$g21=htmlspecialchars($g2);
	$g31=htmlspecialchars($g3);
	$g12=rawurlencode($g1);
    echo "<p> Voiture d'immatriculation $g11, de marque $g21 et de couleur $g31 <a href='index.php?controller=voiture&action=delete&immat=$g12'>		supprimer </a> <a href='index.php?controller=voiture&action=update&immat=$g12'>		modifier</a></p>";
?>