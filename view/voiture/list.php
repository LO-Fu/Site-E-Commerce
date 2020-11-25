<?php
    foreach ($tab_v as $v){
        $g=$v->getImmatriculation();
        $g1=htmlspecialchars($g);
        $g2=rawurlencode($g);
        echo "<p> Voiture d\'immatriculation <a href='index.php?controller=voiture&action=read&immat=$g2'> $g1</a></p>";
    }
    ?>