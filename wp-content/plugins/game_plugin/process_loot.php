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

function loot_get_coffre_ville($id_equipe, $id_partie) {

    global $wpdb;

    try {
        $query = $wpdb->prepare("SELECT nom_objet, valeur_objet, quantite_objet, type_objet, class_objet FROM coffre_ville AS c, objet AS o, type_objet AS t, class_objet AS co WHERE co.id_class = o.id_class AND c.id_objet=o.id_objet AND o.id_type_objet = t.id_type_objet AND id_equipe='%d' AND id_partie='%d'", '1', '1');
        $tmp = ($wpdb->get_results($query));
        echo json_encode($tmp);
        
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

