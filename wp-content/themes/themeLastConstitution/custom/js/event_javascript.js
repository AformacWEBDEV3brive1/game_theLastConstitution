function event_game(id) {
    var position = id.className.split(' ')[0];
    var id_partie = 1;
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_event.php',
        type: 'post',
        data: {info: 'event_check_position', id_partie: id_partie},
        success: function (output) {
            if (output=='') {
                //ne fait rien si pas d'event
            } else {
                var tab = JSON.parse(output);
                alert("le résultat de l'event est de " + tab[0]["type"] + tab[0]["valeur"]);
            }

        }
    });

}


