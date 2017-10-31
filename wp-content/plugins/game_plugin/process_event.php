<?php

/*
  Plugin Name: process_event
 */
 include_once 'parameters/parameters.php';

function count_test(){
    $db = openBDD();
     $bdd = $db->prepare('select count(*) from events');
     $bdd->execute();
   print_r($bdd->fetch()[0]);
    
        
}

function check_event(){
    $db = openBDD();
     $bdd = $db->prepare('SELECT position FROM `events` WHERE id_partie = 1 ');
     $bdd->execute();
     print_r($bdd->fetchALL());
}

function delete_event(){
    $db = openBDD();
     $bdd = $db->prepare('DELETE FROM `events` WHERE id = 1');
     $bdd->execute();
     print_r($bdd->fetchALL());
}

