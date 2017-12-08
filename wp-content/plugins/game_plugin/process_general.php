<?php

/*
  Plugin Name: Process_general
 */

include_once 'parameters/parameters.php';
include_once 'process_loot.php';
include_once 'process_lobby.php';


// intégration function wordpress.
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

if (isset($_POST["php_function_file"])) {
    if ($_POST["php_function_file"] == "process_general.php") {
        if ($_POST["info"] == "move") {
            move($_POST["id_partie"], $_POST["new_position"]);
        }
    } else if ($_POST["php_function_file"] == "process_event.php") {
        if ($_POST["info"] == "event_check_position") {
            event_check_position($_POST["id_partie"]);
        }
    } else if ($_POST["php_function_file"] == "process_loot.php") {
        if ($_POST["info"] == 'loot_get_loot_from_coffre_ville') {

            loot_get_coffre_ville($_POST["id_equipe"], $_POST["id_partie"]);
        }
    } else if ($_POST["php_function_file"] == "process_lobby.php") {
        error.log("coucou3");
        if ($_POST["info"] == "find_game") {
            find_game
            ($_POST["info"]);
        }
    }
} else if (isset($_POST['position']) && isset($_POST['id_partie'])) {
    $info = $_POST['info'];
    $position = $_POST['position'];
    $id_partie = $_POST['id_partie'];
    $info($position, $id_partie);
} else if (isset($_POST['id_partie'])) {
    $info = $_POST['info'];
    $id_partie = $_POST['id_partie'];
    $info($id_partie);
} else if (isset($_POST['position'])) {
    $info = $_POST['info'];
    $position = $_POST['position'];
    $id_partie = $_POST['id_partie'];
    $info($position, $id_partie);
} else if (isset($_POST['info'])) {
    $info = $_POST['info'];
    $info();
}

//Prend en entrée l'ID d'un joueur.
// retourne le nombre de points d'action d'un joueur ou une exception.
function get_points_action($id_joueur, $id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT points_action FROM games_data WHERE id_joueur = ? AND id_partie = ?');
        $bdd->execute(array($id_joueur, $id_partie));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        return $result["points_action"];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// Paramètre d'entrée est un boolean par défault a "false". Remplacer "false" par "true" pour avoir tous les joueurs.
// Retoune la position SOIT d'un joueur SOIT de tous les joueurs (sous forme de tableau) ou une exception.
// l'id du joueur sera le joueur connecté (get_current_user_id()).
function get_position_by_id($id_partie, $id_joueur) {

//    echo $id_joueur;
    if ($id_joueur == null) {
        $id_joueur = get_current_user_id();
    }
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ? AND id_partie= ? ');
        $bdd->execute(array($id_joueur, $id_partie));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        return $result["position"];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_position($all = false, $id_partie) {
    if ($all == false) {

        $id_joueur = get_current_user_id();

        try {
            $db = openBDD(); //fonction pour ouvrir acces BDD

            $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ? AND id_partie= ? ');
            $bdd->execute(array($id_joueur, $id_partie));

            $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
            return $result["position"];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } elseif ($all == true) {
        try {
            $db = openBDD(); //fonction pour ouvrir acces BDD
            $bdd = $db->prepare('SELECT id_joueur, position FROM games_data WHERE id_partie = ?');
            $bdd->execute(array($id_partie));

            $result = $bdd->fetchALL(); //fetchALL retourne toute les valeurs sous forme de tableau.

            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } elseif ($all == "myteam)") {

//      return $team_position_joueur;
        //retourne tableau contenant id joueurs de ma team
    }
}

// Paramètres d'entrée: id_joueur et nouvelle_position (sous la forme x;y)
// Met a jour la position d'un joueur dans la base.
// Retourne eventuellement une exception si problème.
function set_position($id_joueur, $nouvelle_position, $id_partie) {
    //error_log("set position begin", 0);
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET position = ? WHERE id_joueur = ? AND id_partie = ?');
        $bdd->execute(array($nouvelle_position, $id_joueur, $id_partie));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// Paramètre d'entrée est l'id d'une patie.
// Supprime une partie [ADMIN]
// Retourne eventuellement une exception si problème.
function delete_partie($id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('DELETE FROM games_metadata WHERE id_partie = ?');
        $bdd->execute(array($id_partie));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// Si une nouvelle position est envoyée, alors appelle la fonction check_move, si celle-ci retourne "true"
//alors appelle set_postion.
// l'id du joueur sera le joueur connecté (get_current_user_id()).

function move($id_partie, $new_position) {
    $id_joueur = get_current_user_id();

    if (check_move($id_joueur, $new_position, $id_partie)) {
        set_position($id_joueur, $new_position, $id_partie);

        echo json_encode(array(id_partie => $_POST['id_partie'], looted => check_looted_current_player($id_partie)));
    } else {
        echo json_encode(array(id_partie => "false"));
    }
}

// Paramètres d'entrée: id_joueur et nouvelle_position (sous la forme x;y)
// Vérifie si assez de points d'action sont disponible pour se déplacer grace a la fonction get_points_action
// Si c'est le cas elle appelle nouveau_montant_pa et retoune "TRUE".
//Sinon retoune "FALSE"
function check_move($id_joueur, $new_position, $id_partie) {
    $new_pos = explode(";", $new_position);
    $new_pos_x = $new_pos[0];
    $new_pos_y = $new_pos[1];

    $old_pos = explode(";", get_position(false, $id_partie));
    $old_pos_x = $old_pos[0];
    $old_pos_y = $old_pos[1];

    $pa_joueur = get_points_action($id_joueur, $id_partie);
    $pa_necessaire = abs($new_pos_x - $old_pos_x) + abs($new_pos_y - $old_pos_y);
    if ($pa_necessaire <= $pa_joueur) {
        nouveau_montant_pa($id_joueur, $pa_joueur - $pa_necessaire, $id_partie);
        return true;
    }
    return false;
}

// Paramètre d'entrée est le nombre de P.A que l'on veut donner, par défault 25.
// Mettre les P.A de tous les joueurs a x (25).
// Retourne eventuellement une exception si problème.
function reset_all_points_action($nombre_points = 25) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET points_action = ?');
        $bdd->execute(array($nombre_points));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//Paramètre d'entrée est l'id de la partie et l'id de l'équipe.
// Obtenir l'id des joueurs de son équipe
// Retourne eventuellement une exception si problème.
function get_id_mate($id_partie, $equipe) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT id_joueur, position FROM games_data WHERE id_partie = ? AND equipe = ?');
        $bdd->execute(array($id_partie, $equipe));

        $result = $bdd->fetchALL(); //fetchALL retourne toute les valeurs sous forme de tableau.
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//Paramètre d'entrée est l'id du joueur.
// Obtenir l'id de l'équipe d'un joueur.
// Retourne eventuellement une exception si problème.
function get_team($id_joueur, $id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT equipe FROM games_data WHERE id_joueur = ? AND id_partie= ?');
        $bdd->execute(array($id_joueur, $id_partie));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        return $result[0];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_games($id_joueur) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT id_partie FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetchAll();
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//Paramètre d'entrée est l'id du joueur et son nouveau montants de P.A
// Met a jour le montant des P.A d'un joueur.
// Retourne eventuellement une exception si problème.
function nouveau_montant_pa($id_joueur, $points_action, $id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET points_action = ? WHERE id_joueur = ? AND id_partie= ?');
        $bdd->execute(array($points_action, $id_joueur, $id_partie));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//Fonction pour simuler le tour suivant. [ADMIN]
function tour_suivant() {
    reset_all_points_action();
    event_delete($_POST['id_partie']);
    create_random_event($_POST['id_partie']);
    $resultats = global_minuit();
    
    foreach ($resultats as $value)
    {
        if($value["id_partie"] == $_POST['id_partie'])
        {
            if($value["points_victoire_equipe_1"] > $value["points_victoire_equipe_2"])
            {
                $gagnant = 1;
            }
            else
            {
                $gagnant = 2;
            }
            
            $pts_victoire_totaux = get_points_victoire(get_team(get_current_user_id(), $_POST['id_partie']), $_POST['id_partie']);
            
            echo json_encode(
                array(pa => get_points_action(get_current_user_id(), $_POST['id_partie']),
                    score_equipe_1 => $value["score_equipe_1"] + $value["score_rapidite_equipe_1"],
                    score_equipe_2 => $value["score_equipe_2"] + $value["score_rapidite_equipe_2"],
                    equipe_gagnante => $gagnant,
                    points_victoire_equipe_1 => $value["points_victoire_equipe_1"],
                    points_victoire_equipe_2 => $value["points_victoire_equipe_2"],
                    pts_victoire_totaux => $pts_victoire_totaux
                ));
        }
    }
}

//prend en paramètre une position en #;#
//va voir voir dans la bdd
//retourne la liste des logins des joueurs sur la mêmes cellules, et des cellules aliées

function get_ids_from_cell($position, $id_partie) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        //requete SQL
        $bdd = $db->prepare('SELECT position , id_joueur FROM games_data WHERE id_partie = ? AND position = ? ');
        $bdd->execute(array($id_partie, $position));
        //le resultat objet en tableau
        $tmp = $bdd->fetchAll();
        //on créé 2 tableaux à partir du $tmp
        foreach ($tmp as $value) {
            $res[] = $value[1];
        }
        $resultat = get_logins_from_ids($res);

        foreach ($resultat as $value) {
            echo $value . "<br/>";
        }
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

//paramètre tableau d'id de joueurs
//utilise une fonction wp
//retourne tableau de login
function get_logins_from_ids($res) {
    foreach ($res as $value) {

        $user = get_user_by('id', $value);
        $tab_username[] = $user->user_login;
    }

    return $tab_username;
}

function login_redirection($redirect_to, $request, $user) {
    if ($user->roles != null) {

        if ($user->roles[0] != "administrator") {
            return "index.php/lobby";
        }
        return get_dashboard_url();
    }
}

add_filter('login_redirect', 'login_redirection', 10, 3);

//parametre : $id_partie
//sort des chiffres aleatoires pour les positions et les types
function create_random_event($id_partie) {
    //definie le nombre d'event par partie
    $nb_events = 20;

    for ($i = 1; $i < $nb_events; $i++) {

        $db = openBDD();
        do {
            $x = rand(0, 19);
            $y = rand(0, 19);

            //set la position X et Y
            $position = $x . ";" . $y;

            $bdd = $db->prepare('SELECT position FROM events WHERE id_partie = ? AND position = ?');
            $bdd->execute(array($id_partie, $position));

            $tmp = null;
            $tmp = $bdd->fetchAll();

            foreach ($tmp as $value) {
                $res[] = $value[0];
            }
        } while (isset($tmp[0]));

        //definie le % de chance
        $type = rand(0, 100);

        if ($type > 50) {
            $type = "-";
        } else {
            $type = "+";
        }

        $bdd = $db->prepare("INSERT INTO `events`( `id_partie`,`type`, `position`,  `valeur`) VALUES (?, ?, ?, 10)");
        $bdd->execute(array($id_partie, $type, $position));
    }
}
