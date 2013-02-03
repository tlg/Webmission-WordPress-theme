<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
		           
			<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
				<div id="breadcrumb">
					<?php woo_breadcrumbs(); ?>
				</div><!--/#breadcrumbs -->
			<?php } ?>

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>
				
				<?php woo_post_meta(); ?>
                <h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                                
                <div class="entry">
                
				<?php echo woo_embed( 'width=580' ); ?>
                <?php if ( $woo_options[ 'woo_thumb_single' ] == "true" && !woo_embed( '')) woo_image( 'width='.$woo_options[ 'woo_single_w' ].'&height='.$woo_options[ 'woo_single_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_single_align' ]); ?>
                
                	<?php the_content(); ?>
                	<?php edit_post_link( __('{ Edit }', 'woothemes'), '<p>', '</p>' ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
				</div>
									
				<?php the_tags('<p class="tags">'.__('Tags: ', 'woothemes'), ', ', '</p>'); ?>
                                
            </div><!-- .post -->

			<?php if ( $woo_options['woo_post_author'] == "true" ) { ?>
			<div id="post-author">
				<div class="profile-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?></div>
				<div class="profile-content">
					<h4><span><?php _e('Author:', 'woothemes'); ?></span><?php echo get_the_author(); ?></h4>
					<?php the_author_meta( 'description' ); ?>
					<div class="profile-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author() ); ?>
						</a>
					</div><!-- #profile-link	-->
				</div><!-- .post-entries -->
				<div class="fix"></div>
			</div><!-- #post-author -->
			<?php } ?>
			
			<?php woo_subscribe_connect(); ?>

			<?php if ( $woo_options[ 'woo_ad_single' ] == 'true' ) { ?>
			<div id="single-ad">
				<?php if ( $woo_options['woo_ad_single_adsense'] != '' ) { echo stripslashes($woo_options['woo_ad_single_adsense']);  } else { ?>
					<a href="<?php echo $woo_options[ 'woo_ad_single_url' ]; ?>"><img src="<?php echo $woo_options['woo_ad_single_image']; ?>" width="468" height="60" alt="advert" /></a>
				<?php } ?>		   	
			</div><!-- /#single-ad -->
			<?php } ?>			

	        <div id="post-entries">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ) ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ) ?></div>
	            <div class="fix"></div>
	        </div><!-- #post-entries -->
            
            <?php $comm = $woo_options['woo_comments']; if ( ($comm == "post" || $comm == "both") ) : ?>
                <?php comments_template('', true); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div class="post">
            	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
			</div><!-- .post -->             
       	<?php endif; ?>  
        
		</div><!-- #main -->

        <?php get_sidebar(); ?>

    </div><!-- #content -->
		
<?php get_footer(); ?>