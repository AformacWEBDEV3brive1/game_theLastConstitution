function event_game(id) {
    var position = id.className.split(' ')[0];
    var id_partie = location.search.substring(4);//renvoie id qui est dans l'url
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'event_check_position', id_partie: id_partie, php_function_file: "process_event.php"},
        success: function (output) {
            if (output.trim()=='') {
            } else {

                var tab = JSON.parse(output);
                alert("le résultat de l'event est de " + tab[0]["type"] + tab[0]["valeur"]);   
            }
        }
    });
}




