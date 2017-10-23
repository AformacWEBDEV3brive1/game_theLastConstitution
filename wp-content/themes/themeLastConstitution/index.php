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



    </head>

    <body>

        <?php
        //  include 'last_constitution_wp/wp-content/plugins/game_plugin/plugin_controller/process_general.php';
        // echo __FILE__;
        
        
        
        get_template_part("../../plugins/game_plugin/process_general.php");
        
        
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if (is_plugin_active('game_plugin/process_general.php')) {
            echo 'OUIOUI ';
        } else {
            echo 'NONNON ';
        }

        if (function_exists('get_position')) {

            echo 'OUI!';
        } else {
            echo 'NON!';
        }
        $position_joueurs = explode(";", get_position());
        echo(get_position());
        
        $position_x = $position_joueurs[0];
        $position_y = $position_joueurs[1];

        //$ma_position1 = explode(";", get_position(true));
        //$position_a = $ma_position1[0];
        //$position_b = $ma_position1[1];
        ?>




        <h1 class="text-center"> Last Constitution </h1>



        <div class="container">

            <div class="row">
                <div class="col-6">
                    <div id="ville" class="ville">
                        <div class="container">

                            <h2 class="text-center">VILLE</h2>

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


                    </div>
                </div>



                <div class="col-6">
                    <div id="grille" class="">              
                        <?php for ($y = 0; $y < 20; $y++): ?>
                            <div class=" row ">
                                <?php for ($x = 0; $x < 20; $x++): ?> 
                                    <div class="<?php echo 'x= ' . $x ?> <?php echo 'y= ' . $y ?> cellule" onclick="move(this)"> 
                                        <?php
                                        if ($position_x == $x && $position_y == $y) {
                                            echo '<div class="text-center perso"> X </div>';
                                        } 
                                        ////if ($position_a == $x && $position_b == $y) {
                                            //echo '<div class="text-center perso"> O </div>';
                                        //} 
                                        if ($x == 0 && $y == 0) {
                                            echo "<div class='ville_map'></div>";
                                        }
                                        ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div id="chat" class="">

                </div>

                <div id="inventaire_ville">               

                </div>
            </div>
        </div>

    </body>

</html>
