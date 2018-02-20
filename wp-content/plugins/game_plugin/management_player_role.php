<?php

/*
 
  Plugin Name: Joueur
  Description: ajout du rôle "Joueur" en activant le plugin et suppréssion du rôle "Joueur" en désactivant le plugin
  
 */

// Creation of "Joueur" role.
function Joueur_roles_add() 
{
    // get contributor role.
    $role = get_role('contributor');
    // on ajoute la capacité upload_files à contributor
    $role->add_cap('upload_files');
 
    // Add the "Joueur" role.
    add_role(
            'Joueur', 'Joueur', array(
            'read' => true, // peut accéder à son profil donc à l'administration
            'switch_player' => true // peut changer le Joueur
            )
    );
    
    // To delete a role : use remove_role('identifiant').
    // remove_role('Joueur');
}
 
register_activation_hook(__FILE__, 'Joueur_roles_add');
 
// Deletion of "Joueur" rôle. 
function Joueur_roles_remove() 
{
    // Get contributor role
    $role = get_role('contributor');
    // Contributor cant upload files anymore with that function.
    $role->remove_cap('upload_files');
 
   
    // To delete a role : use remove_role('identifiant').
    remove_role('Joueur');
}
 
register_deactivation_hook( __FILE__, 'Joueur_roles_remove' );

// function who allowed to subscribe only with "joueur" role.
add_filter('pre_option_default_role', 

function($default_role){
    return 'Joueur'; 
});