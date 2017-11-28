function loot_from_coffre_ville() {
    var id_partie = location.search.substring(4);//renvoie id qui est dans l'url
    var id_equipe = $('.team').clone().children().remove().end().text().trim();//.clone() clones the selected element.children() selects the children from the cloned element .remove() removes the previously selected children .end() selects the selected element again .text() gets the text from the element without children
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'loot_get_loot_from_coffre_ville', id_partie: id_partie, id_equipe:id_equipe, php_function_file: "process_loot.php"},
        success: function (output) {
            if (output=='') {
                //ne fait rien si pas d'event
            } else {
                var tab = JSON.parse(output);
                console.log(" il y a  "+tab[1]["quantite_objet"]+" "+tab[1]["nom_objet"]+" "+tab[1]["class_objet"]+" de valeur "+tab[1]["valeur_objet"]);   
            }
        }
    });

}

function loot_zone(id_partie){
    
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_loot.php',
    type: 'post',
     data: {info: 'looted', id_partie : id_partie},
     success: function (output){
         console.log(output);
         $('#zone_joueur').html(output);
         $('#button_fouiller').prop('disabled', true);
     }
});

}


function loot_recup(){
    
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_loot.php',
    type: 'post',
     data: {info: 'loot_get_random_type'},
     success: function (output){
         console.log($type);
     }
});

}