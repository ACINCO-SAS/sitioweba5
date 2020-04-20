<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Asegura_tu_celular
 * @since Asegura tu Celular 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title(''); ?></title>
        <meta name="viewport" content="width=device-width, minimum-scale=1">
        <link rel="stylesheet" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/AseguraTuCel/style.css" type="text/css" />
        <!--<link rel="stylesheet" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/AseguraTuCel/css/fonts/style.css" type="text/css" />-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div class="wrapper-container w100 p0">
            <div class="content-pusher">
            <!-- Start Header -->
                <header id="header-desktop" class="menus block p0 absolut z-index bgrgba1">
                    <div class="container 100 mt1px mb1px">
                        <div class="row">
                            <div id="logo-desktop" class="col-sm-5 logo z-index d-flex">
                                <a class="floatL mr4" href="<?php echo esc_url( network_site_url( '/' ) ); ?>">
                                    <?php
                                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                                        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                        if ( has_custom_logo() ) {
                                                echo '<img src="'. esc_url( $logo[0] ) .'">';
                                        } else {
                                                echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                                        }
                                    ?>
                                </a>
                                <?php 
                                $logoSamsung = get_theme_mod('a5_logosamsung_image');
                                $linkSamsung = get_theme_mod('a5_logosamsung_link');

                                if( $logoSamsung && $linkSamsung ) { ?>
                                <div class="wrap-logo-samsung">
                                    <a href="<?php echo reSiteUrl($linkSamsung); ?>" style="background-image: url('<?php echo $logoSamsung; ?>');"></a>
                                </div>
                                <?php } else {

                                    $id = get_the_id();
                                    $tag_id = get_queried_object()->term_id;
                                    $secondLogoId = get_field('second_logo');
                                    if( $secondLogoId ) {
                                        echo '<div class="wrap-second-logo"><img src="'.wp_get_attachment_url( $secondLogoId ).'" /></div>';

                                    }
                                }
                                ?>
                            </div>
                            <div id="MenuPrincipal" class="col-sm-7 menu-princi">
                                <div>
                                    <div class="rmm sapphire floatR md800" data-menu-style="sapphire">
                                        <?php wp_nav_menu( array(
                                        'menu' => 'Menú Principal', 
                                        'container' => 'nav' )); ?>
                                    </div>
                                    
                                    <div class="menu-mobile-effect navbar-toggle md769" data-effect="mobile-effect">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </div>
                                
                                    <div class="thim-course-search-overlay col-sm-3 floatR md800">
                                        <div class="search-toggle"><i class="fa fa-search fa-2x"></i></div>
                                        <div class="courses-searching layout-overlay">
                                            <div class="search-popup-bg"></div>
                                            <!--<form role="search" method="get" id="searchform" class="searchform" action="<?php echo site_url( '/' ); ?>">
                                                <div class="row">
                                                    <div class="col-xs-10">
                                                        <input type="text" value="" name="s" id="s" placeholder="¿Que deseas buscar?" class="thim-s form-control courses-search-input" autocomplete="off" /></li>	
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input name="submit" type="submit" id="searchsubmit"><i class="fa fa-search"></i></input>
                                                    </div>
                                                    <span class="widget-search-close"></span>
                                                </div>
                                            </form>-->
                                            <ul class="courses-list-search list-unstyled"></ul>
                                            <!--<form role="search" method="get" id="searchform" class="searchform" action="<?php echo site_url( '/' ); ?>">
                                                    <div>
                                                        <label class="screen-reader-text" for="s">Buscar:</label>
                                                        <input type="text" value="hola" name="s" id="s">
                                                        <input type="submit" id="searchsubmit" value="Buscar">
                                                    </div>
                                                </form>-->
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="mobile-menu-container mobile-effect md769">
                    <?php if (is_active_sidebar( 'logo-mobile' )){ ?>
                        <div class="logo-menu-mobile txtac pt6 pb6">
                            <a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php dynamic_sidebar( 'logo-mobile' ); ?>
                            </a>
                        </div>
                    <?php } else{
                        echo '<h1 class="txtac">'. get_bloginfo( 'name' ) .'</h1>';
                    }
                    wp_nav_menu( array(
                        'menu' => 'Menú Principal', 
                        'container' => 'nav' )); ?>
                </div>
            
                <!-- End Header -->
                <div class="wrapper">