<?php

/*
  Plugin Name: process_event
 */
include_once 'parameters/parameters.php';
include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );



//compte le nb d'event restant
function count_test() {
    $db = openBDD();
    $bdd = $db->prepare('select count(*) from events');
    $bdd->execute();
    print_r($bdd->fetch()[0]);
}

//prend en parametre l'id de la partie
//renvoie l=les positions des events
function check_event($id_partie) {
    $db = openBDD();
    $bdd = $db->prepare('SELECT position FROM `events` WHERE id_partie = ? ');
    $bdd->execute(array($id_partie));
    return $bdd->fetchALL();
}

//sans argument efface tout les events de toutes le base de donnée ;
//avec un argument id_partie efface les events de la partie concerné ;
//avec un arg id_partie + position efface l'event à cette position ; 
function event_delete($id_partie = false, $position = false) {
    $db = openBDD();
    if ($id_partie == false) {
        $bdd = $db->prepare('DELETE FROM `events`');
        $bdd->execute(array($id_partie));
    } else if ($position == false) {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        $bdd = $db->prepare('DELETE  FROM `events` WHERE id_partie = ?');
        $bdd->execute(array($id_partie));
    } else {
        $bdd = $db->prepare('DELETE FROM `events` WHERE id_partie = ? AND position = ?');
        $bdd->execute(array($id_partie, $position));
    }
}

//prend en parametre l'id_partie
//lance les fonctions relative à la gestion des events
//envoie un format json au client 
function event_check_position($id_partie) {
    
    $position_joueur = get_position(false,$id_partie);
    $place_event = check_event($id_partie);
    
    $json = "";
    foreach ($place_event as $value) {
        if ($value[0] == $position_joueur) {
            
            $db = openBDD();
            $bdd = $db->prepare('SELECT type, valeur FROM `events` WHERE id_partie = ? AND position=?');
            $bdd->execute(array($id_partie, $position_joueur));
            $tmp = $bdd->fetchAll();
           
            //transforme le resultat objet en tableau
            foreach($tmp as $value){
                $type[]=$value[0];
                $valeur[]=$value[1];
            }
            
            $type=$type[0];
            $valeur=$valeur[0];
            
            //affecte la base donnée
            event_effect_to_database($type, $valeur);
            //encode le resultat de la requete en format jSon;
            $json = json_encode($tmp);
            
            break;
        }
    }
    //si $json N'EST PAS VIDE 
    if ($json != "") {
        //efface l'event cibler
        event_delete($id_partie, $position_joueur);
        echo $json;
        
            }else {
        echo '';
       
    }
    
}
//prend en parametre un type(+/-) et une valeur
//calcul les effets des events
//modifie la table games_data
function event_effect_to_database($type,$valeur){
    
    $id_joueur= get_current_user_id();
    
    
            $db = openBDD();
            $bdd = $db->prepare('SELECT points_action FROM `games_data` WHERE id_joueur=?' );
            $bdd->execute(array($id_joueur));
            $xxx = $bdd->fetchALL();
           
            //test les types pour calcul
            if($type == "+"){
               $points_action = intval($xxx[0][0]) + $valeur;
            }else if($type=="-"){
               $points_action = $xxx[0][0] - $valeur;
            }
            
            
            $bdd = $db->prepare('UPDATE games_data SET points_action=? WHERE id_joueur=?' );
            $bdd->execute(array($points_action, $id_joueur));
}





