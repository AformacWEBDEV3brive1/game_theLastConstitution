<?php

/*

Plugin Name: Insertion des tables

*/

include_once( plugin_dir_path( __FILE__ ) . 'parameters/parameters.php');


function create_table(){
    
     $wpdb = openBDD();

    $wpdb->query("CREATE TABLE IF NOT EXISTS games_data "
    ." (
  `id_joueur` int NOT NULL,
  `id_partie` int NOT NULL,
  `position` VARCHAR(8) NOT NULL,
  `points_action` int NOT NULL,
  `equipe` int NOT NULL
 
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


  

CREATE TABLE `games_metadata` (
  `id_partie` int NOT NULL,
  `start` timestamp NOT NULL
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



ALTER TABLE `games_data`
ADD PRIMARY KEY (id_joueur,id_partie);

ALTER TABLE `games_metadata`
ADD PRIMARY KEY (id_partie);


ALTER TABLE `games_data`
ADD CONSTRAINT `games_data_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;");
}

function drop_table(){
    $wpdb = openBDD();

    
    $wpdb->query("DROP TABLES IF EXISTS games_data, games_metadata");
}


register_activation_hook(__FILE__, 'create_table');


register_deactivation_hook(__FILE__, 'drop_table');
?>