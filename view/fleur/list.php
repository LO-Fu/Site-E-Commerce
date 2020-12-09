<?php
    foreach ($tab_v as $v){
        $gv=$v->get('variete');
        $gc=$v->get('couleur');
        $gp=$v->get('prix');
        $gv1=htmlspecialchars($gv);
        $gc1=htmlspecialchars($gc);
        $gp1=htmlspecialchars($gp);
        $gv2=rawurlencode($gv);
        $gc2=rawurlencode($gc);
        $f=$gv.$gc;

        echo "<div><p><a href='index.php?controller=fleur&action=read&variete=$gv2&couleur=$gc2'> Fleur de la variété $gv1 et de couleur $gc1, Prix : $gp1 €</a></p>";
        echo "<a href='index.php?controller=fleur&action=read&variete=$gv2&couleur=$gc2'><img class='img_galerie' src='../site-e-commerce/img/fleurs/$gv/$f.jpg' /></a></div>";
    }
    ?>