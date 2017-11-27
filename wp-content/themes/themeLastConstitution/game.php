
<!DOCTYPE html>

<?php
/* Template Name: jeu */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Last Constitution</title>

        <!-- libaries css-->
        <link type="text/css" rel="stylesheet"
              href="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet"
              href="../../wp-content/themes/themeLastConstitution/libraries/font-awesome/css/font-awesome.css" />

        <!-- libraries js -->
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/jQuery/jquery-3.2.1.js"></script>
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/tether/dist/js/tether.js"></script>
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/js/bootstrap.js"></script>


        <!-- custom css & js -->
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/global.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/event_javascript.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/loot.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/building_javascript.js"></script>
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/style.css" />
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/sass/style.css" />
    </head>



    <?php
    get_template_part("../../plugins/game_plugin/process_general.php");
    get_template_part("../../plugins/game_plugin/process_event.php");

    if (is_user_logged_in()) {
        $id_partie_get;
        if (isset($_GET['id'])) {
            $id_partie_get = $_GET['id'];

            $parties = array();
            foreach (get_games(get_current_user_id()) as $value) {

                array_push($parties, $value[0]);
            }

            if (!in_array($id_partie_get, $parties)) {
                wp_redirect(get_permalink(get_page_by_title('lobby')));
                exit();
            }
        }
    } else {
        wp_redirect(home_url());
        exit();
    }
    ?>
    <body onload="display_info_bat(<?php echo $id_partie_get ?>)">

        <h1 class="text-center"> Last Constitution </h1>

        <div class="container">

            <div class="row">
                <div class="col-6">

                    <div id="menu" class="menu">

                        <div id="onglets" class="row justify-content-around">
                            <button type="submit" class="btn col-2" onclick="show_menu('ville')" > Ville </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('etat')" > Etat </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('zone')" > Zone </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('chat')" > Chat </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('coffre'),loot_from_coffre_ville()" > Coffre </button>
                        </div>
                        <div class="container">

                            <div id="ville"> 
                                <h2 class="text-center"> Ville </h2>
                                <div class="row justify-content-around">
                                    <div class="batiment caserne col-6">
                                        <button class="btn" onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"></span></p>
                                        <p>type = <span class="type"></span></p>
                                        <p>niveau = <span class="level"></span></p>
                                    </div>
                                    <div class="batiment banque col-6">
                                        <button class="btn" onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"></span></p>
                                        <p>type = <span class="type"></span></p>
                                        <p>niveau = <span class="level"></span></p>
                                    </div>
                                    <div class="batiment maison col-6">
                                        <button class="btn" onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"></span></p>
                                        <p>type = <span class="type"></span></p>
                                        <p>niveau = <span class="level"></span></p>
                                    </div>
                                    <div class="batiment hopital col-6">
                                        <button class="btn" onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"></span></p>
                                        <p>type = <span class="type"></span></p>
                                        <p>niveau = <span class="level"></span></p>
                                    </div>
                                </div>
                            </div>

                            <div id="etat" class="hidden">
                                <h2 class="text-center"> Etat </h2>
                                <div id="pseudo">
                                    <p>Pseudo:
                                        <?php
                                        $current_user = wp_get_current_user();
                                        echo $current_user->user_login;
                                        ?> 
                                    </p>

                                </div>
                                <div>
                                    <p>
                                        Vous avez: <span id="points_action">
                                            <?php
                                            echo get_points_action(get_current_user_id(), $id_partie_get);
                                            ?> 
                                        </span> points d'action.
                                    </p>

                                </div>
                                <div id="num_team">
                                    <p>
                                        Vous êtes dans l'équipe <span class="team">
                                            <?php
                                            echo get_team(get_current_user_id(), $id_partie_get);
                                            ?> 
                                        </span>
                                    </p>
                                </div>
                                <div id="position">
                                    <p>Vous êtes en: 
                                        <?php
                                        echo get_position(false, $id_partie_get);
                                        ?>
                                    </p>
                                </div>

                            </div>

                            <div id="chat" class="hidden">
                                <h2 class="text-center">
                                    Chat <span id="switch_chat">: ville</span>
                                </h2>
                                <div id="onglets" class="row justify-content-around">
                                    <button type="submit" class="btn col-2"
                                            onclick="show_menu_chat('ville')">ville</button>
                                    <button type="submit" class="btn col-2"
                                            onclick="show_menu_chat('case')">case</button>
                                </div>

                                <div id="bloc_chat_ville" class="chat_spe">
                                    <div class="chat">
                                        <div id="chat_ville">
                                            <?php
                                            // error_log("idpartieget: " . $id_partie_get);

                                            $chat_ville = load_chat_by_tag("ville", $id_partie_get);

                                            // error_log("chat ville: " . $chat_ville);

                                            if ($chat_ville != null) {
                                                foreach ($chat_ville as $value) {
                                                    ?> 
                                                    <div class="row">
                                                        <div class="col-3"><?php echo $value->heure ?></div>
                                                        <!-- <div class="col-2"><?php //echo get_login_by_id($value->id_joueur); ?></div> -->
                                                        <div class="col-2"><?php get_user_by('id', $value->id_joueur);
                                            echo $user->login ?></div>
                                                        <div class="col-7"><?php echo $value->message; ?></div>
                                                    </div>
                                                    <hr />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="text" id="message_ville">
                                    <button type="submit" class="btn btn-secondary"
                                            onclick="send_message('ville')">Envoyer</button>
                                </div>
                                <div id="bloc_chat_case" class="chat_spe hidden">
                                    <div class="chat">
                                        <div id="chat_case">
                                            <?php
                                            $chat_case = load_chat_by_tag("case", $id_partie_get);

                                            // error_log("chat case: " . $chat_case);

                                            if ($chat_case != null) {
                                                foreach ($chat_case as $value) {
                                                    ?> 
                                                    <div class="row">
                                                        <div class="col-3"><?php echo $value->heure ?></div>
                                                        <!--  <div class="col-2"><?php //echo get_login_by_id($value->id_joueur); ?></div>-->
                                                        <div class="col-2"><?php $user = get_user_by('id', $value->id_joueur);
                                                    echo $user->login ?></div>
                                                        <div class="col-7"><?php echo $value->message; ?></div>
                                                    </div>
                                                    <hr />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="text" id="message_case">
                                    <button type="submit" class="btn btn-secondary"
                                            onclick="send_message('case')">Envoyer</button>
                                </div>
                                <p id="message_reponse"></p>
                            </div>


                            <div id="zone" class="hidden">
                                <h2 class="text-center">
                                    Zone <span id="nom_position"></span>
                                </h2>
                                <p id="zoneJoueur"></p>


                            </div>
                            
                            
                            <div id="coffre" class="hidden">
                                <h2 class="text-center"> Coffre de Ville </h2>
                                
                                <div id="arme_list" class="row invent">
                                    <p>Armes : 
                                        <?php echo "120" ;?>
                                    </p>
                                        <div>
                                            <?php
                                                
                                                    echo '<div class="arme item_list"></div>';
                                                
                                            ?>
                                        </div>
                                </div>
                                
                                
                                <div id="vehicule_list" class="row invent">
                                    <p>Véhicules : 
                                        <?php echo "60" ;?>
                                    </p>
                                        <div>
                                            <?php
                                                
                                                    echo '<div class="vehicule item_list"></div>';
                                                
                                            ?>
                                        </div>
                                </div>
                                
                                
                                <div id="prot_list" class="row invent">
                                <p>Protection : 
                                    <?php echo "50" ;?>
                                </p>
                                    <div>
                                        <?php
                                            
                                                echo '<div class="prot item_list"></div>';
                                            
                                        ?>
                                    </div>
                                
                                </div>
                                
                                
                                
                                <div id="food_list" class="row invent">
                                    <p>Nourritures : 
                                        <?php echo "230" ;?>
                                    </p>
                                        <div>
                                            <?php
                                                
                                                    echo '<div class="food item_list"></div>';
                                                
                                            ?>
                                        </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div id="coffre" class="hidden">
                        <h2 class="text-center"> Coffre de Ville </h2>

                        <div id="arme_list" class="row invent">
                            <p>Armes : 
                                <?php echo "120"; ?>
                            </p>
                            <div>
                                <?php
                                for ($i = 0; $i < 50; $i++) {
                                    echo '<div class="arme item_list"></div>';
                                }
                                ?>
                            </div>
                        </div>


                        <div id="vehicule_list" class="row invent">
                            <p>Véhicules : 
                                <?php echo "60"; ?>
                            </p>
                            <div>
                                <?php
                                for ($i = 0; $i < 20; $i++) {
                                    echo '<div class="vehicule item_list"></div>';
                                }
                                ?>
                            </div>
                        </div>


                        <div id="prot_list" class="row invent">
                            <p>Protection : 
                                <?php echo "50"; ?>
                            </p>
                            <div>
                                <?php
                                for ($i = 0; $i < 30; $i++) {
                                    echo '<div class="prot item_list"></div>';
                                }
                                ?>
                            </div>

                        </div>



                        <div id="food_list" class="row invent">
                            <p>Nourritures : 
                                <?php echo "230"; ?>
                            </p>
                            <div>
                                <?php
                                for ($i = 0; $i < 40; $i++) {
                                    echo '<div class="food item_list"></div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>







                <div class="col-6">
                    <div id="grille" class="">    
                        <?php
                        if (isset($id_partie_get)) {
                            $pos = get_position(false, $id_partie_get);
                            $pos_allies = get_position(true, $id_partie_get);
                            $tableau_position_joueur = get_id_mate($id_partie_get, get_team(get_current_user_id(), $id_partie_get)); // get_position(true);
                            for ($y = 0; $y < 20; $y ++) :
                                ?>
                                <div class=" row ">
        <?php for ($x = 0; $x < 20; $x++): ?> 
                                        <div
                                            class="<?php echo $x ?><?php echo ';' . $y ?> cellule"
                                            onclick="move(this, <?php echo $id_partie_get ?>)">
                                                <?php
                                                foreach ($tableau_position_joueur as $value) {
                                                    if ($x . ";" . $y == $value[1]) {
                                                        echo '<div onclick="display_pseudo_oncell(this, ' . $id_partie_get . ')" id="';
                                                        echo "joueur" . $value[0] . " ";
                                                        echo '"class="';
                                                        foreach ($pos_allies as $value) {
                                                            $all_pos = $value["position"];
                                                            if ($all_pos == $x . ';' . $y) {
                                                                echo $all_pos . " ";
                                                            }
                                                        }
                                                        echo ' text-center perso"> X </div>';
                                                        break;
                                                    }
                                                }
                                                if ($x == 0 && $y == 0) {
                                                    echo "<div class='ville_map'></div>";
                                                }
                                                ?>
                                        </div>
                                <?php endfor; ?>
                                </div>
                                <?php
                            endfor
                            ;
                        }
                        ?>

                    </div>
                </div>


            </div>
        </div>

        <div id="admin">
            <button type="submit" class="btn btn-secondary"
                    onclick="tour_suivant(<?php echo $id_partie_get ?>)">Tour suivant</button>
            <p id="resultat"></p>
        </div>

        <div id="admin2">
            <button type="submit" class="btn btn-secondary"
                    onclick="delete_partie(<?php echo $id_partie_get ?>)">Supprime partie
            </button>
            <p id="resultat"></p>
        </div>

    </body>

</html>
