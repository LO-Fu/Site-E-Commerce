<?php
    var_dump($_SESSION['panier']);
    foreach($_SESSION['panier'] as $attribute){
        if (is_array($attribute)){
            foreach ($attribute as $key => $value){
                echo $value;
            }
        }
    }