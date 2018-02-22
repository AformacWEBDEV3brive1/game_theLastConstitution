<!DOCTYPE html>
<?php
/* Template Name: posts */
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
        <h1><b>COMMENTAIRE</b></h1>
        <div class="row">
            <div class="col-md-1 col-lg-12 lobby_espace">
                
            </div>
            
            <div style="margin:auto;">
                <?php
            $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category_name' => 'uncategorized',
                    'posts_per_page' => 5,
                );
                    $arr_posts = new WP_Query( $args );

                    if ( $arr_posts->have_posts() ) :

                        while ( $arr_posts->have_posts() ) :
                            $arr_posts->the_post();
                            ?>
                
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php
                                if ( has_post_thumbnail() ) :
                                    the_post_thumbnail();
                                endif;
                                ?>
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                                </header>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                            </article>
                    
                            <?php
                        endwhile;
                    endif;
                ?>
            </div>
            
        </div>
            <button class="btn"><a href="http://localhost/last%20constitution0.2/wp-admin/post-new.php">postez un commentaire</a></button>
        </center>
    </body>
</html>