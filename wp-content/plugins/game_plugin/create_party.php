<?php

include_once 'process_general.php';

$slice = 4;

function create_slices() {
    global $slice;
    global $wpdb;

    $results = $wpdb->get_results("SELECT id_joueur FROM `lobby`", ARRAY_A);

    
    $count = count($results);

    if ($count < $slice) {
        echo "exit";
        exit;
    }

    $sliced = array();
    $i = 0;
    foreach ($results as $key => $result) {
        $sliced[$i][] = $result;
        
        if (($key + 1)  % $slice == 0 )
        $i++;
         
    }
   
    foreach($sliced as $partie){
        
        
        
        if(count($partie)!=$slice){
            echo $partie.' est different ';
            continue;
        }else{
            create_party($partie);
        }
        
    }
    
}

function create_party($partie) {

    global $slice;
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
    
   
     $k=0;
    foreach ($partie as $player) {
        
       
        //set la position X et Y
        
        $equipe1=array_slice($partie,0,$slice/2);
        
        print_r($equipe1);
        
        if(null!== in_array($player["id_joueur"],$equipe1[$k])){
            $position = "0;0";
            $equipe="1";
        }else{
            $position = "19;19";
            $equipe="2";
        }
       
        $pts_action = 25;
        
        
        echo " les resultats sont  en position ".$position." en pts action ".$pts_action." l'id joueur : ".$player["id_joueur"]." dans l'equipe ".$equipe."\n";
        
        $wpdb->insert(
    'games_data',
    array(
        'id_joueur' => $player['id_joueur'],
        'id_partie' => $party,
        'position' => $position,
        'points_action' => $pts_action,
        'equipe'=>$equipe
    ),
    array(
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
    )
);
        $wpdb->delete(
    'lobby',
    array(
        'id_joueur' => $player['id_joueur']
        
    ),
    array(
        '%d'
    )
);
        
        $k++;
    }



  

}

 create_slices();















