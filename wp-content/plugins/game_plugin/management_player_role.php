<?php

/*
 
  Plugin Name: Joueur
  Description: ajout du rôle "Joueur" en activant le plugin et suppréssion du rôle "Joueur" en désactivant le plugin
  
 */

// création du rôle "Joueur"
function Joueur_roles_add() 
{
    // on récupère le rôle contributor
    $role = get_role('contributor');
    // on ajoute la capacité upload_files à contributor
    $role->add_cap('upload_files');
 
    // On ajoute le rôle Joueur
    add_role(
            'Joueur', 'Joueur', array(
            'read' => true, // peut accéder à son profil donc à l'administration
            'switch_player' => true // peut changer le Joueur
            )
    );
    
    // pour supprimer un role on utilise remove_role('identifiant')
    // remove_role('Joueur');
}
 
register_activation_hook(__FILE__, 'Joueur_roles_add');
 
// suppréssion du rôle "Joueur"
function Joueur_roles_remove() 
{
    // on récupère le rôle contributor
    $role = get_role('contributor');
    // on supprime la capacité upload_files à contributor
    $role->remove_cap('upload_files');
 
   
    // pour supprimer un role on utilise remove_role('identifiant')
    remove_role('Joueur');
}
 
register_deactivation_hook( __FILE__, 'Joueur_roles_remove' );

// fonction qui permet de s'inscrire uniquement en tant que joueur
add_filter('pre_option_default_role', 

function($default_role){
    return 'Joueur'; 
});