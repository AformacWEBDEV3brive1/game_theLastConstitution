<?php

/*
 * Plugin Name: Chat
 */
include_once 'process_general.php';

if ($_POST["called_ajax_php"] == "game_chat.php") {
    if (isset($_POST['php_function_file'])) {
        if ($_POST["php_function_file"] == 'refresh_chat') {
            refresh_chat($_POST['id_partie']);
        }
        if ($_POST["php_function_file"] == 'send_message'){
            send_message($_POST['id_partie'], $_POST['tag'], $_POST['message']);
        }
    }
}

// Prend en entrée l'ID d'un joueur, l'ID de la partie et le tag du chat (ville/case).
// retourne les messages dans un tableau (tous si c'est la ville, tois si c'est la case).

function load_chat_by_tag($tag, $id_partie) {
    try {

        global $wpdb;
        $id_joueur = get_current_user_id();
        $equipe = get_team($id_joueur, $id_partie);

        if ($tag == "ville" && player_in_his_city($id_partie, $equipe)) {
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s", $id_partie, $equipe, $tag));
        } else if ($tag == "case") {
            $position = get_position(false, $id_partie);

            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND position = %s", $id_partie, $equipe, $tag, $position));
        }

        return $resultats;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function refresh_chat($id_partie) {
    try {

        global $wpdb;
        $id_joueur = get_current_user_id();
        date_default_timezone_set("Europe/Paris");

        $equipe = get_team($id_joueur, $id_partie);

        if (player_in_his_city($id_partie, $equipe)) {
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure, tag FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND heure >= %s", $id_partie, $equipe, "ville", date('Y-m-d H:i:s', time() - 5)));
        } else {
            $position = get_position(false, $id_partie);

            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure, tag FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND position = %s AND heure >= %s", $id_partie, $equipe, "case", $position, date('Y-m-d H:i:s', time() - 5)));
        }

        foreach ($resultats as $value) {
            $user = get_user_by('id', $value->id_joueur);
            $value->id_joueur = $user->login;
        }
        echo json_encode($resultats);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function player_in_his_city($id_partie, $equipe, $all = false) {
    
    if($all == "true"){
        global $wpdb;
         //error_log($wpdb->prepare("SELECT `position` FROM `games_data` WHERE id_partie = '%d' AND equipe = '%d' ", $id_partie, $equipe));
//        $positions = get_position("myteam", $id_partie);
            $team_position_joueur = $wpdb->get_results($wpdb->prepare("SELECT `position` FROM `games_data` WHERE id_partie = '%d' AND equipe = '%d' ", $id_partie, $equipe));
           
//      $team_position_joueur = $wpdb->get_results($query_team_position_joueur);
//        error_log($positions);
      $i = 0;
      error_log(serialize($team_position_joueur));
      foreach ($team_position_joueur as $value[$i]){
          error_log("aaaaaaaaaaaaaaa" . $i);
//          error_log("cccccccccccccccccccccccccccc" . $value[$i]);
          if (($value == "0;0" && $equipe == 1) || ($value == "19;19" && $equipe == 2)){
             $i++;  
             error_log("bbbbbbbbbbbbbbbbb" . $i);
          }
         
      }
//      echo $i;
        // compter nombre personne dans 0,0 ou 16,16
    }elseif($all == false){
        $position = get_position(false, $id_partie);
        if (($position == "0;0" && $equipe == 1) || ($position == "19;19" && $equipe == 2)) {
            return true;
        }
        return false;
    }
}

function send_message($id_partie, $tag, $message) {
    try {
        global $wpdb;
        
        $id_joueur = get_current_user_id();
        $name_joueur = get_userdata($id_joueur);
        $equipe = get_team($id_joueur, $id_partie);
        $position = get_position(false, $id_partie);

        $check = check_message($id_joueur, $id_partie, $message, $equipe, $tag);
        if ($check == "OK") {

            if(substr($message, 0,3) == '/me') {
                    $wpdb->insert('chat', array(
                    'id_joueur' => $id_joueur,
                    'position' => $position,
                    'equipe' => $equipe,
                    'id_partie' => $id_partie,
                    'tag' => $tag,
                    'message' => $name_joueur->user_login . " vous salue",
                    'heure' => date('Y-m-d H:i:s', time())
                        ), array(
                    '%d',
                    '%s',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s'
                ));
            } else {
                $wpdb->insert('chat', array(
                    'id_joueur' => $id_joueur,
                    'position' => $position,
                    'equipe' => $equipe,
                    'id_partie' => $id_partie,
                    'tag' => $tag,
                    'message' => $message,
                    'heure' => date('Y-m-d H:i:s', time())
                        ), array(
                    '%d',
                    '%s',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s'
                ));
            }
            echo "Message envoyé";
        } else {
            echo $check;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function check_message($id_joueur, $id_partie, $message, $equipe, $tag) {
    try {
        if (strlen($message) < 100) {
            if ($tag == "ville" && !player_in_his_city($id_partie, $equipe)) {
                return "Vous devez être en ville pour écrire dans le chat Ville";
            } else {
                global $wpdb;
                $res = $wpdb->get_results($wpdb->prepare("SELECT heure FROM chat WHERE id_joueur = %d AND id_partie = %d", $id_joueur, $id_partie));

                date_default_timezone_set("Europe/Paris");
                $date = strtotime(date("Y-m-d H:i:s"));

                $longueur = count($res);
                $datemsg1 = strtotime($res[$longueur - 1]->heure);
                $datemsg2 = strtotime($res[$longueur - 2]->heure);
                $datemsg3 = strtotime($res[$longueur - 3]->heure);
                $calcul1 = $date - $datemsg1;
                $calcul2 = $date - $datemsg2;
                $calcul3 = $date - $datemsg3;

                if ($calcul1 <= 60 && $calcul2 <= 60 && $calcul3 <= 60) {
                    return "stop le flood!!";
                } else {
                    return "OK";
                }
            }
        } else {
            return 'désolé votre message contient trop de caratères';
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
//player_in_his_city(1, 1, $all = true);
