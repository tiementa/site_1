<?php   
/**
*Information Section
*
* @package pranayama_yoga
*/
    $post_one   = get_theme_mod( 'pranayama_yoga_information_post_one' );
    $post_two   = get_theme_mod( 'pranayama_yoga_information_post_two' );
    $post_three = get_theme_mod( 'pranayama_yoga_information_post_three' );
    $post_four  = get_theme_mod( 'pranayama_yoga_information_post_four' );
    
    $info_posts = array( $post_one, $post_two, $post_three, $post_four );
    $info_posts = array_diff( array_unique( $info_posts ), array( '' ) ); ?>
    
    <div class="section-two" id="info_section">
	    <?php  
	    if( $info_posts ):
		    $information_qry = new WP_Query( array(
		            'post__in'   => $info_posts,
		            'orderby'   => 'post__in',
		            'ignore_sticky_posts' => true
		        ));
		    ?>

		    <div class="container">
			    <?php 
				if( $information_qry->have_posts() ){ 
					$i = 0;
			    ?>
				    <div class="row">
					    <ul class="tabs-menu">
							
							<?php 
							while( $information_qry->have_posts() ){ 
								$information_qry->the_post();
								$i++;
							?>
								<li <?php if( $i == 1 ){ echo 'class="current"'; } ?> >
								    <a href="#tab-<?php echo esc_attr( $i ); ?>">
								        <?php the_title(); ?>
								    </a>
								</li>
						    <?php
						    }
                            wp_reset_postdata(); 
						    ?>
					    
					    </ul>
				    	
				    	<div class="tab">
				    	    <?php $j=0;
					        
					        while( $information_qry->have_posts() ){
					            $information_qry->the_post();
					            $j++; 
					        ?>
					    	    <div id="tab-<?php echo esc_attr( $j ); ?>" class="tab-content">
					    	        <h2><?php the_title(); ?></h2>
					    	        <?php  the_content(); ?>
					    	    </div>
				    	
				    	    <?php
				    	    }
                            wp_reset_postdata();
                            ?>  
				    	
				    	</div>
				    	
				    </div>
				<?php 
				} 
				 ?>
	        </div>
        <?php 
        endif; ?>
    </div>