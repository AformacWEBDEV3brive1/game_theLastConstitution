<?php

/*
  Plugin Name: process_event
 */
include_once 'parameters/parameters.php';
include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

/*wp_create_category('$commentaire');*/

//count number of of event not discovered.
function count_test() {
    $db = openBDD();
    $bdd = $db->prepare('select count(*) from events');
    $bdd->execute();
    print_r($bdd->fetch()[0]);
}

//takes in parameter id_parties.
//get position of events.
function check_event($id_partie) {
    $db = openBDD();
    $bdd = $db->prepare('SELECT position FROM `events` WHERE id_partie = ? ');
    $bdd->execute(array($id_partie));
    return $bdd->fetchALL();
}

//Without arguments : delete aguments of every events on the data base.
//With arguments id_partie delete events of an specific game
//With argu id_partie + position delete event of that position.
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

//takes in parameter id_partie.
//triggers function about event management.
//Sends a Json format json to client. 
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
 
            //change the object to array.
            foreach($tmp as $value){
                $type[]=$value[0];
                $valeur[]=$value[1];
            }
            
            $type=$type[0];
            $valeur=$valeur[0];
            
            //affect the data base.
            event_effect_to_database($type, $valeur);
            //encode request result to json format.
            $json = json_encode($tmp);
            
            break;
        }
    }
    //if $json IS NOT EMPTY.  
    if ($json != "") {
        //delete targeted event
        event_delete($id_partie, $position_joueur);
        echo $json;
        
            }else {
        echo '';
       
    }
    
}
//takes in parameters a type(+/-) and a value
//calcul all effect of events.
//edit games_data table.
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