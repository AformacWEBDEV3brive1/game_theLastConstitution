<?php

/*
  Plugin Name: Process_loot
 */

//include_once 'parameters/parameters.php';
// intégration function wordpress.
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

//$wpdb->show_errors();

function loot_cell($id_equipe, $id_partie) {
    
}
// renvoie aléatoirement un type 
function loot_get_random_type() {

    global $wpdb;

    try {
        $query = $wpdb->prepare("SELECT * FROM type_objet ORDER BY RAND() LIMIT 1");
        return $wpdb->get_row($query)->type_objet;
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


loot_get_coffre_ville(1);
