
<?php

/*
  Plugin Name: Process_general
 */

require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );
include_once 'parameters/parameters.php';

if (isset($_POST['info'])) {
    $info = $_POST['info'];
    $info();
}

function get_points_action($id_joueur) {
    error_log(__FUNCTION__);

    try {
        error_log("debut try __FUNCTION__");
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT points_action FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch();
        error_log("fin try __FUNCTION__");
        return $result["points_action"];
    } catch (PDOException $e) {
        error_log("exeption __FUNCTION__");
        return $e->getMessage();
    }
}

function get_position($all = false) {
    if ($all == false) {
        $id_joueur = get_current_user_id();
        error_log("id joueur : " . $id_joueur);

        try {
            $db = openBDD(); //fonction pour ouvrir acces BDD

            $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ?');
            $bdd->execute(array($id_joueur));

            $result = $bdd->fetch();
            error_log('fin traitement bdd');
              echo $id_joueur;
            return $result["position"];
        } catch (PDOException $e) {
            error_log('exception bdd');
            return $e->getMessage();
        }
    } 
}

function set_position($id_joueur, $nouvelle_position) {
    error_log("set position begin", 0);
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
    error_log("Je passe ici !!!", 0);
    if (isset($_POST['new_position'])) {
        $id_joueur = get_current_user_id();
        $new_position = $_POST['new_position'];
        error_log("joueur : " . $id_joueur, 0);
        error_log("nex position : " . $new_position, 0);
        if (check_move($id_joueur, $new_position)) {
            set_position($id_joueur, $new_position);
            echo 'mouvement effectué!';
            error_log("move ok", 0);
        } else {
            echo 'Pas assez de pts!';
            error_log("move pas ok", 0);
        }
    }
}

function check_move($id_joueur, $new_position) {
    $new_pos = explode(";", $new_position);
    $new_pos_x = $new_pos[0];
    $new_pos_y = $new_pos[1];

    $old_pos = explode(";", get_position());
    $old_pos_x = $old_pos[0];
    $old_pos_y = $old_pos[1];

    error_log('pts_besoin: ' . abs($new_pos_x - $old_pos_x) . '+' . abs($new_pos_y - $old_pos_y) . '  pts_action: ' . get_points_action($id_joueur) . '   ');

    if (abs($new_pos_x - $old_pos_x) + abs($new_pos_y - $old_pos_y) <= get_points_action($id_joueur)) {
        return true;
    }
    return false;
}

function reset_all_points_action($nombre_points) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET points_action = ?');
        $bdd->execute(array($nombre_points));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
