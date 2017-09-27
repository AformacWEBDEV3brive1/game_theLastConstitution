<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Last Constitution </title>

        <!-- libaries css
        <link type="text/css" rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="libraries/font-awesome-4.7.0/css/font-awesome.css"/>-->
	<link rel="stylesheet" href="wp-content/themes/themeLastConstitution/librairies/bootstrap/css/bootstrap.css" type="text/css"/>

        <!-- libraries js     

        <script type="text/javascript" src="libraries/jQuery/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="libraries/tether/dist/js/tether.js"></script>
        <script type="text/javascript" src="libraries/bootstrap/js/bootstrap.js"></script>--> 
        

        <!-- custom css & js -->  
        <!--<script type="text/javascript" src="global.js"></script>
        <script type="text/javascript" src="personnage.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css" />-->
	
	<script type="text/javascript" src="wp-content/themes/themeLastConstitution/js/global.js"></script>
	<link rel="stylesheet" href="wp-content/themes/themeLastConstitution/style.css" type="text/css"/>

    </head>

    <body>
        <div class="container">


            <h1 class="text-center"> Last Constitution </h1>
            <div class="row">
                <div class="col-6">
                    <div id="chat" class="ville">

                    </div>

                    <div id="ville" class="ville">      

                    </div>
                </div>

                <div class="col-6">
                    <div id="grille" class="">              
                        <?php for ($y = 0; $y < 20; $y++): ?>
                            <div class="row <?php echo 'colonne_'.$y ?>">
                                <?php for ($x = 0; $x < 20; $x++):?> 
                                    <div class="cellule <?php echo 'ligne_'.$x ?>" onclick="move(this)"></div>
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
