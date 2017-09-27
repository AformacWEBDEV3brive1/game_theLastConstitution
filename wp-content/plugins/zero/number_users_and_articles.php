<?php

class Zero_Number_Users_And_Articles
{
    public function __construct()
    {
	function wpb_user_count() { 
		$usercount = count_users();
		$result = $usercount['total_users']; 
		echo "Nombre d'utilisateurs: " . $result; 
	}

	function wpb_article_count() { 
		$count_posts = wp_count_posts();
		$published_posts = $count_posts->publish;
		echo "<br/> Nombre d'articles publiés: " . $published_posts; 
	} 

	add_filter('wp_head', 'wpb_user_count');
	add_filter('wp_head', 'wpb_article_count');


    }
}
