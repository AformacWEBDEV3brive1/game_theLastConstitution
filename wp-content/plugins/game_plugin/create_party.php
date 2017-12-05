<?php

/*
 *
 * Plugin Name: Creation de parties ..............
 *
 */
include_once 'process_general.php';

$slice = 6;

function create_slices() {
    global $slice;
    global $wpdb;

    $results = $wpdb->get_results("SELECT id_joueur FROM `lobby`", ARRAY_A);

    print_r($results);
    
    $count = count($results);

    if ($count < $slice) {
        echo "exit";
        exit;
    }

    $sliced = array();
    $i = 0;
    foreach ($results as $key => $result) {
        $sliced[$i][] = $result;

        if (($key + 1) % $slice == 0)
            $i++;
    }
    print_r("coucou");
    print_r($sliced);
create_party($sliced[0]); 

}

function create_party($sliced) {

    global $wpdb;

    $wpdb->insert('games_metadata', array(
        'id_partie' => 'NULL',
        'start' => current_time('mysql')
            )
            , array(
        '%s',
        '%s'
    ));

    $party_last = $wpdb->get_results("SELECT * FROM games_metadata ORDER BY id_partie DESC LIMIT 1");

    $party = $party_last[0]->id_partie;
    
    print_r($sliced);
    
    foreach ($sliced as $player) {


        $x = rand(0, 19);
        $y = rand(0, 19);

        //set la position X et Y
        $position = $x . ";" . $y;
        
        $pts_action = 25;
        
        echo " les resultats sont  en position ".$position." en pts action ".$pts_action." en joueur : ".$player;
    }

//    creerunepartiedanslatablepartie;
//    choisiruneposition;
//    
//    setlesptsactions;
}

 create_slices();















