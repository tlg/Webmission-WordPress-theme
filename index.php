<?php
	get_header();
	global $woo_options;
?>
    <div id="content" class="col-full">
		<div id="main" class="col-left">

			<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
				<div id="breadcrumb">
					<?php woo_breadcrumbs(); ?>
				</div><!--/#breadcrumbs -->
			<?php } ?>
			<?php 
				// Sub featured area
				if ( isset( $woo_options['woo_sub_featured'] ) && $woo_options['woo_sub_featured'] == 'true' && ! is_paged() ) {
					get_template_part( 'includes/sub-featured' );
				}
			?>

			<div id="latest"<?php if ( isset( $woo_options['woo_home_two_col'] ) && $woo_options['woo_home_two_col'] == 'true' ) echo ' class="two-col"'; ?>>
			
				<h3 class="section"><?php _e( 'Latest News', 'woothemes' ); ?></h3>
				<?php
	   				// Exclude featured posts
	   				global $shownposts; 
	   				if ( get_option( 'woo_exclude' ) != $shownposts && ! is_paged() ) { 
	   					update_option( 'woo_exclude', $shownposts );
	   				}
					
					if ( is_paged() ) {
						$shownposts = get_option( 'woo_exclude' );
					}
					
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(
								'paged'=> $paged,
								'post__not_in' => $shownposts
								);
					
					query_posts( $args );
				?>
		        <?php if ( have_posts() ) { $count = 0; while ( have_posts() ) { the_post(); $count++; ?>
	
		            <!-- Post Starts -->
		            <div <?php if ( $count == 2 ) { post_class('last'); $count = 0; } else { post_class(); } ?>>
	
	                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) woo_image( 'width=' . $woo_options['woo_thumb_w'] . '&height=' . $woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); ?>
		                <?php woo_post_meta(); ?>
		                <h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
		                <div class="entry">
							<?php global $more; $more = 0; ?>
		                    <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
		                </div>
		    			<div class="fix"></div>
	
		                <div class="post-more">
		                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
		                    <span class="read-more"><a class="button" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading', 'woothemes' ); ?></a></span>
		                    <?php } ?>
		                </div>
	
		            </div><!-- /.post -->
	
		        <?php
		        		}
		        	} else {
		        ?>
		            <div class="post">
		                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
		            </div><!-- /.post -->
		        <?php } ?>
				<?php woo_pagenav(); ?>

			</div><!-- /#latest -->
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>