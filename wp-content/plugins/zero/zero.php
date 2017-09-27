<?php
/*
Plugin Name: Zero plugin
Plugin URI: http://zero-plugin.com
Description: Un plugin d'introduction pour le développement sous WordPress
Version: 0.1
Author: Midnight Falcon
Author URI: http://votre-site.com
License: GPL2
*/


class Zero_Plugin
{
    public function __construct()
    {
   	include_once plugin_dir_path( __FILE__ ).'/newsletter.php';
    	new Zero_Newsletter();

        include_once plugin_dir_path( __FILE__ ).'/page_title.php';
        new Zero_Page_Title();

        include_once plugin_dir_path( __FILE__ ).'/number_users_and_articles.php';
        new Zero_Number_Users_And_Articles();
    }
}

new Zero_Plugin();
