function move(id) {
    var coo = id.className.split(' ')[0];
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'move', new_position: coo},
        success: function (output) {
            $('#grille').load('index.php #grille');

        }
    });
}
function display_pseudo_oncell(id) {
    var coo = id.className.split(' ')[0];
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'get_ids_from_cell', position: coo},
        success: function (output) {
            alert(output);
            //$('.joueur').popover(output);
            $('#monJoueur').popover(output);
        }
        
    });
}
