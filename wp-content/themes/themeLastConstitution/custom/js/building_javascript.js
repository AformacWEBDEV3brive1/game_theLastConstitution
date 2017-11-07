
$(document).ready(function () {
    add_id_to_building();
    display_info_bat();
});

function display_info_bat() {
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {info_building: 'get_information_building'},
        success: function (output) {
            var azerty = JSON.parse(output);
            $('#bat_1').html(azerty[0]);
            $('#bat_2').html('aqwzsxecdrfvtgybuhjniokplm');
            
            console.log(azerty[0]);
            console.log(azerty[0]["xp"]);
            console.log(azerty[0]["type"]);
            console.log(azerty[0]["niveau"]);
        }
    });
}

function add_id_to_building(){
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {id_building: 'get_ids_building'},
        success: function (output){
            var tab_id_bat = JSON.parse(output);            
            $('.caserne').attr("id", "bat_"+tab_id_bat[0]['id']);
            $('.maison').attr("id", "bat_"+tab_id_bat[1]['id']);
            $('.mairie').attr("id", "bat_"+tab_id_bat[2]['id']);
            $('.hopital').attr("id", "bat_"+tab_id_bat[3]['id']);
        }
    });
}
