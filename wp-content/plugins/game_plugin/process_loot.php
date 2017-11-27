<?php

/*
  Plugin Name: Process_loot
 */

//include_once 'parameters/parameters.php';
// intégration function wordpress.
include_once 'process_general.php';
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );



//$wpdb->show_errors();
//print_r($wpdb->show_errors());

function loot_cell($id_equipe, $id_partie) {
    
}

// renvoie aléatoirement un type 
function loot_get_random_type() {

    global $wpdb;

    try {
        // $query = $wpdb->query("SELECT id_type FROM type_objet ORDER BY RAND() LIMIT 1");
        $temp = $wpdb->get_row("SELECT id_type FROM type_objet ORDER BY RAND() LIMIT 1");
        foreach ($temp as $value) {
            $type[] = $value[0];
        }
        // print_r($type);
        echo "type " . $type[0];
        return $type;
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_get_random_class($type) {

    global $wpdb;

    try {
        $luck = rand(0, 100);

        echo " random = " . $luck . " ";
        $query = $wpdb->prepare("SELECT id_class, proba, class_objet FROM class_objet WHERE id_type='%d' ORDER BY proba DESC", $type);

        $result = $wpdb->get_results($query);
        $i = 0;
        while (true) {
            if ($luck <= 50) {
                echo "rien à recuperer!!!! Degage!!";
                return;
            } else if ($luck >= $result[$i]->proba) {

                break;
            }

            $i++;
        }
        echo "vous trouvez objet de classe " . $result[$i]->class_objet;

//        return $wpdb->get_results($query);
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_insert_coffre_ville($butin, $id_equipe, $id_partie) {
    global $wpdb;

    try {
        //check si ça marche mon frere
        $query = $wpdb->insert(
                'coffre_ville', //table name
                array(
            'id_equipe' => 1,
            'id_partie' => 1,
            'id_objet' => 2,
            'quantite_objet' => 1,
                ), //columns
                array(
            '%d',
            '%d',
            '%d',
            '%d',
                )
        ); //explicit formating
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

//function loot_get_coffre_ville($id_equipe) {
//
//    global $wpdb;
//
//    try {
//        $query = $wpdb->prepare("SELECT nom_objet, valeur_objet, quantite_objet FROM coffre_ville AS c, objet AS o WHERE c.id_objet=o.id_objet AND id_equipe='%d' AND id_partie='%d'", '1', '1');
//        print_r($wpdb->get_results($query));
//    } catch (Exception $ex) {
//        return $e->getMessage();
//    }
//}


function looted($id_partie) {
//    echo "blavlzlflasfalf " .get_position_by_id($id_partie, get_current_user_id()). " qdsfsdgsdgsdgsd";
 
//loot_get_coffre_ville(1);

    global $wpdb;
    try {
        //check si ça marche mon frere
        $query = $wpdb->insert(
                'looted', //table name
                array(
            'id_partie'=> $id_partie,
            'position' => get_position_by_id($id_partie, get_current_user_id()),
                ), //columns
                array(
            '%d',
            '%s',
            
                )
        ); //explicit formating
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function check_looted($id_partie) {

    global $wpdb;
    try {
        $resultats = $wpdb->get_results(
                $wpdb->prepare(
                        "SELECT * FROM looted WHERE position = %s AND id_partie = %d", get_position_by_id($id_partie, get_current_user_id()), $id_partie
                )
        );
       echo"blabalbalgzsf " . count($resultats);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
//check_looted(1);
//looted(1,2);
//$plop = loot_get_random_type();
//loot_get_random_class($plop);
