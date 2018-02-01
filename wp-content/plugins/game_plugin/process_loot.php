<?php

/*
  Plugin Name: Process_loot
 */


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


        return $temp->id_type[0];
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_get_random_class($type, $luck) {

    global $wpdb;

    try {



        $query = $wpdb->prepare("SELECT id_class, proba, class_objet FROM class_objet WHERE id_type='%d' ORDER BY proba DESC", $type);
        $result = $wpdb->get_results($query);
        $i = 0;

        while ($luck <= $result[$i]->proba) {
            $i++;
        }


        $query_obj = $wpdb->prepare("SELECT nom_objet, id_objet FROM objet WHERE id_type='%d' AND id_class='%d'", $type, $result[$i]->id_class);
        $result_obj = $wpdb->get_results($query_obj);
        echo "vous trouvez objet de classe " . $result_obj[0]->nom_objet . $result[$i]->class_objet; //AJOUTER TYPE ET REFAIRE MESSAGE
        return $result_obj[0]->id_objet;
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function loot_insert_coffre_ville($butin, $id_equipe, $id_partie) {
    global $wpdb;

    try {

        $query_coffre = $wpdb->prepare("SELECT id_objet, quantite_objet FROM coffre_ville WHERE id_equipe='%d' AND id_partie='%d' AND id_objet='%d'", $id_equipe, $id_partie, $butin);
        $result_coffre = $wpdb->get_results($query_coffre);
        //Test si objet existe dans la table
        if ($result_coffre == null) {



            //Insert l'objet si n'existe PAS dans la table
            $query = $wpdb->insert(
                    'coffre_ville', //table name
                    array(
                'id_equipe' => $id_equipe,
                'id_partie' => $id_partie,
                'id_objet' => $butin,
                'quantite_objet' => 1,
                    ), //columns
                    array(
                '%d',
                '%d',
                '%d',
                '%d',
                    )
            );
            //Update la table si objet existe dans la table
        } else {



            $wpdb->query($wpdb->prepare("UPDATE `coffre_ville` SET `quantite_objet`='%d' WHERE id_equipe='%d' AND id_partie='%d' AND id_objet='%d'", $result_coffre[0]->quantite_objet + 1, $id_equipe, $id_partie, $butin));
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function loot_get_coffre_ville($id_equipe, $id_partie) {

    global $wpdb;
    error_log("SELECT nom_objet, valeur_objet, quantite_objet, type_objet, class_objet FROM coffre_ville AS c, objet AS o, type_objet AS t, class_objet AS co WHERE co.id_class = o.id_class AND c.id_objet=o.id_objet AND o.id_type = t.id_type AND id_equipe=$id_equipe AND id_partie=$id_partie");
    try {
        $query = $wpdb->prepare("SELECT nom_objet, valeur_objet, quantite_objet, type_objet, class_objet FROM coffre_ville AS c, objet AS o, type_objet AS t, class_objet AS co WHERE co.id_class = o.id_class AND c.id_objet=o.id_objet AND o.id_type = t.id_type AND id_equipe='%d' AND id_partie='%d'",$id_equipe,$id_partie);
        $tmp = ($wpdb->get_results($query));
        echo json_encode($tmp);
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

function looted($id_partie) {


    global $wpdb;

    try {

        if (check_looted_current_player($id_partie) == false) {
            
            if(get_points_action(get_current_user_id(), $id_partie) >= 1)
            {
            
            $query = $wpdb->insert(
                    'looted', //table name
                    array(
                'id_partie' => $id_partie,
                'position' => get_position_by_id($id_partie, get_current_user_id()),
                    ), //columns
                    array(
                '%d',
                '%s',
                    )
            );
            $luck = rand(0, 100);

            if ($luck <= 50) {

                echo "rien à recuperer!!!! Degage!!";
            } else {
//              
                $butin = loot_get_random_class(loot_get_random_type(), $luck);



                loot_insert_coffre_ville($butin, get_team(get_current_user_id(), $id_partie), $id_partie);
            }
            

            nouveau_montant_pa(get_current_user_id(), get_points_action(get_current_user_id(), $id_partie) - 1, $id_partie);
            }
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

//Test si la case est deja looté ou pas
function check_looted_current_player($id_partie) {

    global $wpdb;
    try {
        $resultats = $wpdb->get_results(
                $wpdb->prepare(
                        "SELECT * FROM looted WHERE position = %s AND id_partie = %d", get_position_by_id($id_partie, get_current_user_id()), $id_partie
                )
        );

        return count($resultats);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
