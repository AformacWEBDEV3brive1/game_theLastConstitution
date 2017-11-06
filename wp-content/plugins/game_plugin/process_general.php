
<?php

/*
  Plugin Name: Process_general
 */

include_once 'parameters/parameters.php';
 include_once 'process_event.php';
// débeugeur de Wordpress.
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );


if(isset($_POST['position']) && isset($_POST['info'])){
        $info = $_POST['info'];
        $position = $_POST['position'];
        $info($position);
    }


else if (isset($_POST['info'])) {
    $info = $_POST['info'];
    $info();
    
}


//Prend en entrée l'ID d'un joueur.
// retourne le nombre de points d'action d'un joueur ou une exception.
function get_points_action($id_joueur) {
    error_log(__FUNCTION__);

    try {
        //error_log("debut try get_points_action");
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT points_action FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        //error_log("fin try get_points_action");
        return $result["points_action"];
    } catch (PDOException $e) {
        //error_log("exeption get_points_action");
        return $e->getMessage();
    }
}

// Paramètre d'entrée est un boolean par défault a "false". Remplacer "false" par "true" pour avoir tous les joueurs.
// Retoune la position SOIT d'un joueur SOIT de tous les joueurs (sous forme de tableau) ou une exception.
// l'id du joueur sera le joueur connecté (get_current_user_id()).
function get_position($all = false) {
    if ($all == false) {
        $id_joueur = get_current_user_id();
        //error_log("id joueur : " . $id_joueur);

        try {
            $db = openBDD(); //fonction pour ouvrir acces BDD

            $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ?');
            $bdd->execute(array($id_joueur));

            $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
            //error_log('fin traitement bdd');
            //   echo $id_joueur;
            return $result["position"];
        } catch (PDOException $e) {
            //error_log('exception bdd');
            return $e->getMessage();
        }
    } else {
        try {
            $db = openBDD(); //fonction pour ouvrir acces BDD
            $current_id_user=get_current_user_id();
            $id_partie= get_game($current_id_user);
            $equipe= get_team($current_id_user);
            $id_mate= get_id_mate($id_partie, $equipe);
            
           // $id_partie = get_id_mate(get_game(get_team(get_current_user_id())));
            $bdd = $db->prepare('SELECT id_joueur, position FROM games_data WHERE id_partie = ?');
            $bdd->execute(array($id_partie));

            $result = $bdd->fetchALL(); //fetchALL retourne toute les valeurs sous forme de tableau.
            //print_r($result);

            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

// Paramètres d'entrée: id_joueur et nouvelle_position (sous la forme x;y)
// Met a jour la position d'un joueur dans la base.
// Retourne eventuellement une exception si problème.
function set_position($id_joueur, $nouvelle_position) {
    //error_log("set position begin", 0);
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET position = ? WHERE id_joueur = ?');
        $bdd->execute(array($nouvelle_position, $id_joueur));
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

        $bdd = $db->prepare('DELETE FROM games_metadata WHERE id = ?');
        $bdd->execute(array($id_partie));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// Si une nouvelle position est envoyée, alors appelle la fonction check_move, si celle-ci retourne "true"
//alors appelle set_postion.
// l'id du joueur sera le joueur connecté (get_current_user_id()).

function move() {
    //error_log("Je passe ici !!!", 0);
    if (isset($_POST['new_position'])) {
        $id_joueur = get_current_user_id();
        $new_position = $_POST['new_position'];
       // error_log("joueur : " . $id_joueur, 0);
       // error_log("next position : " . $new_position, 0);
        if (check_move($id_joueur, $new_position)) {
            set_position($id_joueur, $new_position);
            event_check_position(1);
           //return true;
           // echo "true";
          //  error_log("move ok", 0);
        } else {
           // return false;
            echo "false";
          //  error_log("move pas ok", 0);
        }
    }
}

// Paramètres d'entrée: id_joueur et nouvelle_position (sous la forme x;y)
// Vérifie si assez de points d'action sont disponible pour se déplacer grace a la fonction get_points_action
// Si c'est le cas elle appelle nouveau_montant_pa et retoune "TRUE".
//Sinon retoune "FALSE"
function check_move($id_joueur, $new_position) {
    $new_pos = explode(";", $new_position);
    $new_pos_x = $new_pos[0];
    $new_pos_y = $new_pos[1];

    $old_pos = explode(";", get_position());
    $old_pos_x = $old_pos[0];
    $old_pos_y = $old_pos[1];

    //error_log('pts_besoin: ' . abs($new_pos_x - $old_pos_x) . '+' . abs($new_pos_y - $old_pos_y) . '  pts_action: ' . get_points_action($id_joueur) . '   ');

    $pa_joueur = get_points_action($id_joueur);
    $pa_necessaire = abs($new_pos_x - $old_pos_x) + abs($new_pos_y - $old_pos_y);
    if ($pa_necessaire <= $pa_joueur) {
        nouveau_montant_pa($id_joueur, $pa_joueur - $pa_necessaire);
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
function get_team($id_joueur) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT equipe FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        return $result[0];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_game($id_joueur){
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('SELECT id_partie FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));

        $result = $bdd->fetch(); // retourne sous forme d'un tableau la PREMIERE valeur.
        return $result[0];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//Paramètre d'entrée est l'id du joueur et son nouveau montants de P.A
// Met a jour le montant des P.A d'un joueur.
// Retourne eventuellement une exception si problème.
function nouveau_montant_pa($id_joueur, $points_action) {
    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD

        $bdd = $db->prepare('UPDATE games_data SET points_action = ? WHERE id_joueur = ?');
        $bdd->execute(array($points_action, $id_joueur));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


//Fonction pour simuler le tour suivant. [ADMIN]
function tour_suivant() {
    reset_all_points_action();
}




function get_ids_from_cell($position) {

    try {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        //requete SQL
        $bdd = $db->prepare('SELECT position , id_joueur FROM games_data WHERE id_partie = 1 AND position = ? ');
        $bdd->execute(array($position));
        //le resultat objet en tableau
        $tmp = $bdd->fetchAll();
        //on créé 2 tableaux à partir du $tmp
        foreach ($tmp as $value) {
            $res[] = $value[1];
            
        }
        
       
        
        $resultat = get_logins_from_ids($res);
       
        
        foreach ($resultat as $value){
            echo $value."<br/>";
        }
        
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function get_logins_from_ids($res) {
    foreach ($res as $value) {
        
        $user = get_user_by('id', $value);
        $tab_username[] = $user->user_login;
    }
   
    return $tab_username;
    
}

function login_redirection($redirect_to, $request, $user)
{
    if($user->roles[0] != "administrator")
    {
        return "index.php/jeu";
    }
    return get_dashboard_url();
}

add_filter('login_redirect', 'login_redirection', 10, 3);

