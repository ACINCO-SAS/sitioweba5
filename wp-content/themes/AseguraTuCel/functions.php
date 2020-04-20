<?php

require get_stylesheet_directory().'/customizer.php';
require get_stylesheet_directory().'/services/ClaimsApi.php';

define('A5_IS_PROD', a5getOption('a5cinco_mode_development', 'development') === 'production' || ( defined('WP_DEBUG') && !WP_DEBUG ) );

define('SOURCE_NORMAL_CLAIM','1');
define('SOURCE_SAMSUNG_CLAIM','2');

/*---------------------------------------------------------------------------------*/
add_theme_support( 'title-tag' );

add_theme_support( 'custom-logo' );
function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
/*---------------------------------------------------------------------------------*/
add_theme_support( 'nav-menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'pricipal-menu' => 'Menú Principal',
            'social-menu' => 'Social Menú'
        )
    );
}
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)
    
    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
}
/*---------------------------------------------------------------------------------*/
function asegura_widgets_init() {
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'asegura-tu-celular' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area 1', 'asegura-tu-celular' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'asegura-tu-celular' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area 2', 'asegura-tu-celular' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'asegura-tu-celular' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area 3', 'asegura-tu-celular' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Four Footer Widget Area', 'asegura-tu-celular' ),
        'id' => 'four-footer-widget-area',
        'description' => __( 'The Four footer widget area content copy 4', 'asegura-tu-celular' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Logo Menu Mobile', 'asegura-tu-celular' ),
        'id' => 'logo-mobile',
        'description' => __( 'Logo Menu Mobile', 'asegura-tu-celular' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'asegura_widgets_init' );


/**
 * 
 */
function loadScripts($hook) {
    
    // 
    $themeUri = get_stylesheet_directory_uri();

    /** JS */
    wp_enqueue_script( 'a5_swiper_js', $themeUri.'/js/swiper.js', [], '1.0.0', true );
    wp_enqueue_script( 'a5_toastr_js', $themeUri.'/js/toastr.js', [], '1.0.0', true );

    wp_enqueue_script( 'a5_scripts', $themeUri.'/js/script.js', ['a5_swiper_js'], '1.0.0', true);

    wp_enqueue_script( 'jquery-validate', $themeUri.'/js/jquery.validate.js', ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'jquery-validate-es', $themeUri.'/js/jquery.validate_es.js', ['jquery-validate'], '1.0.0', true );

    /** CSS */
    wp_register_style( 'a5_swiper_css', $themeUri.'/css/swiper.css', false,   '1.0.0' );
    wp_enqueue_style ( 'a5_swiper_css' );


    wp_register_style( 'a5_toastr_css', $themeUri.'/css/toastr.css', false,   '1.0.0' );
    wp_enqueue_style ( 'a5_toastr_css' );

}
add_action('wp_enqueue_scripts', 'loadScripts');

function reSiteUrl($url) {
    $url = str_replace(['{SITE_URL}','{MAIN_SITE}/'],[site_url(),network_site_url()],$url);
    return $url;
}

function registerEndPoints() {
    register_rest_route( 'samsung/v1', '/claims', array(
        'methods' => 'POST',
        'callback' => 'ajaxCreateClaimSamsung',
    ) );

    register_rest_route( 'acinco/v1', '/claims', array(
        'methods' => 'POST',
        'callback' => 'ajaxCreateTraditionalClaim',
    ) );
}
add_action( 'rest_api_init', 'registerEndPoints');

function ajaxCreateClaimSamsung(WP_REST_Request $request) {

    header( 'Access-Control-Allow-Origin:*' );
    header( 'Access-Control-Allow-Headers: Content-Type' );


    $movefile_fr = null;
    $movefile_fc = null;
    $movefile_cc = null;
    $movefile_ip = null;
    $movefile_im = null;

    try {
        $listSources = [SOURCE_NORMAL_CLAIM,SOURCE_SAMSUNG_CLAIM];
        $num_line = $request->get_param('num_line');
        $lastname = $request->get_param('lastname');
        $fullname = $request->get_param('fullname');
        $type_dni = $request->get_param('type_dni');
        $dni = $request->get_param('dni');
        $email = $request->get_param('email');
        $type_request = $request->get_param('type_request');

        $source = $request->get_param('source');
        if( !in_array($source,$listSources) ) {
            $source = SOURCE_NORMAL_CLAIM;
        }

        
        $filesParams = $request->get_file_params();


        if( !function_exists('WP_Filesystem') ) {
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        }

        WP_Filesystem();


        $ipt_fr = $filesParams['ipt_fr'];
        $movefile_fr = a5uploadFile( $ipt_fr, false );
        
        if ( !$movefile_fr ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),__('Formato de reclamación (PDF)','acinco')), 409);
        }

        $ipt_fc = $filesParams['ipt_fc'];
        $movefile_fc = a5uploadFile( $ipt_fc, false );
        
        if ( !$movefile_fc ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),__('Factura (Imagen)','acinco')), 409);
        }

        $ipt_cc = $filesParams['ipt_cc'];
        $movefile_cc = a5uploadFile( $ipt_cc, false );
        
        if ( !$movefile_cc ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),__('Cédula (Imagen)','acinco')), 409);
        }

        $ipt_ip = $filesParams['ipt_ip'];
        $movefile_ip = a5uploadFile( $ipt_ip, false );
        
        if ( !$movefile_ip ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),__('Imagen Pantalla','acinco')), 409);
        }

        $ipt_im = $filesParams['ipt_im'];
        $movefile_im = a5uploadFile( $ipt_im, false );
        
        if ( !$movefile_im ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),__('IMEI (Imagen)','acinco')), 409);
        }

        $description = $request->get_param('description');

        $path_fr = $movefile_fr['file'];
        $path_fc = $movefile_fc['file'];
        $path_cc = $movefile_cc['file'];
        $path_ip = $movefile_ip['file'];
        $path_im = $movefile_im['file'];

        $paramsCreation = array(
            'num_line' => $num_line,
            'lastname' => $lastname,
            'fullname' => $fullname,
            'type_dni' => $type_dni,
            'dni' => $dni,
            'email' => $email,
            'type_request' => $type_request,

            /*
            'path_fr' => $path_fr,
            'path_fc' => $path_fc,
            'path_cc' => $path_cc,
            'path_ip' => $path_ip,
            'path_im' => $path_im,*/

            'description' => $description,
            'source' => $source,

        );

        $filesSupports = array(
            array(
                'path' => $path_fr,
                'type' => $movefile_fr['type'],
            ),
            array(
                'path' => $path_fc,
                'type' => $movefile_fc['type'],
            ),
            array(
                'path' => $path_cc,
                'type' => $movefile_cc['type'],
            ),
            array(
                'path' => $path_ip,
                'type' => $movefile_ip['type'],
            ),
            array(
                'path' => $path_im,
                'type' => $movefile_im['type'],
            ),
        );

        $created = ClaimsApi::create($paramsCreation,$filesSupports);

        if( is_null($created) ) {
            throw new \Exception( __('No fue posible realizar el envio de su trámite o reclamación.','acinco'), 409 );
        }


        a5deleteFile( null, $movefile_fr ? $movefile_fr['file'] : null );
        a5deleteFile( null, $movefile_fc ? $movefile_fc['file'] : null );
        a5deleteFile( null, $movefile_cc ? $movefile_cc['file'] : null );
        a5deleteFile( null, $movefile_ip ? $movefile_ip['file'] : null );
        a5deleteFile( null, $movefile_im ? $movefile_im['file'] : null );

        return new WP_REST_Response( json_decode($created), 201 );
    } catch(\Exception $e) {

        a5deleteFile( null, $movefile_fr ? $movefile_fr['file'] : null );
        a5deleteFile( null, $movefile_fc ? $movefile_fc['file'] : null );
        a5deleteFile( null, $movefile_cc ? $movefile_cc['file'] : null );
        a5deleteFile( null, $movefile_ip ? $movefile_ip['file'] : null );
        a5deleteFile( null, $movefile_im ? $movefile_im['file'] : null );

        return new WP_REST_Response( array(
            'message' => $e->getMessage(),
        ), $e->getCode() );
    }
}


function ajaxCreateTraditionalClaim(WP_REST_Request $request) {

    header( 'Access-Control-Allow-Origin:*' );
    header( 'Access-Control-Allow-Headers: Content-Type' );


    $filesSupports = [];

    try {
        $listSources = [SOURCE_NORMAL_CLAIM,SOURCE_SAMSUNG_CLAIM];
        $num_line = $request->get_param('num_line');
        $lastname = $request->get_param('lastname');
        $fullname = $request->get_param('fullname');
        $type_dni = $request->get_param('type_dni');
        $dni = $request->get_param('dni');
        $email = $request->get_param('email');
        $type_request = $request->get_param('type_request');
        $description = $request->get_param('description');

        $source = $request->get_param('source');
        if( !in_array($source,$listSources) ) {
            $source = SOURCE_NORMAL_CLAIM;
        }

        
        $filesParams = $request->get_file_params();


        if( !function_exists('WP_Filesystem') ) {
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        }

        WP_Filesystem();


        foreach($filesParams as $file) {
            $movefile = a5uploadFile( $file, false );
            if ( !$movefile ) {
                throw new \Exception( __( 'El archivo de tiene alguna incosistencia. Verifique el tamaño del archivo e itente nuevamente', 'acinco'), 409);
            }
            $pathFile = $movefile['file'];
            $filesSupports[] = array(
                'path' => $pathFile,
                'type' => $movefile['type'],
            );
        }
        
        $paramsCreation = array(
            'num_line' => $num_line,
            'lastname' => $lastname,
            'fullname' => $fullname,
            'type_dni' => $type_dni,
            'dni' => $dni,
            'email' => $email,
            'type_request' => $type_request,

            'description' => $description,
            'source' => $source,
        );


        $created = ClaimsApi::create($paramsCreation,$filesSupports);

        if( is_null($created) ) {
            throw new \Exception( __('No fue posible realizar el envio de su trámite o reclamación.','acinco'), 409 );
        }

        foreach($filesSupports as $fileSupport) {
            a5deleteFile( null, $fileSupport['path'] );
        }

        return new WP_REST_Response( json_decode($created), 201 );
    } catch(\Exception $e) {

        foreach($filesSupports as $fileSupport) {
            a5deleteFile( null, $fileSupport['path'] );
        }

        return new WP_REST_Response( array(
            'message' => $e->getMessage(),
        ), $e->getCode() );
    }
}


function a5getOption($key, $default = '') {
	/**
	 * If Exist is used get_custom function from plugin: Custom Options Plus
	 * See: https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus
	 */
	if(defined('COP_PLUGIN_VERSION')) {
		$val = get_custom($key);
		return $val ? $val : $default;
	}
	return get_option($key,$default);
}

function a5error($errorText, $message = null) {
    if( A5_IS_PROD ) {
        return $message ? $message : __('Ocurrió un error en nuestros sistemas. Intente nuevamente, si la falla persiste comuníquese con nosotros.', 'acinco');
    }
    return $errorText;
}
function a5deleteFile($attachment_id = null, $pathFile = null) {

    if( $attachment_id ) {
        wp_delete_attachment($attachment_id, true);
    }

    if( $pathFile ) {
        wp_delete_file_from_directory($pathFile, '');
    }
}

function a5uploadFile($fileToUpload, $createAttach = true) {

    $upload_id = null;
    $movefile = null;
    try {
        if( !function_exists('WP_Filesystem') ) {
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        }
    
        WP_Filesystem();
        
        if( $fileToUpload['size'] > wp_max_upload_size() ) {
            throw new \Exception( sprintf(__( 'El archivo de "%s" excede el peso permitido.', 'acinco'),$fileToUpload['name']), 409);
        }

        $movefile = wp_handle_upload( $fileToUpload, array( 'test_form' => false ) );
    
        if ( !($movefile && !isset( $movefile['error'] )) ) {
            throw new \Exception(a5error($movefile['error'], sprintf(__( 'El archivo de "%s" tiene alguna incosistencia. Itente nuevamente.', 'acinco'),$fileToUpload['name'])), 409);
        }
    
        $new_file_mime = $movefile['type'];
    
        if( !in_array( $new_file_mime, get_allowed_mime_types() ) ) {
            throw new \Exception( sprintf(__( 'Este tipo de archivos no estan permitidos: "%s"', 'acinco'),$fileToUpload['name'].' - '.var_export($new_file_mime,true)), 409);
        }
    
    
        if( $createAttach ) {
            $wordpress_upload_dir = wp_upload_dir();
            
            $upload_id = wp_insert_attachment( array(
                'guid'           => $movefile['file'], 
                'post_mime_type' => $new_file_mime,
                'post_title'     => preg_replace( '/\.[^.]+$/', '', sanitize_title($fileToUpload['name']) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ), $movefile['file'] );
        
            if( !function_exists('wp_generate_attachment_metadata') ) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
            }
            
        
            // Generate and save the attachment metas into the database
            if( !wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) ) ) {
                throw new \Exception(a5error(__( 'No se encontro valido el ID del archivo subido.', 'acinco')), 409);
            }
        }
    
        return $movefile;
    } catch (\Exception $e) {
        a5log( $e->getMessage() );
        //a5deleteFile($upload_id,$movefile ? $movefile['file'] : null);
        return null;
    }
}
function a5log($message) {
    if( A5_IS_PROD ) {
        return;
    }
    if( is_writable(get_stylesheet_directory()) ) {
        file_put_contents(get_stylesheet_directory().'/a5logs.log',(is_string($message) ? $message : '<pre>'.var_export( $message ,true).'</pre>')."\n",FILE_APPEND);
    }
}
?>