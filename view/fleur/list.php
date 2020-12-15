<?php
    foreach ($fleurs as $fleur){
        $gv=$fleur->get('variete');
        $gc=$fleur->get('couleur');
        $gp=$fleur->get('prix');
        $id= rawurldecode($fleur->get('id'));
        $gv1=htmlspecialchars($gv);
        $gc1=htmlspecialchars($gc);
        $gp1=htmlspecialchars($gp);
        $f=$gv.$gc;

        echo "<div><p><a href='index.php?controller=fleur&action=read&id=$id'> Fleur de la variété $gv1 et de couleur $gc1, Prix : $gp1 €</a></p>";
        echo "<a href='index.php?controller=fleur&action=read&id=$id'><img class='img_galerie' src='../site-e-commerce/img/fleurs/$gv/$f.jpg' /></a></div>";
    }
    ?>