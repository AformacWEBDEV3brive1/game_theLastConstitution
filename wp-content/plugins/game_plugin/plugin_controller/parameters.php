<?php
$connexion_string =  "mysql:host=127.0.0.1;dbname=game_last_constitution;charset=utf8";
$login = "root";
$mdp = "ezaltar";


function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}