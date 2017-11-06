<?php

/*
  Plugin Name: Process_building
 */

include_once 'parameters/parameters.php';

include_once 'process_general.php';

function upgrade_building($id_partie, $id_equipe, $id_batiments) {
    try {
        $db = openBDD();
        $current_id_user = get_current_user_id();
        $bdd = $db->prepare("SELECT xp , niveau FROM `batiments` WHERE id_partie = ? AND equipe = ? AND id = ?");
        $bdd->execute(array($id_partie, $id_equipe, $id_batiments));
        $result = $bdd->fetchALL();
        
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
upgrade_building(1, 1, 1);