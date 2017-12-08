<?php

/*
  Plugin Name: Process_lobby
 */


include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

function get_all_games() {

    global $wpdb;

    try {
        $query = $wpdb->get_results("SELECT * FROM `games_metadata`");

        $query = json_decode(json_encode($query), true);
        // print_r($query);

        return $query;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function set_user($id_joueur, $id_partie) {

    global $wpdb;
    try {
        error_log($_POST[id_partie]);
        //Insert l'objet si n'existe PAS dans la table
        $query = $wpdb->insert(
                'games_data', //table name
                array(
            'id_joueur' => get_current_user_id(),
            'id_partie' => $id_partie,
            'position' => '0;0',
            'points_action' => 25,
            'equipe' => 1
                ), array(
            '%d',
            '%d',
            '%s',
            '%d',
            '%d',
                )
        );
        return $query;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function subscribe_game() {

    global $wpdb;
    $id_joueur = get_current_user_id();

    // joueur present dans table ? isLookingforgame() 
    // si isLookingforgame() return true => rien faire  
    // si isLookingforgame() return false => insert 

    try {
        if (isLookingforgame($id_joueur) == false) {
            //Insert l'objet si n'existe PAS dans la table
            $query = $wpdb->insert(
                    'lobby', //table name
                    array(
                'id_joueur' => get_current_user_id()
                    ), array(
                '%d'
                    )
            );
            echo compteur_get_mate();
        } else {
            echo "null";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function isLookingforgame($id_joueur = null) {
    global $wpdb;

    if ($id_joueur == null)
        $id_joueur = get_current_user_id();

    try {
        $query = $wpdb->get_results("SELECT * FROM `lobby` WHERE id_joueur = $id_joueur");

        $query = json_decode(json_encode($query), true);
        // print_r($query);

        return $query;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function compteur_get_mate() {
    global $wpdb;
    $query = $wpdb->get_var("SELECT COUNT(*) FROM `lobby`");
    error_log("fsdfsdfsdgsdgsgd " . $query);
    return $query;
}
