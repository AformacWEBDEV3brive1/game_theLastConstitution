function move(id) {
    //alert('x='+ id.className.split(' ')[1] + ' y=' + id.className.split(' ')[3]);
    var x = id.className.split(' ')[1];
    var y = id.className.split(' ')[3];
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'move', new_position: x + ";" + y},
        success: function (output) {
            $('#grille').load('index.php #grille');
            $('#points_action').load('index.php #points_action');

        }
    });
}

function tour_suivant() {
    $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'tour_suivant'},
        success: function (output) {
            $('#resultat').html("action effectuée !!");
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
        
    } else if (id_menu == "inventaire") {
       // console.log("Click INVENTAIRE");
        $("#inventaire").removeClass("hidden");
        $("#chat").addClass("hidden");
        $("#ville").addClass("hidden");
    }

    else if (id_menu == "chat"){
       // console.log("Click CHAT");
        $("#chat").removeClass("hidden");
        $("#ville").addClass("hidden");
        $("#inventaire").addClass("hidden");
    }
}