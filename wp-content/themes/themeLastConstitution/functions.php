<?php
/**
 * themeLastConstitution functions and definitions
 *
 *
 */

// créer les pages après l'activation du thème
function create_pages()
{
    // la page du lobby avec les informations du user et ses parties
    $page_lobby = array(
        'post_title' => 'lobby',
        'post_content' => '',
        'post_type' => 'page',
        'post_status'   => 'publish',
        'page_template' => 'lobby.php'
    );
    
    wp_insert_post($page_lobby);
    
    // la page du jeu avec la grille, l'inventaire, ...
    $page_jeu = array(
        'post_title' => 'jeu',
        'post_content' => '',
        'post_type' => 'page',
        'post_status'   => 'publish',
        'page_template' => 'game.php'
    );
    
    wp_insert_post($page_jeu);
    
    // la page de fin de partie
    $page_jeu = array(
        'post_title' => 'fin-de-partie',
        'post_content' => '',
        'post_type' => 'page',
        'post_status'   => 'publish',
        'page_template' => 'fin_de_partie.php'
    );
    
    wp_insert_post($page_jeu);
}
add_action( "after_switch_theme", "create_pages" );

// supprimer les pages après la désactivation du thème
function delete_pages()
{
    wp_delete_post( get_page_by_title( 'jeu' )->ID ); 
    wp_delete_post( get_page_by_title( 'lobby' )->ID );   
    wp_delete_post( get_page_by_title( 'fin-de-partie' )->ID ); 
}
add_action( "switch_theme", "delete_pages" );

