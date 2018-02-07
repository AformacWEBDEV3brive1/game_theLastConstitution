<?php

$connexion_string = "mysql:dbname=game_last_constitution;host=127.0.0.1;charset=utf8";

$login = "root";
$mdp = "123456789$";



function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
