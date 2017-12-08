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

        <h1>C'EST LE LOBBY, ET TOI ?</h1>


        <p> Votre ENORME nom: 
            <?php echo wp_get_current_user()->user_login; ?>
        </p>

        <p> Vous êtes dans la/les partie(s) <br/>
            <?php
            foreach (get_games(get_current_user_id()) as $value) {
                echo "Partie : " . $value[0];
                echo "<a href='index.php/jeu?id=" . $value[0] . "' >-->rejoindre partie<--</a><br/>";
            }
            ?>
        </p>

        <?php
        if (isLookingforgame() == true) {
            echo '<button type="button" id="button_recherche" class="btn disabled">RECHERCHE</button>';
            echo "<p id='gamer_mate'> Actuellement " . compteur_get_mate() . " personne(s) recherchent une game</p>";
        } else {
            echo '<button onclick="subscribe_game()" type="button" id="button_recherche" class="btn">RECHERCHE</button>';
            echo "<p id='gamer_mate'></p>";
        }
        ?>

    </body>
</html>
