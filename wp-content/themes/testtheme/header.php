<!doctype html>
<html>
  <head>
    <title><?php echo wp_title() ?></title>
    <link rel="stylesheet" href="wp-content/themes/testtheme/style.css" type="text/css"/>
  </head>
<body>

<header class="header">

  <div class="container">

    <h1><?php bloginfo() ?></h1>

    <h2><?php bloginfo( 'description' ); ?></h2>

    <?php wp_nav_menu(array('theme_location' => 'main_menu')) ?>

  </div>

</header>

<footer>

  <p><?php _e('Mon premier thème') ?></p>

</footer>

</body>

</html>
