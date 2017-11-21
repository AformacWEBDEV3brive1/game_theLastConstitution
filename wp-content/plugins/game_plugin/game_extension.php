<?php

/*

  Plugin Name: Insertion des tables

 */

include_once( plugin_dir_path(__FILE__) . 'parameters/parameters.php');

function create_table() {

    $wpdb = openBDD();

    $wpdb->query("CREATE TABLE games_data (
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
  `type`  enum('+','-') NOT NULL,
  `position` VARCHAR(8) NOT NULL,
  `valeur` int NOT NULL
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `batiments` (
  `id` int NOT NULL,
  `id_partie` int NOT NULL,
  `equipe` int NOT NULL,
  `xp` int NOT NULL,
  `niveau` int NOT NULL,
  `type` int NOT NULL
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `level_batiments` (
  `limite_xp` int NOT NULL,
  `niveau` int NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `type_batiments` (
  `type` int NOT NULL,
  `nom` VARCHAR(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `batiments`
ADD PRIMARY KEY (id);

ALTER TABLE `level_batiments` 
ADD PRIMARY KEY (niveau);

ALTER TABLE `type_batiments` 
ADD PRIMARY KEY (type);

ALTER TABLE `games_data`
ADD PRIMARY KEY (id_joueur,id_partie);

ALTER TABLE `games_metadata`
ADD PRIMARY KEY (id_partie);

ALTER TABLE `games_data`
ADD CONSTRAINT `games_data_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `batiments` 
ADD CONSTRAINT `batiments` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `batiments` 
ADD CONSTRAINT `batiments_frgn` FOREIGN KEY (`niveau`) REFERENCES `level_batiments` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `batiments` 
ADD CONSTRAINT `batiments_zdeg` FOREIGN KEY (`type`) REFERENCES `type_batiments` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

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


CREATE TABLE `game_player` (
  
  `id_joueur` int NOT NULL,
  `id_partie` int NOT NULL,
  `score_combat`int NOT NULL,
  `score_rapidite` int NOT NULL
  
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `coffre_ville` (
  
  `id_equipe` int NOT NULL,
  `id_partie` int NOT NULL,
  `id_objet` int NOT NULL,
  `quantite_objet` int NOT NULL
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `objet` (
  
  `id_objet` int NOT NULL,
  `nom_objet` VARCHAR (250) NOT NULL,
  `id_type`int NOT NULL,
  `id_class` int NOT NULL,
  `valeur_objet` int NOT NULL
  
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `type_objet` (
  
  `id_type` int NOT NULL,
  `type_objet` VARCHAR(250) NOT NULL
 
  
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `class_objet` (
  
  `id_class` int NOT NULL,
  `class_objet` VARCHAR(250) NOT NULL,
  `id_type` int(11) NOT NULL,
  `proba` int(11) DEFAULT NULL
 
  
  
  
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `class_objet`
ADD PRIMARY KEY (class_objet),
ADD KEY `class_objet` (`class_objet`),
ADD KEY `id_class` (`id_class`),
ADD KEY `id_type` (`id_type`);

ALTER TABLE `coffre_ville`
ADD PRIMARY KEY (id_objet);

ALTER TABLE `objet`
ADD PRIMARY KEY (`id_objet`),
ADD KEY `id_type` (`id_type`),
ADD KEY `id_class` (`id_class`),
MODIFY `id_objet` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `type_objet`
ADD PRIMARY KEY (id_type);


  
ALTER TABLE `objet`
  ADD CONSTRAINT `objet_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_objet` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objet_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class_objet` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `coffre_ville`
  ADD CONSTRAINT `coffre_ville_ibfk_1` FOREIGN KEY (`id_objet`) REFERENCES `objet` (`id_objet`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `class_objet`
  ADD CONSTRAINT `class_objet_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_objet` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;




INSERT INTO `type_objet` (`id_type`, `type_objet`) VALUES
(1, 'arme'),
(2, 'protection'),
(3, 'véhicule'),
(4, 'nourriture');
  
INSERT INTO `class_objet` (`id_class`, `class_objet`, `id_type`, `proba`) VALUES
(1, 'pierre', 1, 50),
(2, 'fer', 1, 70),
(3, 'poudre noir', 1, 85),
(4, 'laser', 1, 90),
(5, 'atomique', 1, 95),
(6, 'bois', 2, 50),
(7, 'acier', 2, 70),
(8, 'kevlar', 2, 85),
(9, 'composite', 2, 90),
(10, 'champ de force energetique', 2, 95),
(11, 'vélo', 3, 50),
(12, 'scooter', 3, 70),
(13, 'voiture', 3, 85),
(14, '4x4', 3, 90),
(15, 'hélicoptère', 3, 95),
(16, 'simple', 4, 50),
(17, 'basique', 4, 70),
(18, 'de bonne qualité', 4, 85),
(19, 'de survie', 4, 90),
(20, 'dopant', 4, 95);



INSERT INTO `objet` (`id_objet`, `nom_objet`, `id_type`, `id_class`, `valeur_objet`) VALUES
(1, 'masse', 1, 1, 10),
(2, 'épée', 1, 2, 20),
(3, 'fusil artisanal ', 1, 3, 30),
(4, 'sabre', 1, 4, 40),
(5, 'canon', 1, 5, 50),
(6, 'bouclier', 2, 1, 10),
(7, 'armure', 2, 2, 20),
(8, 'plastron', 2, 3, 30),
(9, 'combinaison', 2, 4, 40),
(10, 'bouclier', 2, 5, 50),
(11, 'nakamura', 3, 1, 10),
(12, 'vespa', 3, 2, 20),
(13, 'delorean', 3, 3, 30),
(14, 'monster truck', 3, 4, 40),
(15, 'apache', 3, 5, 50),
(16, 'fruit', 4, 1, 10),
(17, 'légume', 4, 2, 20),
(18, 'viande', 4, 3, 30),
(19, 'ration', 4, 4, 40),
(20, 'capsule', 4, 5, 50);

INSERT INTO `level_batiments` (`limite_xp`, `niveau`) VALUES 

(10, 1),
(15, 2),
(20, 3),
(25, 4),
(30, 5);

INSERT INTO `type_batiments` (`type`, `nom`) VALUES

(1, 'caserne'),
(2, 'mairie'),
(3, 'maison'),
(4, 'hopital');

INSERT INTO `batiments` (`id`, `id_partie`, `equipe`, `xp`, `niveau`, `type`) VALUES

(1, 1, 1, 11, 1, 1),
(2, 1, 1, 15, 2, 2),
(3, 1, 1, 20, 3, 3),
(4, 1, 1, 30, 5, 4);



");
    
   error_log( var_dump( $wpdb->last_query ) );
}


function drop_table() {
    $wpdb = openBDD();

    
    $wpdb->query("DROP TABLE IF EXISTS games_data, games_metadata, events, batiments, level_batiments, type_batiments, coffre_ville, objet, game_player, type_objet, class_objet");
}

register_activation_hook(__FILE__, 'create_table');

register_deactivation_hook(__FILE__, 'drop_table');
?>