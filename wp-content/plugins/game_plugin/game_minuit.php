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
        $parties = get_all_games();
             
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
            
            // calcul des scores de rapidité
            $scores_rapidity = give_bonus_rapidity_score($id_partie);
            
            // calcul des scores de combat
            $score_equipe_1 += get_combat_score($id_partie, 1, $joueurs_equipe_1);
            $score_equipe_2 += get_combat_score($id_partie, 2, $joueurs_equipe_2);
            
            // calcul des points de victoire
            $victory_points = get_victory_points($scores_rapidity, $score_equipe_1, $score_equipe_2);
            
            // enregistrer le resultat de cette bataille dans la base
            enregistrement_bataille($id_partie, $joueurs_equipe_1, $joueurs_equipe_2, $scores_rapidity, $score_equipe_1, $score_equipe_2, $victory_points);
        }
    }
    catch (Exception $e)
    {
        error_log($e->getMessage());
    }
}

// Pour récupérer la liste de toutes les parties
function get_all_games()
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
function give_bonus_rapidity_score($id_partie)
{
    // chaque équipe commence avec 100 de score de rapidité
    $scores = array("equipe1" => 100, "equipe2" => 100);
    
    // QU EST-CE-QUI DETERMINE LE SCORE DE RAPIDITE ???
    
    // en attendant de savoir comment faire le calcul c'est l'équipe 1 qui reçoit le bonus
    $scores["equipe1"] += 250;
    
    return $scores; 
}

// Calculer le score de comabt
function get_combat_score($id_partie, $equipe, $nombre_joueurs)
{
    // le random doit être affecter par les objets  ... MAIS DE QUEL FACON ???
    return $nombre_joueurs * 100 + rand(0, 1000);
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
}