<?php
$connexion_string =  "mysql:host=127.0.0.1;dbname=LastConstitution;charset=utf8";
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