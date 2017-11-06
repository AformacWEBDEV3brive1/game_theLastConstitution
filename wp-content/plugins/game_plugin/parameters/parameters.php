
<?php
$connexion_string = "mysql:dbname=game_last_constitution;host=127.0.0.1;charset=utf8";


$connexion_string = "mysql:dbname=game_last_constitution_wp;host=127.0.0.1;charset=utf8";
$mdp = "rastaman66";
function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
