<!DOCTYPE html>
<?php
/* Template Name: lobby */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Last Constitution </title>

        <!-- libaries css-->
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/libraries/font-awesome/css/font-awesome.css"/>

        <!-- libraries js -->        
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/libraries/jQuery/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/libraries/tether/dist/js/tether.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/js/bootstrap.js"></script>


        <!-- custom css & js -->
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/lobby.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/global.js"></script>
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/style.css" />
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/sass/style.css" />
    </head>

    <body>

        <?php
        get_template_part("../../plugins/game_plugin/process_general.php");

        if (!is_user_logged_in()) {
            wp_redirect(home_url());
            exit;
        }
        ?>
        <center class="container">
        <h1><b>LOBBY</b></h1>
        <div class="row">
        <div class="col-md-5 col-lg-12 lobby_metal">
            <p> Votre nom: 
                <?php echo wp_get_current_user()->user_login; ?>
            </p>
            <p> Votre id: 
                <?php echo wp_get_current_user()->id; ?>
            </p>
        </div>
            <div class="col-md-1 col-lg-12 lobby_espace">
                
            </div>
            <div class="offset-md-1 offset-lg-0 col-md-5 col-lg-12 lobby_metal">
        <p> Vous êtes dans la/les partie(s) <br/>
            <?php
            foreach (get_games(get_current_user_id()) as $value) {
                echo "Partie : " . $value[0];
                echo "<a href='index.php/jeu?id=" . $value[0] . "' >-->rejoindre partie<--</a><br/>";
            }
            ?>
        </p>
        </div>
        </div>
        <?php
        if (isLookingforgame() == true) {
            echo '<button type="button" id="button_recherche" class="btn disabled">RECHERCHE</button><img src="../../wp-content/themes/themeLastConstitution/images/loader.gif" heigth="20px" width="20px" />';
            echo "<p id='gamer_mate'> Actuellement " . compteur_get_mate() . " personne(s) recherche(nt) une game</p>";
        } else {
            echo '<button onclick="subscribe_game()" type="button" id="button_recherche" class="btn">RECHERCHE</button><img id="spinner" class="invisible" src="../../wp-content/themes/themeLastConstitution/images/loader.gif" heigth="20px" width="20px"/>';
            echo "<p id='gamer_mate'></p>";
        }
        ?>
            <div>
                <button id="com" class="btn"><a href="http://localhost/last%20constitution0.2/index.php/commentaire/">Lire les avis !</a></button>
            </div>
        </center>
    </body>
</html>
