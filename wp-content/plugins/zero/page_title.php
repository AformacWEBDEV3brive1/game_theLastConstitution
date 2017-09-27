<?php

class Zero_Page_Title
{
    public function __construct()

    {
        add_filter('pre_get_document_title', 'change_the_title');
	function change_the_title() {
		return 'TEST TITRE';
    	}
    }
}
