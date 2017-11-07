
function move(id, id_partie) {
    var coo = id.className.split(' ')[0];
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'move', new_position: coo, id_partie: id_partie},
        success: function (output) {
            
            if (output.trim() == "false") {
                $('#resultat').html("Pas assez de points d'action !");
            } else {
                $('#grille').load('?id=' + $.trim(output) + ' #grille');
                $('#points_action').load('?id=' + $.trim(output) + ' #points_action');
                $('#position').load('?id=' + $.trim(output) + ' #position');
                event_game(id);
            }
            
        }
    });
   
}

function tour_suivant(id_partie) {
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'tour_suivant', id_partie: id_partie},
        success: function (output) {
            $('#resultat').html("action effectuée !!");
            $('#points_action').html(output);

        }
    });
}

function display_pseudo_oncell(id, id_partie) {

    var coo = id.className.split(' ')[0];
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'get_ids_from_cell', position: coo, id_partie: id_partie},
        success: function (output) {
            $('#zoneJoueur').html(output);
        }
    });

}
$(document).ready(function () {
    name_cell();
});
$(document).ajaxComplete(function () {
    name_cell();
});

function name_cell() {
    $(".cellule").click(function () {
        var coo = this.className.split(' ')[0];
        $("#nom_position").html(coo);
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
function event(id) {

    
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_event.php',
        type: 'post',
        data: {info: 'event_check_position'},
        success: function (output) {
            alert(output);
           
        }
    });

}
