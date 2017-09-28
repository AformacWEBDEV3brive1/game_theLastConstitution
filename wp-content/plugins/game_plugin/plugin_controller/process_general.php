<?php

/*
  Plugin Name: Fonctions de base
  Description: Les fonctions de base comme get_points_actions, set_position, ...
  Version: 1.0
  Author: Benoît et Alexis
 */

include 'parameters.php';

if (isset($_POST['info'])) {
    $info = $_POST['info'];
    $info();
}

function get_points_actions($id_joueur) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT points_actions FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch();

        return $result["points_actions"];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_position($id_joueur) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch();

        return $result["position"];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function set_position($id_joueur, $nouvelle_position) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET position = ? WHERE id_joueur = ?');
        $bdd->execute(array($nouvelle_position, $id_joueur));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_all_players($id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT id_joueur FROM games_data WHERE id_partie = ?');
        $bdd->execute(array($id_partie));

        $result = $bdd->fetchALL();

        return $result; //tableau de tableau
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function delete_partie($id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('DELETE FROM games_metadata WHERE id = ?');
        $bdd->execute(array($id_partie));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function move() {
    if (isset($_POST['joueur']) && isset($_POST['new_position'])) {
        $id_joueur = $_POST['joueur'];
        $new_position = $_POST['new_position'];
        if (check_move($id_joueur, $new_position)) {
            set_position($id_joueur, $new_position);
            echo 'mouvement effectué!';
        } else {
            echo 'Pas assez de pts!';
        }
    }
}

function check_move($id_joueur, $new_position) {
    $new_pos = explode(";", $new_position);
    $new_pos_x = $new_pos[0];
    $new_pos_y = $new_pos[1];

    $old_pos = explode(";", get_position($id_joueur));
    $old_pos_x = $old_pos[0];
    $old_pos_y = $old_pos[1];

    if (abs($new_pos_x - $old_pos_x )+abs($new_pos_y - $old_pos_y) <= get_points_actions($id_joueur)) {
        echo 'pts_besoin: '.abs($new_pos_x - $old_pos_x ).'+'.abs($new_pos_y - $old_pos_y).'  pts_action: '. get_points_actions($id_joueur).'   ';
        return true;
    }
    return false;
    
}

function reset_all_points_actions($nombre_points) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET points_actions = ?');
        $bdd->execute(array($nombre_points));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
