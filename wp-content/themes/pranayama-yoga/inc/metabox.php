<?php
/**
 * pranayama_yoga Meta Box
 * 
 * @package pranayama_yoga
 */

 add_action('add_meta_boxes', 'pranayama_yoga_add_sidebar_layout_box');

function pranayama_yoga_add_sidebar_layout_box(){    
    add_meta_box(
        'pranayama_yoga_sidebar_layout', // $id
        __( 'Sidebar Layout', 'pranayama-yoga' ), // $title
        'pranayama_yoga_sidebar_layout_callback', // $callback
        'page', // $page
        'normal', // $context
        'high'// $priority
    );     
}

$pranayama_yoga_sidebar_layout = array(         
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'label' => __( 'Right sidebar (default)', 'pranayama-yoga' ),
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'label'     => __( 'No sidebar', 'pranayama-yoga' ),
        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
    )   
);

function pranayama_yoga_sidebar_layout_callback(){
    global $post , $pranayama_yoga_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'pranayama_yoga_sidebar_layout_nonce' ); 
?>
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'pranayama-yoga' ); ?></em></td>
    </tr>
    <tr>
        <td>
        <?php  
            foreach( $pranayama_yoga_sidebar_layout as $field ){  
                $sidebar_layout = get_post_meta( $post->ID, 'pranayama_yoga_sidebar_layout', true ); ?>

            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_url( $field['label'] ); ?>" /></span><br/>
                    <input type="radio" name="pranayama_yoga_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $sidebar_layout ); if( empty( $sidebar_layout ) ) { checked( $field['value'], 'right-sidebar' ); } ?>/>&nbsp;<?php echo esc_html( $field['label'] ); ?>
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
</table>
<?php        
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function pranayama_yoga_save_sidebar_layout( $post_id ) { 
    global $pranayama_yoga_sidebar_layout; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'pranayama_yoga_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'pranayama_yoga_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
        
    if( 'page' == $_POST['post_type'] ){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }  
    
    $layout = isset( $_POST['pranayama_yoga_sidebar_layout'] ) ? sanitize_key( $_POST['pranayama_yoga_sidebar_layout'] ) : 'right-sidebar';

    if( array_key_exists( $layout, $pranayama_yoga_sidebar_layout ) ){
        update_post_meta( $post_id, 'pranayama_yoga_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, 'pranayama_yoga_sidebar_layout' );
    }     
}
add_action('save_post', 'pranayama_yoga_save_sidebar_layout'); 