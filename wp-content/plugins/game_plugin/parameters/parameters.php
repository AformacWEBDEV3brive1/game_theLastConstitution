<?php
$connexion_string = "mysql:dbname=gameTheLastConstitution;host=127.0.0.1;charset=utf8";
$login = "root";
$mdp = "mega6*3zd";

function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
