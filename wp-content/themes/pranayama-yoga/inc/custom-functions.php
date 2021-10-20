<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pranayama_Yoga
*/

if ( ! function_exists( 'pranayama_yoga_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pranayama_yoga_setup() {
    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on Pranayama Yoga, use a find and replace
    * to change 'pranayama-yoga' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'pranayama-yoga', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

        /** Custom Logo */
    add_theme_support( 'custom-logo', array(        
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

        //Add Excerpt support on page
    add_post_type_support( 'page', 'excerpt' );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'pranayama-yoga' ),
    ) );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
    * Enable support for Post Formats.
    * See https://developer.wordpress.org/themes/functionality/post-formats/
    */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'gallery',
        'audio',
        'video',
        'quote',
        'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'pranayama_yoga_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    add_image_size( 'pranayama-yoga-blog-thumb', 750, 450, true);
    add_image_size( 'pranayama-yoga-banner-thumb', 1349, 434, true);
    add_image_size( 'pranayama-yoga-blog-full-width-thumb', 1170, 450, true);
    add_image_size( 'pranayama-yoga-about-thumb', 427, 279, true);
    add_image_size( 'pranayama-yoga-home-classes-thumb', 360, 250, true);
    add_image_size( 'pranayama-yoga-home-trainer-thumb', 360, 400, true);
    add_image_size( 'pranayama-yoga-home-testimonial-thumb', 83, 83, true);
    add_image_size( 'pranayama-yoga-home-blog-thumb', 360, 198, true);
    add_image_size( 'pranayama-yoga-reason-thumb', 59, 59, true);
    add_image_size( 'pranayama-yoga-widgets-thumb', 60, 60, true);
}
endif;
add_action( 'after_setup_theme', 'pranayama_yoga_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pranayama_yoga_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'pranayama_yoga_content_width', 750 );
}
add_action( 'after_setup_theme', 'pranayama_yoga_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function pranayama_yoga_template_redirect_content_width() {

    // Full Width in the absence of sidebar.
    if( is_page() ){
       $sidebar_layout = pranayama_yoga_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1170;
        
    }elseif( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
        $GLOBALS['content_width'] = 1170;
    }

}
add_action( 'template_redirect', 'pranayama_yoga_template_redirect_content_width' );

/**
 * Enqueue scripts and styles.
 */
function pranayama_yoga_scripts() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    wp_enqueue_style( 'pranayama-yoga-google-fonts', pranayama_yoga_fonts_url() );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css' );
    wp_enqueue_style( 'pranayama-yoga-style', get_stylesheet_uri(), array(), PRANAYAMA_YOGA_THEME_VERSION );

    //js added
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'scroll-nav', get_template_directory_uri() . '/js' . $build . '/scroll-nav' . $suffix . '.js', array( 'jquery' ), '3.0.0', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array(), '2.2.1', true );
    wp_enqueue_script( 'owl-carousel-thumb', get_template_directory_uri() . '/js' . $build . '/owl.carousel2.thumbs' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('owl-carousel'), '0.2.1', true );
    wp_enqueue_script( 'jquery-matchHeight', get_template_directory_uri() . '/js' . $build . '/jquery.matchHeight' . $suffix . '.js', array('jquery'), '0.7.2', true );
    wp_enqueue_script( 'pranayama-yoga-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), PRANAYAMA_YOGA_THEME_VERSION, true );
    wp_register_script( 'pranayama-yoga-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), PRANAYAMA_YOGA_THEME_VERSION, true );
    $array = array(
        'rtl' => is_rtl(),
    );

    wp_localize_script( 'pranayama-yoga-custom', 'pranayama_yoga_data', $array );
    wp_enqueue_script( 'pranayama-yoga-custom' );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pranayama_yoga_scripts' );

function pranayama_yoga_customizer_scripts() {    
    wp_enqueue_style( 'pranayama-yoga-customize-style',get_template_directory_uri().'/inc/css/customize.css', '', PRANAYAMA_YOGA_THEME_VERSION );
    wp_enqueue_script( 'pranayama-yoga-admin-js', get_template_directory_uri().'/inc/js/admin.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'pranayama-yoga-customizer-js', get_template_directory_uri() . '/inc/js/customize.js', array('jquery'), PRANAYAMA_YOGA_THEME_VERSION, true  );

    //localizing for templates in the customizer
    $frontpage_url        = get_permalink( get_option( 'page_on_front' ) );
    $array = array(
        'frontpage'          => $frontpage_url,
    );

    wp_localize_script( 'pranayama-yoga-customizer-js', 'py_customizer_data', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'pranayama_yoga_customizer_scripts' );

if( ! function_exists( 'pranayama_yoga_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function pranayama_yoga_admin_scripts(){
    wp_enqueue_style( 'pranayama-yoga-admin', get_template_directory_uri() . '/inc/css/admin.css', '', PRANAYAMA_YOGA_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'pranayama_yoga_admin_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pranayama_yoga_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    
    if( is_404()){
        $classes[] = 'full-width';
    }

     if( !( is_active_sidebar( 'right-sidebar' ) ) ) {
        $classes[] = 'full-width'; 
    }
    
    if( is_page() ){
        $sidebar_layout = pranayama_yoga_sidebar_layout();
        if( $sidebar_layout == 'no-sidebar' )
        $classes[] = 'full-width';
    }

    return $classes;
}
add_filter( 'body_class', 'pranayama_yoga_body_classes' );

if ( ! function_exists( 'pranayama_yoga_excerpt_more' ) ) :
/**
* Replaces "[...]" (appended to automatically generated excerpts) with ... * 
*/
function pranayama_yoga_excerpt_more($more) {
    return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'pranayama_yoga_excerpt_more' );

if ( ! function_exists( 'pranayama_yoga_excerpt_length' ) ) :
/**
* Changes the default 55 character in excerpt 
*/
function pranayama_yoga_excerpt_length( $length ) {
    return is_admin() ? $length : 50;
}
endif;
add_filter( 'excerpt_length', 'pranayama_yoga_excerpt_length', 999 );

/**
 * Flush out the transients used in pranayama_yoga_categorized_blog.
 */
function pranayama_yoga_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 'pranayama_yoga_categories' );
}
add_action( 'edit_category', 'pranayama_yoga_category_transient_flusher' );
add_action( 'save_post',     'pranayama_yoga_category_transient_flusher' );

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'pranayama_yoga_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'pranayama_yoga_custom_css' );
        }
    }
} else {
    // Back-compat for WordPress < 4.7.
    function pranayama_yoga_custom_css(){
        $custom_css = get_theme_mod( 'pranayama_yoga_custom_css' );
        if( ! empty( $custom_css ) ){
        echo '<style type="text/css">';
        echo wp_strip_all_tags( $custom_css );
        echo '</style>';
        }
    }
    add_action( 'wp_head', 'pranayama_yoga_custom_css', 100 );
}

if( ! function_exists( 'pranayama_yoga_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function pranayama_yoga_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'pranayama-yoga' ) : __( 'Name', 'pranayama-yoga' ) );
    $email    = ( $req ? __( 'Email*', 'pranayama-yoga' ) : __( 'Email', 'pranayama-yoga' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'pranayama-yoga' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'pranayama-yoga' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'pranayama-yoga' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'pranayama-yoga' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'pranayama_yoga_change_comment_form_default_fields' );

if( ! function_exists( 'pranayama_yoga_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function pranayama_yoga_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'pranayama-yoga' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'pranayama-yoga' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'pranayama_yoga_change_comment_form_defaults' );

if( ! function_exists( 'pranayama_yoga_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function pranayama_yoga_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'pranayama_yoga_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'pranayama-yoga' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'pranayama-yoga' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=pranayama-yoga-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'pranayama-yoga' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?pranayama_yoga_admin_notice=1"><?php esc_html_e( 'Dismiss', 'pranayama-yoga' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'pranayama_yoga_admin_notice' );

if( ! function_exists( 'pranayama_yoga_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function pranayama_yoga_update_admin_notice(){
    if ( isset( $_GET['pranayama_yoga_admin_notice'] ) && $_GET['pranayama_yoga_admin_notice'] = '1' ) {
        update_option( 'pranayama_yoga_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'pranayama_yoga_update_admin_notice' );