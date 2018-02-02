/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//function display_all_games() {
//    console.log("coucou");
//    $.ajax({url: '../../wp-content/plugins/game_plugin/process_lobby.php',
//        type: 'post',
//        data: {info: 'get_all_games'},
//        success: function (output) {
//            $('#partie_dispo').load(output);
//
//
//        }
//    });
//}




function subscribe_game() {
    console.log("couicou");
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_lobby.php',
        type: 'post',
        data: {info: 'subscribe_game', called_ajax_php: "process_general.php"},
        success: function (output) {
        console.log("lacacacacacacacaca " + output);
      $('#button_recherche').prop('disabled', true);  
      $('#gamer_mate').html("Actuellement " + output + "personnes recherchent une game");
        }
    });
}

function subscribe_game() {
    console.log("couicou");
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_lobby.php',
        type: 'post',
        data: {info: 'subscribe_game', called_ajax_php: "process_general.php"},
        success: function (output) {

        }
    });
}


