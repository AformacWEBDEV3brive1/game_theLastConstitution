<?php

function openBDD(){
    $connexion_string =  "mysql:host=127.0.0.1;dbname=wordpress;charset=utf8";
    $login = "root";
    $mdp = "mega6*3zd";
    
    $bdd = new PDO($connexion_string, $login, $mdp);
    
    return $bdd;
}

?>
