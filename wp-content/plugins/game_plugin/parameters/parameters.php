<?php

$connexion_string = "mysql:dbname=the_last_constitution;host=127.0.0.1;charset=utf8";

$login = "root";
$mdp = "123456";



function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
