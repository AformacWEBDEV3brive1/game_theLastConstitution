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

CREATE TABLE `events` (
  `id_partie` int NOT NULL,
  `type` int NOT NULL,
  `position` VARCHAR(8) NOT NULL,
  `valeur` int NOT NULL
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `games_data`
ADD PRIMARY KEY (id_joueur,id_partie);

ALTER TABLE `games_metadata`
ADD PRIMARY KEY (id_partie);


ALTER TABLE `games_data`
ADD CONSTRAINT `games_data_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `games_metadata` (`id_partie`, `start`) VALUES
(1, CURRENT_TIMESTAMP),
(2, CURRENT_TIMESTAMP),
(3, CURRENT_TIMESTAMP),
(4, CURRENT_TIMESTAMP),
(5, CURRENT_TIMESTAMP),
(6, CURRENT_TIMESTAMP),
(7, CURRENT_TIMESTAMP);


INSERT INTO `games_data` (`id_joueur`, `id_partie`, `position`, `points_action`, `equipe`) VALUES

(1, 1, '7;3', 15, 1),
(2, 1, '8;4', 15, 1),
(3, 1, '2;0', 12, 1),
(4, 1, '19;19', 2, 1),
(5, 1, '15;2', 14, 2),
(6, 1, '5;2', 15, 2),
(7, 1, '0;0', 15, 2);




");

}

    

function drop_table(){
    $wpdb = openBDD();

    
    $wpdb->query("DROP TABLES IF EXISTS games_data, games_metadata, events");
}




register_activation_hook(__FILE__, 'create_table');



register_deactivation_hook(__FILE__, 'drop_table');
?>