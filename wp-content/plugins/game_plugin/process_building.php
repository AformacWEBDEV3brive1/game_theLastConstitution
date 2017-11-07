<?php

/*
  Plugin Name: Process_building
 */

include_once 'parameters/parameters.php';

include_once 'process_general.php';

if(isset($_POST['info_building'])){
    $info_building = $_POST['info_building'];
    $info_building();
}
else if(isset($_POST['id_building'])){
    $id_building = $_POST['id_building'];
    $id_building();    
}

error_log($_POST['id_building']);

function get_information_building($id_partie, $id_equipe, $id_building, $info_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT xp , niveau , type FROM `batiments` WHERE id_partie = ? AND equipe = ? AND id = ?");
        $bdd->execute(array($id_partie, $id_equipe, $id_building));
        $result = $bdd->fetchALL();
        echo json_encode($result);
        
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function add_xp_to_bat($xp, $id_building){
    try{
        $db = openBDD();
        $bdd = $db->prepare("UPDATE batiments SET xp = ? WHERE id = ?");
        $bdd->execute(array($xp, $id_building));
    } catch (PDOException $e){
        return $e->getMessage();
    }
}

function get_ids_building(){
    try{
        $db = openBDD();
        $bdd = $db->prepare("SELECT id FROM `batiments`");
        $bdd->execute();
        $result = $bdd->fetchALL();
        
        echo json_encode($result);
    } catch (PDOException $e){
        return $e->getMessage();
    }
}

get_ids_building();

function get_current_xp(){
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT xp FROM `batiments`");
        $bdd->execute();
        $result = $bdd->fetchAll();
        print_r($result);
    } catch (PDOException $e){
        return $e->getMessage();
    }
}

function get_current_lvl(){
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT niveau FROM `batiments`");
        $bdd->execute();
        $result = $bdd->fetchAll();
        print_r($result);
    } catch (PDOException $e){
        return $e->getMessage();
    }
}