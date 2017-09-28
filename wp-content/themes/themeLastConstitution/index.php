<!DOCTYPE html>


    <?php
/**
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
 */ ?>
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
        //include "wp-content/plugins/game_plugin/plugin_controller/process_general.php";
          //     $ma_position = explode(";", get_position(2));
            //   $position_x = $ma_position[0];
              // $position_y = $ma_position[1];
        ?>
        
        <div class="container">


            <h1 class="text-center"> Last Constitution </h1>
            <div class="row">
                <div class="col-6">
                    <div id="chat" class="">

                    </div>

                    <div id="ville" class="">      

                    </div>
                </div>

                <div class="col-6">
                    <div id="grille" class="">              
                        <?php for ($y = 0; $y < 20; $y++): ?>
                            <div class=" row ">
                                <?php for ($x = 0; $x < 20; $x++):?> 
                                <div class="<?php echo 'x= '.$x ?> <?php echo 'y= '.$y ?> cellule" onclick="move(this)"> 
                                    <?php if ($position_x == $x && $position_y == $y){echo '<div class="text-center perso"> X </div>';} if($x == 0 && $y == 0){echo "<div class='ville'></div>";}?>
                                </div>
                                <?php endfor; ?>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <div id="inventaire_ville">               

                    </div>
                </div>

            </div>
        </div>

    </body>

</html>
