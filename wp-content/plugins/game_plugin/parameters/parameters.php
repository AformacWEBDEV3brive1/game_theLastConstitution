<?php


$connexion_string = "mysql:dbname=game_theLastConstitution_wp;host=127.0.0.1;charset=utf8";

$login = "root";
$mdp = "limogescsp";

function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
