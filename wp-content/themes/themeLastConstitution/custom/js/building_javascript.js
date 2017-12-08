function display_info_bat(id_partie) {
    //ajoute les id au batiments
       $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {php_function_file: 'get_ids_building', id_partie: id_partie, called_ajax_php: "process_building.php"},
        success: function (output) {
            var tab_id_bat = JSON.parse(output);
            $('.caserne').attr("id", "bat_" + tab_id_bat[0]['id']);
            $('.banque').attr("id", "bat_" + tab_id_bat[1]['id']);
            $('.maison').attr("id", "bat_" + tab_id_bat[2]['id']);
            $('.hopital').attr("id", "bat_" + tab_id_bat[3]['id']);
            
            
            //affiche les informations des batiments
            //cet appel aura lieu en cas de succès du premier
            $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
                type: 'post',
                data: {php_function_file: 'get_information_buildings', id_partie: id_partie, called_ajax_php: "process_building.php"},
                success: function (output) {
                    var tab_infos_bat = JSON.parse(output);
                    
                    for(compteur = 0; compteur <= 3; compteur++)
                    {
                        var path = "#bat_" + tab_id_bat[compteur]['id'];
                        
                        $(path + ' .xp').html(tab_infos_bat[compteur]["xp"]);
                        $(path + ' .type').html(tab_infos_bat[compteur]["type"]);
                        $(path + ' .level').html(tab_infos_bat[compteur]["niveau"]);
                    }    
                }
            });
        }
    });
}

function upgrade_building(id, id_partie) {
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {php_function_file: 'add_xp_to_bat', id_building: id.substring(4), id_partie: id_partie, xp: 1, called_ajax_php: "process_building.php"},
        success: function (output) {
            display_info_bat(location.search.substring(4));
            $('#points_action').load('?id=' + location.search.substring(4) + ' #points_action');
        }
    });
}

