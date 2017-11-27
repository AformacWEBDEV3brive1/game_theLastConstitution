<?php

/*
  Plugin Name: Process_loot
 */

//include_once 'parameters/parameters.php';
// intégration function wordpress.
include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );



//$wpdb->show_errors();

function loot_cell($id_equipe, $id_partie) {
    
}


//renvoie un tableau json des ressources
function loot_get_loot_from_coffre_ville($id_equipe, $id_partie) {

    global $wpdb;

    try {
        $query = $wpdb->prepare("SELECT quantite_objet, nom_objet, objet.id_type, class_objet, valeur_objet 
                                FROM coffre_ville, objet, class_objet 
                                WHERE coffre_ville.id_objet=objet.id_objet 
                                AND objet.id_objet=class_objet.id_class
                                AND id_partie='%d' AND id_equipe='%d'",$id_partie,$id_equipe);
        
       $tab_ressources=json_encode($wpdb->get_results($query));
       echo $tab_ressources;
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

// renvoie aléatoirement un type 
function loot_get_random_type() {

    global $wpdb;

    try {
        $query = $wpdb->prepare("SELECT * FROM type_objet ORDER BY RAND() LIMIT 1");
        return $wpdb->get_row($query);
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_get_random_class() {

    global $wpdb;

    try {
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_insert_coffre_ville($butin, $id_equipe, $id_partie) {
    global $wpdb;

    try {
        //check si ça marche mon frere
        $query = $wpdb->insert(
                'coffre_ville',//table name
            
               array(
                    'id_equipe'=>1,
                    'id_partie'=>1,
                    'id_objet'=>2,
                    'quantite_objet'=>1,
                    ),//columns
                    
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                        )
                );//explicit formating
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_get_coffre_ville($id_equipe) {

    global $wpdb;

    try {
        $query = $wpdb->prepare("SELECT nom_objet, valeur_objet, quantite_objet FROM coffre_ville AS c, objet AS o WHERE c.id_objet=o.id_objet AND id_equipe='%d' AND id_partie='%d'",'1','1');
         print_r($wpdb->get_results($query));
         
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

