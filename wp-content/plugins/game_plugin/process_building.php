<?php

/*
  Plugin Name: Process_building
 */

include_once 'parameters/parameters.php';
include_once 'process_general.php';

if ($_POST["called_ajax_php"] == "process_building.php") {
    if (isset($_POST['php_function_file'])) {
        if ($_POST["php_function_file"] == 'get_information_buildings' || $_POST["php_function_file"] == 'get_ids_building' || $_POST["php_function_file"] == 'add_xp_to_bat') {
            if (isset($_POST['id_building'])) {
                $id_building = $_POST['id_building'];
            }
            if (isset($_POST['xp'])) {
                $xp = $_POST['xp'];
            }
            if (isset($_POST['id_partie'])) {
                $id_partie = $_POST['id_partie'];
            }
            $info_building = $_POST['php_function_file'];
            $info_building();
        }
    }
}

//Retourne les informations (xp , niveau , type ) de tous les batiments 
function get_information_buildings() {
    try {
        global $id_partie;
        $equipe = get_team(get_current_user_id(), $id_partie);
        $db = openBDD();
        $bdd = $db->prepare("SELECT xp , niveau , type FROM `batiments` WHERE id_partie = ? AND equipe = ?");
        $bdd->execute(array($id_partie, $equipe));
        $result = $bdd->fetchALL();
        echo json_encode($result);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_information_buildings_return($id_partie) {
    try 
    {
        $equipe = get_team(get_current_user_id(), $id_partie);        
        
        global $wpdb;
        $prepare = $wpdb->prepare("SELECT xp , niveau , type FROM batiments WHERE id_partie = %d AND equipe = %d", $id_partie, $equipe);
        $results = $wpdb->get_results($prepare);
        
        return $results;
    } 
    catch (Exception $e) 
    {
        return $e->getMessage();
    }
}

function check_enough_xp_for_lvlup($id_building, $xp_total) {
    try {
        $current_lvl = get_current_lvl($id_building);

        $limite_xp = get_limitxp_for_lvlup();

        if ($xp_total >= $limite_xp[0]['limite_xp'] && $xp_total < $limite_xp[1]['limite_xp']) {
            $level = 1;
        } else if ($xp_total >= $limite_xp[1]['limite_xp'] && $xp_total < $limite_xp[2]['limite_xp']) {
            $level = 2;
        } else if ($xp_total >= $limite_xp[2]['limite_xp'] && $xp_total < $limite_xp[3]['limite_xp']) {
            $level = 3;
        } else if ($xp_total >= $limite_xp[3]['limite_xp'] && $xp_total < $limite_xp[4]['limite_xp']) {
            $level = 4;
        } else if ($xp_total >= $limite_xp[4]['limite_xp']) {
            $level = 5;
        }

        if ($current_lvl != $level) {
            return $level;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function add_xp_to_bat() {
    try {
        global $xp;
        global $id_building;
        global $id_partie;
        
        $pa_depense = 1;
        
        $xp_total = get_current_xp($id_building) + $xp;

        $level = check_enough_xp_for_lvlup($id_building, $xp_total);
        $db = openBDD();
        
        $id_joueur = get_current_user_id();
        $pa_joueur = get_points_action($id_joueur, $id_partie);
        
        if($pa_joueur >= 1)
        {
            nouveau_montant_pa($id_joueur, $pa_joueur - $pa_depense, $id_partie);
            echo $pa_joueur - $pa_depense;

            if ($level != 0) {
                $bdd = $db->prepare("UPDATE batiments SET niveau = ? , xp = ? WHERE id = ?");
                $bdd->execute(array($level, $xp_total, $id_building));
            } else {
                $bdd = $db->prepare("UPDATE batiments SET xp = ? WHERE id = ?");
                $bdd->execute(array($xp_total, $id_building));
            }
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_current_lvl($id_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT niveau FROM `batiments` WHERE id = ?");
        $bdd->execute(array($id_building));
        $result = $bdd->fetchAll();
        return $result[0]['niveau'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_current_xp($id_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT xp FROM `batiments` WHERE id = ?");
        $bdd->execute(array($id_building));
        $result = $bdd->fetchAll();
        return $result[0]['xp'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_limitxp_for_lvlup() {
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT limite_xp FROM `level_batiments`");
        $bdd->execute();
        $result = $bdd->fetchAll();
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_ids_building() {
    try {
        global $id_partie;
        $equipe = get_team(get_current_user_id(), $id_partie);

        $db = openBDD();
        $bdd = $db->prepare("SELECT id FROM `batiments` WHERE id_partie = ? AND equipe = ?");
        $bdd->execute(array($id_partie, $equipe));
        $result = $bdd->fetchALL();

        echo json_encode($result);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
