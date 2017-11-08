
$(document).ready(function () {
    add_id_to_building();
    display_info_bat();
});

function display_info_bat() {
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {php_function_file: 'get_information_building', called_ajax_php: "process_building.php"},
        success: function (output) {
            var azerty = JSON.parse(output);
            $('#bat_1').html("xp=" + azerty[0]["xp"] + "<br/>type=" + azerty[0]["type"] + "<br/>level=" + azerty[0]["niveau"]);
//            $('#bat_2').html("xp=" + azerty[0]["xp"] + "<br/>type=" + azerty[0]["type"] + "<br/>level=" + azerty[0]["niveau"]);
//            $('#bat_3').html("xp=" + azerty[0]["xp"] + "<br/>type=" + azerty[0]["type"] + "<br/>level=" + azerty[0]["niveau"]);
//            $('#bat_4').html("xp=" + azerty[0]["xp"] + "<br/>type=" + azerty[0]["type"] + "<br/>level=" + azerty[0]["niveau"]);

            console.log(azerty[0]);
        }
    });
}

function add_id_to_building() {
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_building.php',
        type: 'post',
        data: {php_function_file: 'get_ids_building', called_ajax_php: "process_building.php"},
        success: function (output) {
            alert(output);
            var tab_id_bat = JSON.parse(output);
            $('.caserne').attr("id", "bat_" + tab_id_bat[0]['id']);
            $('.maison').attr("id", "bat_" + tab_id_bat[1]['id']);
            $('.mairie').attr("id", "bat_" + tab_id_bat[2]['id']);
            $('.hopital').attr("id", "bat_" + tab_id_bat[3]['id']);
        }
    });
}