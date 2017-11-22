<?php

/*
 * Plugin Name: Chat
 */
include_once 'process_general.php';

if ($_POST["called_ajax_php"] == "game_chat.php") {
    if (isset($_POST['php_function_file'])) {
        if ($_POST["php_function_file"] == 'refresh_chat' || $_POST["php_function_file"] == 'send_message') {
            if (isset($_POST['id_partie'])) {
                $id_partie = $_POST['id_partie'];
            }
            if (isset($_POST['tag'])) {
                $tag = $_POST['tag'];
            }
            if (isset($_POST['message'])) {
                $message = $_POST['message'];
            }
            $info_chat = $_POST['php_function_file'];
            $info_chat();
        }
    }
}

// Prend en entrée l'ID d'un joueur, l'ID de la partie et le tag du chat (ville/case).
// retourne les messages dans un tableau (tous si c'est la ville, tois si c'est la case).
/*function load_chat()
{
    try {
        
        global $wpdb;
        $id_joueur = get_current_user_id();
        global $id_partie;
        global $tag;
        $equipe = get_team($id_joueur, $id_partie);
        
        if ($tag == "ville" && player_in_his_city($id_partie, $equipe)) {
            // if player_in_his_city == true
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s", $id_partie, $equipe, $tag));
        } else if ($tag == "case") {
            $position = get_position(false, $id_partie);
            
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND position = %s", $id_partie, $equipe, $tag, $position));
            
            //$resultats = array_slice($resultats, 0, 3);
        }

        foreach ($resultats as $value) {
            $value->id_joueur = get_login_by_id($value->id_joueur);
        }
        
        echo json_encode($resultats);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}*/

function load_chat_by_tag($tag, $id_partie)
{
    try {
        
        global $wpdb;
        $id_joueur = get_current_user_id();
        $equipe = get_team($id_joueur, $id_partie);
        
        if ($tag == "ville" && player_in_his_city($id_partie, $equipe)) 
        {
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s", $id_partie, $equipe, $tag));
        } 
        else if ($tag == "case") 
        {
            $position = get_position(false, $id_partie);
            
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND position = %s", $id_partie, $equipe, $tag, $position));
        }
        
        return $resultats;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function refresh_chat()
{
    try {
        
        global $wpdb;
        $id_joueur = get_current_user_id();
        global $id_partie;
        global $time;
        date_default_timezone_set("Europe/Paris");
        //error_log(date('Y-m-d H:i:s', time() - 5));
        
        $equipe = get_team($id_joueur, $id_partie);
        
        if (player_in_his_city($id_partie, $equipe)) {
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure, tag FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND heure >= %s", $id_partie, $equipe, "ville", date('Y-m-d H:i:s', time() - 5) ));
        } 
        else
        {
            $position = get_position(false, $id_partie);
            
            $resultats = $wpdb->get_results($wpdb->prepare("SELECT id_joueur, message, heure, tag FROM chat WHERE id_partie = %d AND equipe = %d AND tag = %s AND position = %s AND heure >= %s", $id_partie, $equipe, "case", $position, date('Y-m-d H:i:s', time() - 5) ));
        }
        
        foreach ($resultats as $value) {
            //$value->id_joueur = get_login_by_id($value->id_joueur);
            $user = get_user_by('id', $value->id_joueur); 
            $value->id_joueur = $user->login;
        }
        //error_log("RESULTATS: " . $resultats);
        echo json_encode($resultats);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function player_in_his_city($id_partie, $equipe)
{
    $position = get_position(false, $id_partie);
    if (($position == "0;0" && $equipe == 1) || ($position == "19;19" && $equipe == 2)) {
        return true;
    }
    return false;
}

function send_message()
{
    try {
        global $wpdb;
        global $id_partie;
        global $tag;
        global $message;
        $id_joueur = get_current_user_id();
        $equipe = get_team($id_joueur, $id_partie);
        $position = get_position(false, $id_partie);
        
        error_log($id_joueur);
        error_log($id_partie);
        error_log($message);
        error_log($equipe);
        
        $check = check_message($id_joueur, $id_partie, $message, $equipe, $tag);
        if ($check == "OK") {
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
            echo "Message envoyé";
        } else {
            echo $check;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function check_message($id_joueur, $id_partie, $message, $equipe, $tag)
{
    try {
        if (strlen($message) < 100) {
            error_log($tag);
            error_log(player_in_his_city($id_partie, $equipe));
            if ($tag == "ville" && ! player_in_his_city($id_partie, $equipe)) {
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