<?php

/*
  Plugin Name: process_event
 */
 include_once 'parameters/parameters.php';
 include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

if(isset($_POST['position']) && isset($_POST['info'])){
        $info = $_POST['info'];
        $position = $_POST['position'];
        $info(1);
    }


function count_test(){
    $db = openBDD();
     $bdd = $db->prepare('select count(*) from events');
     $bdd->execute();
   print_r($bdd->fetch()[0]);
    
        
}

function check_event($id_partie){
    $db = openBDD();
     $bdd = $db->prepare('SELECT position FROM `events` WHERE id_partie = ? ');
     $bdd->execute(array($id_partie));
     return $bdd->fetchALL();
}

/*function delete_event(){
    $db = openBDD();
     $bdd = $db->prepare('DELETE FROM `events` WHERE id = 1');
     $bdd->execute();
     print_r($bdd->fetchALL());
}*/

function event_delete($id_partie = false, $position = false){
     $db = openBDD();
        if ($id_partie == false){           
            $bdd = $db->prepare('DELETE FROM `events`');
            $bdd->execute(array($id_partie));   
        }
            else if($position == false){
            $db = openBDD(); //fonction pour ouvrir acces BDD
            $bdd = $db->prepare('DELETE  FROM `events` WHERE id_partie = ?');
            $bdd->execute(array($id_partie));      
            } else {
            $bdd = $db->prepare('DELETE FROM `events` WHERE id_partie = ? AND position = ?');          
            $bdd->execute(array($id_partie, $position ));
           
        
            }
        } 
        
function event_check_position($id_partie){
    
    
    $position_joueur = get_position();
    $place_event = check_event($id_partie);   
    foreach($place_event as $value){
        error_log("VALUE 0: " . $value[0]);
        error_log(get_current_user_id());
        error_log("POSITION JOUEUR: " . $position_joueur);
        if ($value[0] == $position_joueur)
        {
            echo "event MORTELOS";
            error_log("EVENT!!!!!!");
        }
       
    };
   
    
}


