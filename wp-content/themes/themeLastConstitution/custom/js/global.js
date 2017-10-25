function move(id) {
    var coo = id.className.split(' ')[0];
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'move', new_position: coo},
        success: function (output) {
            $('#grille').load('index.php #grille');
            $('#points_action').load('index.php #points_action');
            $('#position').load('index.php #position');

        }
    });
}

function tour_suivant() {
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'tour_suivant'},
        success: function (output) {
            $('#resultat').html("action effectuée !!");
            $('#points_action').load('index.php #points_action');
        }
    });
}
function display_pseudo_oncell(id) {
    var coo = id.className.split(' ')[0];
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'get_ids_from_cell', position: coo},
        success: function (output) {
            $('#zoneJoueur').html(output);
        }

    });
}


function show_menu(id_menu) {
    // console.log(id_menu);
    if (id_menu == "ville") {
        //   console.log("Click VILLE");
        $("#ville").removeClass("hidden");
        $("#chat").addClass("hidden");
        $("#inventaire").addClass("hidden");
        $("#zone").addClass("hidden");

    } else if (id_menu == "inventaire") {
        // console.log("Click INVENTAIRE");
        $("#inventaire").removeClass("hidden");
        $("#chat").addClass("hidden");
        $("#ville").addClass("hidden");
        $("#zone").addClass("hidden");
    } else if (id_menu == "chat") {
        // console.log("Click CHAT");
        $("#chat").removeClass("hidden");
        $("#ville").addClass("hidden");
        $("#inventaire").addClass("hidden");
        $("#zone").addClass("hidden");
    } else if (id_menu == "zone") {
        // console.log("Click ZONE");
        $("#zone").removeClass("hidden");
        $("#chat").addClass("hidden");
        $("#ville").addClass("hidden");
        $("#inventaire").addClass("hidden");
    }
}
