
<!DOCTYPE html>
<?php
/* Template Name: fin-de-partie */
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
    get_template_part("../../plugins/game_plugin/game_minuit.php");
    ?>
    <body>
        <?php
        $team_joueur = get_team(get_current_user_id(), $_GET['id_partie']);
        echo "Vous étiez dans l'équipe " . $team_joueur;
        ?>
        <br/>
        <br/>
        <?php
        $score_equipe_1 = get_points_victoire(1, $_GET['id_partie']);
        $score_equipe_2 = get_points_victoire(2, $_GET['id_partie']);

        echo "Le score de l'équipe 1 est de " . $score_equipe_1;
        ?>
        <br/>
        <?php
        echo "Le score de l'équipe 2 est de " . $score_equipe_2;
        ?>
        <br/>
        <?php
        if ($score_equipe_1 > $score_equipe_2) {
            $victoire = 1;
        } else {
            $victoire = 2;
        }
        ?>
        <br/>
        <?php
        if ($team_joueur == 1 && $victoire == 1 || $team_joueur == 2 && $victoire == 2) {
            echo "VICTOIRE";
        } else {
            echo "DEFAITE";
        }
        ?>
        <br/>
        <p>La partie est finie</p><span><a href='lobby.php'><h4> --> RETOUR AU LOBBY <-- </h4></a></span>
    </body>
</html>