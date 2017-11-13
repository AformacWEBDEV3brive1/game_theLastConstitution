<?php

/*
  Plugin Name: process_event
 */
include_once 'parameters/parameters.php';
include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

function count_test() {
    $db = openBDD();
    $bdd = $db->prepare('select count(*) from events');
    $bdd->execute();
    print_r($bdd->fetch()[0]);
}

function check_event($id_partie) {
    $db = openBDD();
    $bdd = $db->prepare('SELECT position FROM `events` WHERE id_partie = ? ');
    $bdd->execute(array($id_partie));
    return $bdd->fetchALL();
}


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

function event_check_position($id_partie) {
    $position_joueur = get_position(false,$id_partie);
    $place_event = check_event($id_partie);

    $json = "";
    foreach ($place_event as $value) {

        if ($value[0] == $position_joueur) {

            $db = openBDD();
            $bdd = $db->prepare('SELECT type, valeur FROM `events` WHERE id_partie = ? AND position=?');
            $bdd->execute(array($id_partie, $position_joueur));
            $xxx = $bdd->fetchALL();
            $json = json_encode($xxx);
            break;
        }
    }
    if ($json != "") {
        event_delete($id_partie, $position_joueur);
        echo $json;
        
    } else {
        echo '';
       
    }
}

;





