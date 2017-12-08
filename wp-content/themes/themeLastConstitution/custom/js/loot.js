function loot_from_coffre_ville() {
    
    var id_partie = location.search.substring(4);//renvoie id qui est dans l'url
    var id_equipe = $('.team').clone().children().remove().end().text().trim();//.clone() clones the selected element.children() selects the children from the cloned element .remove() removes the previously selected children .end() selects the selected element again .text() gets the text from the element without children
    console.log("id équipe" + id_equipe);
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_general.php',
        type: 'post',
        data: {info: 'loot_get_loot_from_coffre_ville', id_partie: id_partie, id_equipe: id_equipe, php_function_file: "process_loot.php"},
        success: function (output) {
            if (output == '') {
                //ne fait rien si pas d'event
            } else {
                var tab = JSON.parse(output);
                var long_tab = tab.length;

                var val_arme = 0;
                var tab_arme = [];

                var val_protection = 0;
                var tab_protection = [];

                var val_food = 0;
                var tab_food = [];

                var val_vehicule = 0;
                var tab_vehicule = [];

                for (var i = 0, len = tab.length; i < len; i++) {

                    if (tab[i]["type_objet"] == "arme") {
                        tab_arme_tmp = {'quantite': tab[i]["quantite_objet"], 'nom': tab[i]["nom_objet"], 'valeur': tab[i]["valeur_objet"], 'class': tab[i]["class_objet"]};
                        tab_arme.push(tab_arme_tmp);
                        var val_arme = val_arme + tab[i]["valeur_objet"] * tab[i]["quantite_objet"];
                        $(".result_arme").text("(" + val_arme + ") : ");
                        $(".nom_arme").text("");
                        
                        for (var j = 0, long = tab_arme.length; j < long; j++) {
                             $(".nom_arme").append(tab_arme[j]["quantite"] + "× " + tab_arme[j]['nom'] + " " + tab_arme[j]["class"] + " (" + tab_arme[j]['valeur'] + ") ; ");
                        }

                    } else if (tab[i]["type_objet"] == "protection") {
                        tab_protection_tmp = {'quantite': tab[i]["quantite_objet"], 'nom': tab[i]["nom_objet"], 'valeur': tab[i]["valeur_objet"], 'class': tab[i]["class_objet"]};
                        tab_protection.push(tab_protection_tmp);
                        var val_protection = val_protection + tab[i]["valeur_objet"] * tab[i]["quantite_objet"];
                         $(".result_protection").text("(" + val_protection + ") : ");
                         $(".nom_protection").text("");
                        for (var j = 0, long = tab_protection.length; j < long; j++) {
                            $(".nom_protection").append(tab_protection[j]["quantite"] + "× " + tab_protection[j]['nom'] + " " + tab_protection[j]["class"] + " (" + tab_protection[j]['valeur'] + ") ; ");
                        }


                    } else if (tab[i]["type_objet"] == "véhicule") {
                        tab_vehicule_tmp = {'quantite': tab[i]["quantite_objet"], 'nom': tab[i]["nom_objet"], 'valeur': tab[i]["valeur_objet"], 'class': tab[i]["class_objet"]};
                        tab_vehicule.push(tab_vehicule_tmp);
                        var val_vehicule = val_vehicule + tab[i]["valeur_objet"] * tab[i]["quantite_objet"];
                            $(".result_vehicule").text("(" + val_vehicule + ") : ");
                            $(".nom_vehicule").text("");
                        for (var j = 0, long = tab_vehicule.length; j < long; j++) {
                            $(".nom_vehicule").append(tab_vehicule[j]["quantite"] + "× " + tab_vehicule[j]["class"] + " " + tab_vehicule[j]['nom']  + " (" + tab_vehicule[j]['valeur'] + ") ; ");
                        }

                    } else if (tab[i]["type_objet"] == "nourriture") {
                        tab_food_tmp = {'quantite': tab[i]["quantite_objet"], 'nom': tab[i]["nom_objet"], 'valeur': tab[i]["valeur_objet"], 'class': tab[i]["class_objet"]};
                        tab_food.push(tab_food_tmp);
                        var val_food = val_food + tab[i]["valeur_objet"] * tab[i]["quantite_objet"];
                        $(".result_food").text("(" + val_food + ") : ");
                        $(".nom_food").text("");
                        for (var j = 0, long = tab_food.length; j < long; j++) {
                            $(".nom_food").append(tab_food[j]["quantite"] + "× " + tab_food[j]['nom'] + " " + tab_food[j]["class"] + " (" + tab_food[j]['valeur'] + ") ; ");

                        }
                    }

                }


            }
        }
    });

}

function loot_zone(id_partie){
    
    $.ajax({url: '../../wp-content/plugins/game_plugin/process_loot.php',
    type: 'post',
     data: {info: 'looted', id_partie : id_partie},
     success: function (output){
         $('#zone_joueur').html(output);
         $('#button_fouiller').prop('disabled', true);
     }
});

}


