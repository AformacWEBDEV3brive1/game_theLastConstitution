<?php

/*
 *
 * Plugin Name: Insertion des tables
 *
 */
include_once (plugin_dir_path(__FILE__) . 'parameters/parameters.php');

function create_table()
{
    $wpdb = openBDD();
    
    $wpdb->query("
CREATE TABLE `batiments` (
  `id` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `equipe` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  `position` varchar(8) NOT NULL,
  `equipe` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `heure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `class_objet`
--

CREATE TABLE `class_objet` (
  `id_class` int(11) NOT NULL,
  `class_objet` varchar(250) NOT NULL,
  `id_type` int(11) NOT NULL,
  `proba` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `coffre_ville`
--

CREATE TABLE `coffre_ville` (
  `id_equipe` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `id_objet` int(11) NOT NULL,
  `quantite_objet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_partie` int(11) NOT NULL,
  `type` enum('+','-') NOT NULL,
  `position` varchar(8) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `games_data`
--

CREATE TABLE `games_data` (
  `id_joueur` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `position` varchar(8) NOT NULL,
  `points_action` int(11) NOT NULL,
  `equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `games_metadata`
--

CREATE TABLE `games_metadata` (
  `id_partie` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `level_batiments`
--

CREATE TABLE `level_batiments` (
  `limite_xp` int(11) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lobby`
--

CREATE TABLE `lobby` (
  `id_joueur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `looted`
--

CREATE TABLE `looted` (
  `id` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `minuit`
--

CREATE TABLE `minuit` (
  `id` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `decompte_joueurs_equipe_1` int(11) NOT NULL,
  `decompte_joueurs_equipe_2` int(11) NOT NULL,
  `score_equipe_1` int(11) NOT NULL,
  `score_equipe_2` int(11) NOT NULL,
  `score_rapidite_equipe_1` int(11) NOT NULL,
  `score_rapidite_equipe_2` int(11) NOT NULL,
  `points_victoire_equipe_1` int(11) NOT NULL,
  `points_victoire_equipe_2` int(11) NOT NULL,
  `bataille` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `id_objet` int(11) NOT NULL,
  `nom_objet` varchar(250) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `valeur_objet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `id_partie` int(11) NOT NULL,
  `equipe` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_batiments`
--

CREATE TABLE `type_batiments` (
  `type` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_objet`
--

CREATE TABLE `type_objet` (
  `id_type` int(11) NOT NULL,
  `type_objet` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Index pour la table `batiments`
--
ALTER TABLE `batiments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batiments` (`id_partie`),
  ADD KEY `batiments_frgn` (`niveau`),
  ADD KEY `batiments_zdeg` (`type`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_ibfk_1` (`id_joueur`),
  ADD KEY `chat_ibfk_2` (`id_partie`);

--
-- Index pour la table `class_objet`
--
ALTER TABLE `class_objet`
  ADD PRIMARY KEY (`id_class`),
  ADD KEY `ind_id_type` (`id_type`);

--
-- Index pour la table `coffre_ville`
--
ALTER TABLE `coffre_ville`
  ADD KEY `ind_id_partie` (`id_partie`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD KEY `ind_id_partie` (`id_partie`);

--
-- Index pour la table `games_data`
--
ALTER TABLE `games_data`
  ADD PRIMARY KEY (`id_joueur`,`id_partie`),
  ADD KEY `games_data_ibfk_1` (`id_partie`);

--
-- Index pour la table `games_metadata`
--
ALTER TABLE `games_metadata`
  ADD PRIMARY KEY (`id_partie`);

--
-- Index pour la table `level_batiments`
--
ALTER TABLE `level_batiments`
  ADD PRIMARY KEY (`niveau`);

--
-- Index pour la table `looted`
--
ALTER TABLE `looted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind_id_partie` (`id_partie`);

--
-- Index pour la table `minuit`
--
ALTER TABLE `minuit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind_id_partie` (`id_partie`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`id_objet`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_class` (`id_class`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind_id_partie` (`id_partie`);

--
-- Index pour la table `type_batiments`
--
ALTER TABLE `type_batiments`
  ADD PRIMARY KEY (`type`);

--
-- Index pour la table `type_objet`
--
ALTER TABLE `type_objet`
  ADD PRIMARY KEY (`id_type`);
--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `games_metadata`
--
ALTER TABLE `games_metadata`
  MODIFY `id_partie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `looted`
--
ALTER TABLE `looted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `minuit`
--
ALTER TABLE `minuit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `objet`
--
ALTER TABLE `objet`
  MODIFY `id_objet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wp_commentmeta`
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `batiments`
--
ALTER TABLE `batiments`
  ADD CONSTRAINT `batiments` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `batiments_frgn` FOREIGN KEY (`niveau`) REFERENCES `level_batiments` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `batiments_zdeg` FOREIGN KEY (`type`) REFERENCES `type_batiments` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `games_data` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `class_objet`
--
ALTER TABLE `class_objet`
  ADD CONSTRAINT `class_objet_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_objet` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coffre_ville`
--
ALTER TABLE `coffre_ville`
  ADD CONSTRAINT `coffre_ville_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `games_data`
--
ALTER TABLE `games_data`
  ADD CONSTRAINT `games_data_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `looted`
--
ALTER TABLE `looted`
  ADD CONSTRAINT `looted_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `minuit`
--
ALTER TABLE `minuit`
  ADD CONSTRAINT `minuit_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `objet`
--
ALTER TABLE `objet`
  ADD CONSTRAINT `objet_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_objet` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objet_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class_objet` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `games_metadata` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- INSERT
--

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
(6, 'bouclier', 2, 6, 10),
(7, 'armure', 2, 7, 20),
(8, 'plastron', 2, 8, 30),
(9, 'combinaison', 2, 9, 40),
(10, 'bouclier', 2, 10, 50),
(11, 'nakamura', 3, 11, 10),
(12, 'vespa', 3, 12, 20),
(13, 'delorean', 3, 13, 30),
(14, 'monster truck', 3, 14, 40),
(15, 'apache', 3, 15, 50),
(16, 'fruit', 4, 16, 10),
(17, 'légume', 4, 17, 20),
(18, 'viande', 4, 18, 30),
(19, 'ration', 4, 19, 40),
(20, 'capsule', 4, 20, 50);

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
");
    
    error_log(var_dump($wpdb->last_query));
}

function drop_table()
{
    $wpdb = openBDD();
    
    $wpdb->query("DROP TABLE IF EXISTS score, lobby, minuit, coffre_ville, objet, class_objet, type_objet, looted, events, chat, games_data, batiments, level_batiments, type_batiments, games_metadata");
}

register_activation_hook(__FILE__, 'create_table');

register_deactivation_hook(__FILE__, 'drop_table');
?>
