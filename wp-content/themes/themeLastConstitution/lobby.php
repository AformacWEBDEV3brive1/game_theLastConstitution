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
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/global.js"></script>
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/style.css" />
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/sass/style.css" />
    </head>

    <body>

        <?php
        get_template_part("../../plugins/game_plugin/process_general.php");
        ?>

        <h1>C'EST LE LOBBY, ET TOI ?</h1>


        <p> Votre DIVIN nom: 
            <?php echo wp_get_current_user()->user_login; ?>
        </p>

        <p> Vous êtes dans la/les partie(s) <br/>
            <?php
            foreach (get_games(get_current_user_id()) as $value) {
                echo $value[0];
                ?> <br/>
            <?php }
            ?>
        </p>

        <a href="index.php/jeu/" class="btn btn-danger" > GO !</a> // Dirigé vers la page UNIQUE du jeu (a changer car il va y avoir plusieurs parties).
    </body>
</html>