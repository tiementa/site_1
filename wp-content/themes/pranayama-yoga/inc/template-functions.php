<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pranayama_yoga
*/

if( ! function_exists( 'pranayama_yoga_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
 * @since 1.0.1
*/
function pranayama_yoga_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'pranayama_yoga_doctype', 'pranayama_yoga_doctype_cb' );

if( ! function_exists( 'pranayama_yoga_head' ) ) :
/**
 * Before wp_head
 * 
 * @since 1.0.1
*/
function pranayama_yoga_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;
add_action( 'pranayama_yoga_before_wp_head', 'pranayama_yoga_head' );

if( ! function_exists( 'pranayama_yoga_page_start' ) ) :
/**
 * Page Start
 * 
 * @since 1.0.1
*/
function pranayama_yoga_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'pranayama-yoga' ); ?></a>
    <?php
}
endif;
add_action( 'pranayama_yoga_before_page_start', 'pranayama_yoga_page_start' );

if( ! function_exists( 'pranayama_yoga_header_start' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function pranayama_yoga_header_start(){ ?>
    <header id="masthead" class="site-header" role="banner">       
    <?php 
}
endif;
add_action( 'pranayama_yoga_header', 'pranayama_yoga_header_start', 10 );

if( ! function_exists( 'pranayama_yoga_header_top' ) ) :
/**
 * Header Top
 * 
 * @since 1.0.1
*/
function pranayama_yoga_header_top(){
    $ed_social     = get_theme_mod('pranayama_yoga_ed_social');
    $address       = get_theme_mod('pranayama_yoga_address');
    $phone_text    = get_theme_mod('pranayama_yoga_text');
    $phone_number  = get_theme_mod('pranayama_yoga_phone');

    if( $ed_social || $address || $phone_text || $phone_number ){ ?>
        <div class="header-t">
            <div class="container">
                <?php 
                    if( $address ){ ?>
                        <div class="contact-info">
                            <span class="fa fa-map-marker"></span>
                            <?php echo wp_kses_post( $address ); ?>
                        </div>
                        <?php 
                    } 
                ?>

                <div class="right-panel">
                    <?php 
                    /**
                     * Social Links
                     * 
                     * @hooked 
                    */
                    if( $ed_social ) pranayama_yoga_social_cb();
                    
                    if( $phone_number ){ ?>
                        <div class="contact-number">
                            <span><?php echo esc_html( $phone_text ); ?></span>
                            <a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone_number ) ); ?>"><?php echo esc_html( $phone_number ); ?></a>
                        </div>
                        <?php 
                    } 
                    ?>
                </div>
            </div>
        </div>
    <?php 
    }
}
endif;
add_action( 'pranayama_yoga_header', 'pranayama_yoga_header_top', 20 );

if( !function_exists( 'pranayama_yoga_header_bottom' )):
/**
 * Header Bottom
 * 
 * @since 1.0.1
*/
function pranayama_yoga_header_bottom(){ ?>
    <div class="header-b">
        <div class="container">                 
            <div class="site-branding">                    
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        the_custom_logo();
                    } 
                ?>
                <div class="text-logo">
                    <?php
                    if ( is_front_page() ) : ?>
                      <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                      <?php else : ?>
                          <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                      <?php endif; 

                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                        <?php   
                    endif; ?>
                </div>
            </div><!-- .site-branding -->
            <div class="right-panel">
                <button class="menu-opener" class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="mobile-menu">
                    <nav id="mobile-site-navigation" class="mobile-main-navigation">            
                      <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                          <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>         
                          <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'pranayama-yoga' ); ?>">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-primary-menu', 'menu_class' => 'nav-menu main-menu-modal' ) ); ?>
                          </div>
                      </div>
                    </nav><!-- #mobile-site-navigation -->
                </div>

                <nav id="site-navigation" class="main-navigation" role="navigation">                        
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                </nav><!-- #site-navigation -->
                <div class="btn-search">
                    <button class="search" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
                        <i class="fa fa-search"></i>
                    </button>
                    <div>
                        <div id="formModal" class="modal modal-content header-search-modal cover-modal" data-modal-target-string=".header-search-modal">
                            <?php get_search_form(); ?>
                            <button type="button" class="close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
}
endif;
add_action( 'pranayama_yoga_header', 'pranayama_yoga_header_bottom', 30 );

if( ! function_exists( 'pranayama_yoga_header_end' ) ) :
/**
 * Header End
 * 
 * @since 1.0.1
*/
function pranayama_yoga_header_end(){ ?>
    </header>
    <?php
}
endif;
add_action( 'pranayama_yoga_header', 'pranayama_yoga_header_end', 40 );

if( !function_exists( 'pranayama_yoga_breadcrumbs_cb' ) ):
/**
 * Breadcrumb
*/
function pranayama_yoga_breadcrumbs_cb() {    
    global $post;
    $post_page     = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front    = get_option( 'show_on_front' ); //What to show on the front page
    $ed_breadcrumb = get_theme_mod( 'pranayama_yoga_ed_breadcrumb' );
    $showCurrent   = get_theme_mod( 'pranayama_yoga_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter     = get_theme_mod( 'pranayama_yoga_breadcrumb_separator', __( '>', 'pranayama-yoga' ) ); // delimiter between crumbs
    $home          = get_theme_mod( 'pranayama_yoga_breadcrumb_home_text', __( 'Home', 'pranayama-yoga' ) ); // text for the 'Home' link
    $before        = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after         = '</span>'; // tag after the current crumb
      
    $depth = 1;   
    if ( $ed_breadcrumb ) {
      echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
          if( is_home() && ! is_front_page() ){            
              $depth = 2;
              if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
          }elseif( is_category() ){            
              $depth = 2;
              $thisCat = get_category( get_query_var( 'cat' ), false );
              if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                  $p = get_post( $post_page );
                  echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                  $depth ++;  
              }

              if ( $thisCat->parent != 0 ) {
                  $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                  $parent_categories = explode( ',', $parent_categories );

                  foreach ( $parent_categories as $parent_term ) {
                      $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                      if( is_object( $parent_obj ) ){
                          $term_url    = get_term_link( $parent_obj->term_id );
                          $term_name   = $parent_obj->name;
                          echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                          $depth ++;
                      }
                  }
              }

              if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

          }elseif( is_tag() ){            
              $queried_object = get_queried_object();
              $depth = 2;

              if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
          }elseif( is_author() ){            
              $depth = 2;
              global $author;
              $userdata = get_userdata( $author );
              if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
          }elseif( is_day() ){            
              $depth = 2;
              echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'pranayama-yoga' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'pranayama-yoga' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
              $depth ++;
              echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'pranayama-yoga' ) ), get_the_time( __( 'm', 'pranayama-yoga' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'pranayama-yoga' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
              $depth ++;
              if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'pranayama-yoga' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
               
          }elseif( is_month() ){            
              $depth = 2;
              echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'pranayama-yoga' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'pranayama-yoga' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
              $depth++;
              if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'pranayama-yoga' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
          }elseif( is_year() ){            
              $depth = 2;
              if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'pranayama-yoga' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
          }elseif( is_single() && !is_attachment() ) {              
              //For Post                
              $cat_object       = get_the_category();
              $potential_parent = 0;
              $depth            = 2;
              
              if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                  $p = get_post( $post_page );
                  echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                  $depth++;
              }
              
              if( is_array( $cat_object ) ){ //Getting category hierarchy if any
      
                  //Now try to find the deepest term of those that we know of
                  $use_term = key( $cat_object );
                  foreach( $cat_object as $key => $object ){
                      //Can't use the next($cat_object) trick since order is unknown
                      if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                          $use_term = $key;
                          $potential_parent = $object->term_id;
                      }
                  }
                  
                  $cat = $cat_object[$use_term];
            
                  $cats = get_category_parents( $cat, false, ',' );
                  $cats = explode( ',', $cats );

                  foreach ( $cats as $cat ) {
                      $cat_obj = get_term_by( 'name', $cat, 'category' );
                      if( is_object( $cat_obj ) ){
                          $term_url    = get_term_link( $cat_obj->term_id );
                          $term_name   = $cat_obj->name;
                          echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                          $depth ++;
                      }
                  }
              }
  
              if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
          }elseif( is_page() ){            
              $depth = 2;
              if( $post->post_parent ){            
                  global $post;
                  $depth = 2;
                  $parent_id  = $post->post_parent;
                  $breadcrumbs = array();
                  
                  while( $parent_id ){
                      $current_page  = get_post( $parent_id );
                      $breadcrumbs[] = $current_page->ID;
                      $parent_id     = $current_page->post_parent;
                  }
                  $breadcrumbs = array_reverse( $breadcrumbs );
                  for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                      echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                      if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                      $depth++;
                  }

                  if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
              }else{
                  if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
              }
          }elseif( is_search() ){            
              $depth = 2;
              if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'pranayama-yoga' ) . esc_html( get_search_query() ) . esc_html__( '"', 'pranayama-yoga' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
          }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
              $depth = 2;
              $post_type = get_post_type_object(get_post_type());
              if( get_query_var('paged') ){
                  echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                  echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'pranayama-yoga'), get_query_var('paged') ) . $after;
              }elseif( is_archive() ){
                  echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
              }else{
                  echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
              }              
          }elseif( is_attachment() ){            
              $depth  = 2;
              $parent = get_post( $post->post_parent );
              $cat    = get_the_category( $parent->ID );
              if( $cat ){
                  $cat = $cat[0];
                  echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                  echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
              }
              if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
          }elseif ( is_404() ){
              if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'pranayama-yoga' ) . $after;
          }
          if( get_query_var('paged') ) echo __( ' (Page', 'pranayama-yoga' ) . ' ' . get_query_var('paged') . __( ')', 'pranayama-yoga' );        
          echo '</div>';
    }
}  // end pranayama_yoga_breadcrumbs()
endif;
add_action( 'pranayama_yoga_breadcrumbs', 'pranayama_yoga_breadcrumbs_cb' );

if( ! function_exists( 'pranayama_yoga_page_header' ) ):
/**
 * Page Header 
*/
function pranayama_yoga_page_header(){
    echo '<div id="acc-content">';
    if( ! is_page_template( 'template-home.php' )  ){ ?>
        <div class="top-bar">
            <div class="container">
              <?php 
              if ( ! is_single() ) { ?>
                <div class="page-header">
                    <h1 class="page-title">
                        <?php 
                            if( is_page() ){
                                the_title();
                            }
                                
                            if( is_search() ){ 
                                printf( esc_html__( 'Search Results for: %s', 'pranayama-yoga' ), '<span>' . get_search_query() . '</span>' );
                            }
                            
                            if( is_archive() ){
                                the_archive_title();
                            }
                            
                            if( is_404() ) {
                                printf( esc_html__( '404 - Page not found', 'pranayama-yoga' )); 
                            }

                            if ( is_home() && ! is_front_page() ){
                                single_post_title();
                            }
                        ?>
                    </h1>
                </div>
              <?php }
              do_action( 'pranayama_yoga_breadcrumbs' ); ?>  
            </div>
        </div>
        <div id="content" class="site-content">
            <div class="container">
                <div class="row">
    <?php   
    }
}
endif;
add_action( 'pranayama_yoga_after_header', 'pranayama_yoga_page_header', 10 );

if( ! function_exists( 'pranayama_yoga_page_content_image' ) ) :
/**
 * Page Featured Image
*/
function pranayama_yoga_page_content_image(){
    $sidebar_layout = pranayama_yoga_sidebar_layout();    
    if( has_post_thumbnail() ){
        echo '<div class="post-thumbnail">';
        ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'pranayama-yoga-blog-thumb' ) : the_post_thumbnail( 'pranayama-yoga-blog-full-width-thumb' );    
        echo '</div>';
    }
}
endif;
add_action( 'pranayama_yoga_before_page_entry_content', 'pranayama_yoga_page_content_image' );

if( ! function_exists( 'pranayama_yoga_post_content_image' ) ) :
/**
 * Post Featured Image
*/
function pranayama_yoga_post_content_image(){
    if( has_post_thumbnail() ){ 
        echo is_single() ? '<div class="post-thumbnail">' : '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';    
        
        is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'pranayama-yoga-blog-thumb' ) : the_post_thumbnail( 'pranayama-yoga-blog-full-width-thumb' );    
        
        echo is_single() ? '</div>' : '</a>';
    }        
}
endif;
add_action( 'pranayama_yoga_before_post_entry_content', 'pranayama_yoga_post_content_image', 10 );

if( ! function_exists( 'pranayama_yoga_post_entry_header' ) ) :
/**
 * Post Entry Header
*/
function pranayama_yoga_post_entry_header(){ ?>
    <header class="entry-header">
        <?php
            if( is_single() ){
                the_title( '<h1 class="entry-title">', '</h1>' );
            }else{
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }
        ?>
        <div class="entry-meta">
            <?php 
            if ( 'post' === get_post_type() ){ 
                pranayama_yoga_get_post_meta(); 
            } 
            ?>
        </div>
    </header><!-- .entry-header -->
    <?php
}
endif;
add_action( 'pranayama_yoga_before_post_entry_content', 'pranayama_yoga_post_entry_header', 20 );

if( ! function_exists( 'pranayama_yoga_post_author' ) ) :
/**
 * Author Bio
 * 
*/
function pranayama_yoga_post_author(){
    if( get_the_author_meta( 'description' ) ){ ?>
        <section class="author">
            <div class="img-holder">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 105 ); ?>
            </div>
            <div class="text-holder">
                <span class="name"><?php printf( esc_html__( 'About %s', 'pranayama-yoga' ), esc_html( get_the_author_meta( 'display_name' ) ) ); ?></span>              
                <?php echo wpautop( wp_kses_post ( get_the_author_meta( 'description' ) ) ); ?>
            </div>
        </section>
    <?php  
    }  
}
endif;
add_action( 'pranayama_yoga_after_post_content', 'pranayama_yoga_post_author', 20 );

if( ! function_exists( 'pranayama_yoga_get_comment_section' ) ) :
/**
 * Comment template
*/
function pranayama_yoga_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;
add_action( 'pranayama_yoga_comment', 'pranayama_yoga_get_comment_section' );

if( ! function_exists( 'pranayama_yoga_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.1
*/
function pranayama_yoga_content_end(){
    if(! is_page_template('template-home.php')){
    ?>
                </div><!-- row -->
            </div><!-- .content -->
        </div><!-- #container -->
        
    <?php
    }
}
endif;
add_action( 'pranayama_yoga_after_content', 'pranayama_yoga_content_end', 20 );

if( ! function_exists( 'pranayama_yoga_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.1
*/
function pranayama_yoga_footer_start(){ ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
    <?php
}
endif;
add_action( 'pranayama_yoga_footer', 'pranayama_yoga_footer_start', 10 );

if( ! function_exists( 'pranayama_yoga_footer_top' ) ) :
/**
 * Footer Top
 * 
 * @since 1.0.1
*/
function pranayama_yoga_footer_top(){    
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){ ?>
        <div class="footer-t">
            <div class="row">                
                <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-one' ); ?>    
                    </div>
                <?php } ?>
                
                <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-two' ); ?>    
                    </div>
                <?php } ?>
                
                <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-three' ); ?>  
                    </div>
                <?php } ?>

                <?php if( is_active_sidebar( 'footer-four' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-four' ); ?>   
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php 
    }   
}
endif;
add_action( 'pranayama_yoga_footer', 'pranayama_yoga_footer_top', 20 );

if( ! function_exists( 'pranayama_yoga_footer_bottom' ) ) :
/**
 * Footer Bottom
 * 
 * @since 1.0.1 
*/
function pranayama_yoga_footer_bottom(){
    $copyright = get_theme_mod( 'pranayama_yoga_footer_copyright_text' ); ?>  
    <div class="footer-b">        
        <div class="site-info">
            <?php 
                if( $copyright ){
                    echo wp_kses_post( $copyright );
                }else{ 
                    echo esc_html__( '&copy; Copyright ', 'pranayama-yoga' ) . date_i18n( esc_html__( 'Y', 'pranayama-yoga' ) ); ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>.
                    <?php 
                } 
                
                echo esc_html__( 'Pranayama Yoga | Developed By', 'pranayama-yoga' ); ?>
                <a rel="nofollow" href="<?php echo esc_url( 'https://rarathemes.com' ); ?>" rel="author" target="_blank"><?php echo esc_html__( 'Rara Theme', 'pranayama-yoga' ); ?></a>
                <?php 
                printf( esc_html__( 'Powered by %s', 'pranayama-yoga' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'pranayama-yoga' ) ) .'" target="_blank">WordPress. </a>' );

                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>
        </div>
        <?php 
            $social_footer = get_theme_mod('pranayama_yoga_ed_social_footer');     
            if( $social_footer) pranayama_yoga_social_cb(); 
        ?> 
    </div>
    <?php 
}
endif;
add_action( 'pranayama_yoga_footer', 'pranayama_yoga_footer_bottom', 30 );

if( ! function_exists( 'pranayama_yoga_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.1 
*/
function pranayama_yoga_footer_end(){ ?>
    </div>
    </footer><!-- #colophon -->
    <div class="overlay"></div>
    <?php
}
endif;
add_action( 'pranayama_yoga_footer', 'pranayama_yoga_footer_end', 40 );

if( ! function_exists( 'pranayama_yoga_page_end' ) ) :
/**
 * Page End
 * 
 * @since 1.0.1
*/
function pranayama_yoga_page_end(){ ?>
        </div><!-- #acc-content -->
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'pranayama_yoga_after_footer', 'pranayama_yoga_page_end', 20 );