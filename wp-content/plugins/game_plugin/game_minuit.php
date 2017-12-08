 <?php
 
 /*
  * Plugin Name: Minuit
  */
 
require_once( explode("wp-content", __FILE__)[0] . "wp-load.php" );

// La fonction qui va appeller toutes les autres
function global_minuit()
{ 
    try
    {
        $parties = get_all_id_games();
         
        $resultats = array();
        foreach ($parties as $value) 
        {
            
            // les joueurs ont 100 de score de combat de base
            $score_equipe_1 = 100;
            $score_equipe_2 = 100;
            
            // récupérer l'id de la partie
            $id_partie = $value->id_partie;
            
            // récupérer le nombre de joueurs en ville pour chaque équipe
            $joueurs_equipe_1 = get_players_in_city($id_partie, 1);
            $joueurs_equipe_2 = get_players_in_city($id_partie, 2);
            
            // récupérer le contenu des coffres
            $coffre_equipe1 = loot_get_coffre_ville_return(1, $id_partie);
            $coffre_equipe2 = loot_get_coffre_ville_return(2, $id_partie);
            
            // calcul des scores de rapidité
            $scores_rapidity = give_bonus_rapidity_score($id_partie, $coffre_equipe1, $coffre_equipe2);
            
            // calcul des scores de combat
            $score_equipe_1 += get_combat_score($id_partie, 1, $joueurs_equipe_1, $coffre_equipe1);
            $score_equipe_2 += get_combat_score($id_partie, 2, $joueurs_equipe_2, $coffre_equipe2);
            
            // calcul des points de victoire
            $victory_points = get_victory_points($scores_rapidity, $score_equipe_1, $score_equipe_2);
            
            // enregistrer le resultat de cette bataille dans la base
            $resultat =  enregistrement_bataille($id_partie, $joueurs_equipe_1, $joueurs_equipe_2, $scores_rapidity, $score_equipe_1, $score_equipe_2, $victory_points); 
            
            //ajouter resultat a resultats
            array_push($resultats, $resultat);
        }
        return $resultats;
    }
    catch (Exception $e)
    {
        error_log($e->getMessage());
    }
}

// Pour récupérer la liste de toutes les parties
function get_all_id_games()
{
    try 
    {
        global $wpdb;
        
        return $wpdb->get_results("SELECT id_partie FROM games_metadata");
    } 
    catch (Exception $e) 
    {
        error_log($e->getMessage());
    }
}

// Récupérer le nombre de joueur dans la ville
function get_players_in_city($id_partie, $equipe)
{
    if($equipe == 1)
    {
        $position = "0;0";
    }
    else if($equipe == 2)
    {
        $position = "19;19";
    }
    
    global $wpdb;
   
    $prepare = $wpdb->prepare("SELECT COUNT(*) AS nombre FROM games_data WHERE id_partie = %d AND equipe = %d AND position = %s", $id_partie, $equipe, $position);
    $resultat = $wpdb->get_row($prepare);   
    
    return $resultat->nombre;   
}

// Calcul des scores de rapidité
function give_bonus_rapidity_score($id_partie, $coffre_equipe1, $coffre_equipe2)
{
    // chaque équipe commence avec 100 de score de rapidité
    $scores = array("equipe1" => 100, "equipe2" => 100);
      
    foreach ($coffre_equipe1 as $value) {
        if($value->type_objet == "véhicule")
        {
            $scores["equipe1"] += $value->valeur_objet;
        }
    }
    
    foreach ($coffre_equipe2 as $value) {
        if($value->type_objet == "véhicule")
        {
            $scores["equipe2"] += $value->valeur_objet;
        }
    }
    
    if($scores["equipe1"] > $scores["equipe2"])
    {
        $scores["equipe1"] += 250;
    }
    else if($scores["equipe1"] < $scores["equipe2"])
    {
        $scores["equipe2"] += 250;
    }   
    
    return $scores; 
}

// A fusionner avec loot_get_coffre_ville dans process_loot.php
function loot_get_coffre_ville_return($id_equipe, $id_partie) {
    
    global $wpdb;
    
    try {
        $query = $wpdb->prepare("SELECT nom_objet, valeur_objet, quantite_objet, type_objet, class_objet FROM coffre_ville AS c, objet AS o, type_objet AS t, class_objet AS co WHERE co.id_class = o.id_class AND c.id_objet=o.id_objet AND o.id_type = t.id_type AND id_equipe='%d' AND id_partie='%d'",$id_equipe,$id_partie);
        $tmp = ($wpdb->get_results($query));
        return $tmp;
        
        
    } catch (Exception $ex) {
        return $e->getMessage();
    }
}

// Calculer le score de comabt
function get_combat_score($id_partie, $equipe, $nombre_joueurs, $coffre_equipe)
{
    $score_coffre = 0;
    
    foreach ($coffre_equipe as $value) {
        if($value->type_objet == "nourriture"  || $value->type_objet == "arme" || $value->type_objet == "protection")
        {
            $score_coffre += $value->valeur_objet * $value->quantite_objet;
        }
    }
    
    $total = $nombre_joueurs * 100 + rand($score_coffre, 1000);   
    
    return $total;
}

// Attribuer les points de victoire
function get_victory_points($scores_rapidity, $score_equipe_1, $score_equipe_2)
{
    $score_equipe_1 += $scores_rapidity["equipe1"];
    $score_equipe_2 += $scores_rapidity["equipe2"];
    
    $victory_points = array("equipe1" => 0, "equipe2" => 0);
    
    $resultat = $score_equipe_1 - $score_equipe_2;
    
    switch(true)
    {
        case $resultat <= -500:
            $victory_points["equipe1"] = -3;
            $victory_points["equipe2"] = 3;
            break;
        case $resultat <= -249:
            $victory_points["equipe1"] = -2;
            $victory_points["equipe2"] = 2;
            break;
        case $resultat <= -1:
            $victory_points["equipe1"] = -1;
            $victory_points["equipe2"] = 1;
            break;
        case $resultat == 0:
            break;
        case $resultat <= 249:
            $victory_points["equipe1"] = 1;
            $victory_points["equipe2"] = -1;
            break;
        case $resultat <= 500:
            $victory_points["equipe1"] = 2;
            $victory_points["equipe2"] = -2;
            break;
        case $resultat >= 500:
            $victory_points["equipe1"] = 3;
            $victory_points["equipe2"] = -3;
            break;      
    } 
    
    return $victory_points;
}

function enregistrement_bataille($id_partie, $joueurs_equipe_1, $joueurs_equipe_2, $scores_rapidity, $score_equipe_1, $score_equipe_2, $victory_points)
{
    global $wpdb;
    
    $query = $wpdb->insert(
        'minuit', 
        array(
            'id_partie' => $id_partie,
            'decompte_joueurs_equipe_1' => $joueurs_equipe_1,
            'decompte_joueurs_equipe_2' => $joueurs_equipe_2,
            'score_equipe_1' => $score_equipe_1,
            'score_equipe_2' => $score_equipe_2,
            'score_rapidite_equipe_1' => $scores_rapidity["equipe1"],
            'score_rapidite_equipe_2' => $scores_rapidity["equipe2"],
            'points_victoire_equipe_1' => $victory_points["equipe1"],
            'points_victoire_equipe_2' => $victory_points["equipe2"]
        ), 
        array(
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d'
        )
    );
    
    
    $pts_victoire_equipe_1 = get_points_victoire(1, $id_partie);    
    $pts_victoire_equipe_2 = get_points_victoire(2, $id_partie);
    
    
    $prepare = $wpdb->prepare("UPDATE `score` SET `score`='%d' WHERE equipe='%d' AND id_partie='%d'", $pts_victoire_equipe_1 + $victory_points["equipe1"], 1, $id_partie);
    $wpdb->query($prepare);
    
    $prepare2 = $wpdb->prepare("UPDATE `score` SET `score`='%d' WHERE equipe='%d' AND id_partie='%d'", $pts_victoire_equipe_2 + $victory_points["equipe2"], 2, $id_partie);
    $wpdb->query($prepare2);

    return array(
        'id_partie' => $id_partie,
        'decompte_joueurs_equipe_1' => $joueurs_equipe_1,
        'decompte_joueurs_equipe_2' => $joueurs_equipe_2,
        'score_equipe_1' => $score_equipe_1,
        'score_equipe_2' => $score_equipe_2,
        'score_rapidite_equipe_1' => $scores_rapidity["equipe1"],
        'score_rapidite_equipe_2' => $scores_rapidity["equipe2"],
        'points_victoire_equipe_1' => $victory_points["equipe1"],
        'points_victoire_equipe_2' => $victory_points["equipe2"]
    );
}


function get_points_victoire($equipe, $id_partie)
{
    global $wpdb;
    $prepare = $wpdb->prepare("SELECT score FROM score WHERE id_partie = %d AND equipe = %d", $id_partie, $equipe);
    $score_equipe_base = $wpdb->get_row($prepare);
    return $score_equipe_base->score;
}

function end_game($id_partie)
{
    if(get_points_victoire(1, $id_partie) >= 10 || get_points_victoire(2, $id_partie) >= 10 || check_victoire_temps($id_partie))
    {
        return true;
    }
    return false;
}

function check_victoire_temps($id_partie)
{
    global $wpdb;
    $prepare = $wpdb->prepare("SELECT start FROM games_metadata WHERE id_partie = %d", $id_partie);
    $start = $wpdb->get_row($prepare);

    date_default_timezone_set("Europe/Paris");
    
    $date1 = $start->start;
    $datetest = date_create_from_format('Y-m-d H:i:s', $date1);  
       
    $date2 = time();
   
    
    
    if($date2 - $datetest->getTimestamp() > 604800)
    {
        //error_log("plus que l'interval");
        return true;
    }
    else
    {
        //error_log("moins que l'interval");
        return false;
    }

}