 <?php

/*
 *
 * Plugin Name: Demo
 *
 */
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );
if ($_POST['reset_demo']) {
    reset_demo();
    wp_redirect(get_permalink(get_page_by_title('lobby')));
}

function create_demo_users()
{
    // Création de utilisateurs Wordpress
    $user_info = array(
        "user_pass" => "demo1",
        "user_login" => "Demo",
        "user_nicename" => "Demo",
        "user_email" => "demo@example.com",
        "display_name" => "Demo"
    );
    
    $insert_user_result = wp_insert_user($user_info);
    
    $user_info = array(
        "user_pass" => "demo2",
        "user_login" => "Demo2",
        "user_nicename" => "Demo2",
        "user_email" => "demo2@example.com",
        "display_name" => "Demo2"
    );
    
    $insert_user_result = wp_insert_user($user_info);
    
    $user_info = array(
        "user_pass" => "demo3",
        "user_login" => "Demo3",
        "user_nicename" => "Demo3",
        "user_email" => "demo3@example.com",
        "display_name" => "Demo3"
    );
    
    $insert_user_result = wp_insert_user($user_info);
    
    $user_info = array(
        "user_pass" => "demo4",
        "user_login" => "Demo4",
        "user_nicename" => "Demo4",
        "user_email" => "demo4@example.com",
        "display_name" => "Demo4"
    );
    
    $insert_user_result = wp_insert_user($user_info);
    
    global $wpdb;
    
    // Création de la partie démo (id=999999)
    $wpdb->insert('games_metadata', array(
        'id_partie' => 999999
    ), array(
        '%d'
    ));
    
    // Créations des joueurs dans la table games_data
    $wpdb->insert('games_data', array(
        'id_joueur' => get_user_by('login', 'Demo')->ID,
        'id_partie' => 999999,
        'position' => "0;0",
        'points_action' => 25,
        'equipe' => 1
    
    ), array(
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('games_data', array(
        'id_joueur' => get_user_by('login', 'Demo2')->ID,
        'id_partie' => 999999,
        'position' => "5;5",
        'points_action' => 25,
        'equipe' => 1
    
    ), array(
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('games_data', array(
        'id_joueur' => get_user_by('login', 'Demo3')->ID,
        'id_partie' => 999999,
        'position' => "15;15",
        'points_action' => 25,
        'equipe' => 2
    
    ), array(
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('games_data', array(
        'id_joueur' => get_user_by('login', 'Demo4')->ID,
        'id_partie' => 999999,
        'position' => "19;19",
        'points_action' => 25,
        'equipe' => 2
    
    ), array(
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
    ));
    
    // Créations des bâtiments dans la table batiments
    $wpdb->insert('batiments', array(
        'id' => 5,
        'id_partie' => 999999,
        'equipe' => 1,
        'xp' => 10,
        'niveau' => 1,
        'type' => 1
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 6,
        'id_partie' => 999999,
        'equipe' => 1,
        'xp' => 10,
        'niveau' => 1,
        'type' => 2
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 7,
        'id_partie' => 999999,
        'equipe' => 1,
        'xp' => 10,
        'niveau' => 1,
        'type' => 3
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 8,
        'id_partie' => 999999,
        'equipe' => 1,
        'xp' => 10,
        'niveau' => 1,
        'type' => 4
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 9,
        'id_partie' => 999999,
        'equipe' => 2,
        'xp' => 10,
        'niveau' => 1,
        'type' => 1
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 10,
        'id_partie' => 999999,
        'equipe' => 2,
        'xp' => 10,
        'niveau' => 1,
        'type' => 2
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 11,
        'id_partie' => 999999,
        'equipe' => 2,
        'xp' => 10,
        'niveau' => 1,
        'type' => 3
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('batiments', array(
        'id' => 12,
        'id_partie' => 999999,
        'equipe' => 2,
        'xp' => 10,
        'niveau' => 1,
        'type' => 4
    
    ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    // ajout des lignes de score
    $wpdb->insert('score', array(
        'id_partie' => 999999,
        'equipe' => 1,
        'score' => 0
        
    ), array(
        '%d',
        '%d',
        '%d'
    ));
    
    $wpdb->insert('score', array(
        'id_partie' => 999999,
        'equipe' => 2,
        'score' => 0
        
    ), array(
        '%d',
        '%d',
        '%d'
    ));
}

function delete_demo_users()
{
    // Suppression des utilisateurs wordpress
    wp_delete_user(get_user_by('login', 'Demo')->ID);
    wp_delete_user(get_user_by('login', 'Demo2')->ID);
    wp_delete_user(get_user_by('login', 'Demo3')->ID);
    wp_delete_user(get_user_by('login', 'Demo4')->ID);
    
    global $wpdb;
    
    // Suppression des joueurs dans games_data
    $wpdb->delete('games_data', array(
        'id_joueur' => get_user_by('login', 'Demo')->ID,
        'id_joueur' => get_user_by('login', 'Demo2')->ID,
        'id_joueur' => get_user_by('login', 'Demo3')->ID,
        'id_joueur' => get_user_by('login', 'Demo4')->ID
    ), array(
        '%d',
        '%d',
        '%d',
        '%d'
    ));
    
    // Suppression de la partie (id=999999) dans games_metadata
    $wpdb->delete('games_metadata', array(
        'id_partie' => 999999
    ), array(
        '%d'
    ));
}

register_activation_hook(__FILE__, 'create_demo_users');

register_deactivation_hook(__FILE__, 'delete_demo_users');

function reset_demo()
{
    global $wpdb;
    $wpdb->update('games_data', array(
        'position' => '0;0',
        'points_action' => 25
    ), array(
        'id_joueur' => get_user_by('login', 'Demo')->ID
    ));
    $wpdb->update('games_data', array(
        'position' => '5;5',
        'points_action' => 25
    ), array(
        'id_joueur' => get_user_by('login', 'Demo2')->ID
    ));
    $wpdb->update('games_data', array(
        'position' => '15;15',
        'points_action' => 25
    ), array(
        'id_joueur' => get_user_by('login', 'Demo3')->ID
    ));
    $wpdb->update('games_data', array(
        'position' => '19;19',
        'points_action' => 25
    ), array(
        'id_joueur' => get_user_by('login', 'Demo4')->ID
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 1,
        'type' => 1
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 1,
        'type' => 2
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 1,
        'type' => 3
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 1,
        'type' => 4
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 2,
        'type' => 1
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 2,
        'type' => 2
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 2,
        'type' => 3
    ));
    $wpdb->update('batiments', array(
        'xp' => 10,
        'niveau' => 1
    ), array(
        'id_partie' => 999999,
        'equipe' => 2,
        'type' => 4
    ));
    $wpdb->delete('chat', array(
        'id_partie' => 999999
    ), array(
        '%d'
    ));
    
    $wpdb->update('score', array(
        'score' => 0
    ), array(
        'id_partie' => 999999,
        'equipe' => 1
    ));
    
    $wpdb->update('score', array(
        'score' => 0
    ), array(
        'id_partie' => 999999,
        'equipe' => 2
    ));
    
    $wpdb->delete('coffre_ville', array(
        'id_partie' => 999999
    ), array(
        '%d'
    ));
}

