<!DOCTYPE html>

<?php /**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shape
 * @since Shape 1.0
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Last Constitution </title>

        <!-- libaries css-->
        <link type="text/css" rel="stylesheet" href="wp-content/themes/themeLastConstitution/libraries/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="wp-content/themes/themeLastConstitution/libraries/font-awesome/css/font-awesome.css"/>

        <!-- libraries js -->        
        <script type="text/javascript" src="wp-content/themes/themeLastConstitution/libraries/jQuery/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="wp-content/themes/themeLastConstitution/libraries/tether/dist/js/tether.js"></script>
        <script type="text/javascript" src="wp-content/themes/themeLastConstitution/libraries/bootstrap/js/bootstrap.js"></script>


        <!-- custom css & js -->
        <script type="text/javascript" src="wp-content/themes/themeLastConstitution/custom/js/global.js"></script>
        <link type="text/css" rel="stylesheet" href="wp-content/themes/themeLastConstitution/style.css" />
        <link type="text/css" rel="stylesheet" href="wp-content/themes/themeLastConstitution/sass/style.css" />
    </head>

    <body>

        <?php
        get_template_part("../../plugins/game_plugin/process_general.php");

//        $position_joueurs = explode(";", get_position());
//        //echo(get_position());
//        $position_x = $position_joueurs[0];
//        $position_y = $position_joueurs[1];
//
//        $ma_position1 = explode(";", get_position());
//        // echo get_position();
//        $position_a = $ma_position1[0];
//        $position_b = $ma_position1[1];
//        //print_r(get_id_mate(1, 1));
//        // print_r(get_id_mate(1, 2));
       // echo get_game(get_current_user_id());
        ?>




        <h1 class="text-center"> Last Constitution </h1>

        <div class="container">

            <div class="row">
                <div class="col-6">

                    <div id="menu" class="menu">
                        
                        <div id="onglets" class="row justify-content-around">
                            <button type="submit" class="btn col-2" onclick="show_menu('ville')" > Ville </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('inventaire')" > Etat </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('zone')" > Zone </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('chat')" > Chat </button>
                            
                        </div>
                        <div class="container">

                            <div id="ville"> 
                                <h2 class="text-center"> Ville </h2>
                                <div class="row justify-content-around">
                                    <div class="batiment col-3"> </div>
                                    <div class="batiment col-3"> </div>
                                    <div class="batiment col-3"> </div>

                                </div>

                                <div class="row justify-content-around">
                                    <div class="batiment col-3 "> </div>
                                    <div class="batiment col-3 "> </div>
                                    <div class="batiment col-3 "> </div>

                                </div>

                                <div class="row justify-content-around">
                                    <div class="batiment col-3 "> </div>
                                    <div class="batiment col-3 "> </div>
                                    <div class="batiment col-3"> </div>

                                </div>
                            </div>

                            <div id="inventaire" class="hidden">
                                <h2 class="text-center"> Etat </h2>
                                <div id="pseudo">
                                    <p>Pseudo: 
                                        <?php
                                        $current_user = wp_get_current_user();
                                        echo $current_user->user_login;
                                        ?> 
                                    </p>

                                </div>
                                <div id="points_action">
                                    <p> Vous avez: 
                                        <?php
                                        echo get_points_action(get_current_user_id());
                                        ?> points d'action.
                                    </p>

                                </div>
                                <div id="num_team">
                                    <p> Vous êtes dans l'équipe
                                        <?php
                                        echo get_team(get_current_user_id());
                                        ?> 
                                    </p>
                                </div>
                                <div id="position">
                                    <p>Vous êtes en: 
                                        <?php
                                        echo get_position();
                                        ?>
                                    </p>
                                </div>

                            </div>
                            <div id="zone" class="hidden">
                                <h2 class="text-center"> Zone </h2>
                                <p>CACA</p>
                            </div>

                            <div id="chat" class="hidden">
                                <h2 class="text-center"> Chat </h2>


                            </div>
                            <div id="zone" class="hidden">
                                <h2 class="text-center"> Zone  </h2>
                                <p id="zoneJoueur"></p>
                                    

                            </div>
                        </div>


                    </div>
                </div>



                <div class="col-6">
                    <div id="grille" class="">              
                        <?php
                        $pos = get_position($all = false);
                        $tableau_position_joueur = get_id_mate(get_game(get_current_user_id()), get_team(get_current_user_id()));  //get_position(true);
                        //error_log($tableau_position_joueur);
                        for ($y = 0; $y < 20; $y++):
                            ?>
                            <div class=" row ">
                                <?php for ($x = 0; $x < 20; $x++): ?> 
                                    <div class="<?php echo $x ?><?php echo ';' . $y ?> cellule" onclick="move(this)"> 
                                        <?php
                                             foreach ($tableau_position_joueur as $value){
                                                 if($x . ";" . $y == $value[1]){
                                                     echo '<div onclick="display_pseudo_oncell(this)" id="joueur"';
                                                        if ($pos == $x.';'.$y){
                                                            echo ' class="'.$pos.'';
                                                        }
                                                     echo ' text-center perso"> X </div>';
                                                     break;
                                                 }
                                             }
//                                        if ($position_x == $x && $position_y == $y) {
//                                            echo '<div class="text-center perso"> X </div>';
//                                        }
//                                             if ($position_a == $x && $position_b == $y) {
//                                             echo '<div class="text-center perso"> O </div>';
//                                         } 
//                                        if ($x == 0 && $y == 0) {
//                                            echo "<div class='ville_map'></div>";
//                                        }
                                        ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        <?php endfor; ?>

                    </div>
                </div>

                
            </div>
        </div>
        
        <div id="admin">
            <button type="submit" class="btn btn-secondary" onclick="tour_suivant()" > Tour suivant </button>
            <p id="resultat"></p>
        </div>
    </body>

</html>
