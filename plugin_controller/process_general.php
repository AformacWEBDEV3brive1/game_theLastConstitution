<?php

/*
 Plugin Name: Fonctions de base
 Description: Les fonctions de base comme get_points_actions, set_position, ...
 Version: 1.0
 Author: Benoît et Alexis
 */

include 'parameters.php';


function get_points_actions($id_joueur){
    try
    {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        $bdd = $db->prepare('SELECT points_actions FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));
        
        $result = $bdd->fetch();
        
        return $result["points_actions"];
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_position($id_joueur){
    try 
    {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        $bdd = $db->prepare('SELECT position FROM games_data WHERE id_joueur = ?');
        $bdd->execute(array($id_joueur));
        
        $result = $bdd->fetch();
        
        return $result["position"];
    } 
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function set_position($id_joueur, $nouvelle_position){
    try
    {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        $bdd = $db->prepare('UPDATE games_data SET position = ? WHERE id_joueur = ?');
        $bdd->execute(array($nouvelle_position, $id_joueur));
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_all_players($id_partie){
    try
    {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        $bdd = $db->prepare('SELECT id_joueur FROM games_data WHERE id_partie = ?');
        $bdd->execute(array($id_partie));
        
        $result = $bdd->fetchALL();
        
        return $result; //tableau de tableau
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function delete_partie($id_partie){
    try
    {
        $db = openBDD(); //fonction pour ouvrir acces BDD
        
        $bdd = $db->prepare('DELETE FROM games_metadata WHERE id = ?');
        $bdd->execute(array($id_partie));
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}