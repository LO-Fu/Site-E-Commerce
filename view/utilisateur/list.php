<?php
    foreach ($tab_v as $v){
        $g=$v->get('login');
        $g1=htmlspecialchars($g);
        echo "<p> Utilisateur au login $g1</a></p>";
    }
    ?>