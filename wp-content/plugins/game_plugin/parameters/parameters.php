<?php
<<<<<<< HEAD:wp-content/plugins/game_plugin/plugin_controller/parameters.php
$connexion_string = "mysql:dbname=gameTheLastConstitution;host=127.0.0.1;charset=utf8";
$login = "root";
$mdp = "mega6*3zd";
=======
$connexion_string = "mysql:dbname=game_last_constitution;host=127.0.0.1;charset=utf8";
$login = "root";
$mdp = "123456789$";
>>>>>>> f59e53b18d894a9eb5871bcf531646337fb5aa2e:wp-content/plugins/game_plugin/parameters/parameters.php

function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}