<?php
    foreach ($tab_v as $v){
        $gv=$v->get('variete');
        $gc=$v->get('couleur');
        $gp=$v->get('prix');
        $gv1=htmlspecialchars($gv);
        $gc1=htmlspecialchars($gc);
        $gp1=htmlspecialchars($gp);

        $f=$gv.$gc;

        echo "<p> Fleur de la variété $gv1 et de couleur $gc1, Prix : $gp1 €</p>";
        echo "<img class='img_fleur' src='../site-e-commerce/img/fleurs/$gv/$f.jpg' />";
    }
    ?>