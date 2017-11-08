<?php

/*
  Plugin Name: Process_building
 */

include_once 'parameters/parameters.php';

include_once 'process_general.php';

if ($_POST["called_ajax_php"] == "process_building.php") {

    if ($_POST["php_function_file"] == 'get_information_building') {
        if (isset($_POST['php_function_file'])) {
            $info_building = $_POST['php_function_file'];
            $info_building();
        }
    }

    if ($_POST["php_function_file"] == 'get_ids_building') {
        if (isset($_POST['php_function_file'])) {
            $id_building = $_POST['php_function_file'];
            $id_building();
        }
    }
}

function get_information_building($id_partie, $id_equipe, $id_building, $info_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("SELECT xp , niveau , type FROM `batiments` WHERE id_partie = ? AND equipe = ? AND id = ?");
        $bdd->execute(array(1, 1, 4));
        $result = $bdd->fetchALL();
        echo json_encode($result);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function add_lvl_to_bat($level, $id_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("UPDATE batiments SET niveau = ? WHERE id = ?");
        $bdd->execute(array($level, $id_building));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function check_enough_xp_for_lvlup() {
    try {
        $current_lvl = get_current_lvl(1);
        $current_xp = get_current_xp(1);
        $limite_xp = get_limitxp_for_lvlup();
        if ($current_xp < $limite_xp[0]['limite_xp']) {
            
        } else if ($current_xp < $limite_xp[1]['limite_xp']) {
            
        } else if ($current_xp < $limite_xp[2]['limite_xp']) {
            
        } else if ($current_xp < $limite_xp[3]['limite_xp']) {
            
        } else if ($current_xp < $limite_xp[4]['limite_xp']) {
            
        }
        echo $current_lvl . "  " . $limite_xp[0]['limite_xp'] . "   " . $current_xp;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function add_xp_to_bat($xp, $id_building) {
    try {
        $db = openBDD();
        $bdd = $db->prepare("UPDATE batiments SET xp = ? WHERE id = ?");
        $bdd->execute(array($xp, $id_building));
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
        //print_r($result);
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
        $db = openBDD();
        $bdd = $db->prepare("SELECT id FROM `batiments`");
        $bdd->execute();
        $result = $bdd->fetchALL();

        echo json_encode($result);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

