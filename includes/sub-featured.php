<?php global $woo_options; ?>

<h3 class="section"><?php if ( $woo_options['woo_sub_featured_title'] ) echo $woo_options['woo_sub_featured_title']; else _e('Spotlight', 'woothemes'); ?></h3>

<!-- SUB FEATURED SECTION -->
<?php if ( $woo_options['woo_sub_featured_tags'] != '' ) : ?>

    <?php
    	$tag_array = array();
		$feat_tags_array = explode( ',', $woo_options['woo_sub_featured_tags'] ); // Tags to be shown
        foreach ($feat_tags_array as $tags){
			$tag = get_term_by( 'name', trim($tags), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 )
				$tag_array[] = $tag['term_id'];
		}
    ?>

	<?php if ( !empty( $tag_array ) ) : ?>
		<?php
			global $shownposts;
			$saved = $wp_query;
			$entries = $woo_options['woo_sub_featured_entries'];
			if ( $entries == '' )
				$entries = 3;

			query_posts(array('tag__in' => $tag_array, 'post__not_in' => $shownposts, 'showposts' => $entries));
		?>
	    <?php if (have_posts()) : $count = 0; ?>
	    <?php while (have_posts()) : the_post(); $count++; ?>
        <?php $shownposts[] = $post->ID; ?>

	        <div class="post block<?php if ( $count == 3 ) echo ' last'; ?> sub-featured">

	           	<?php woo_image('width=192&height=100&class=thumbnail aligncenter'); ?>
	            <?php woo_post_meta(); ?>
	            <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

	            <div class="entry">
	                <?php echo woo_text_trim( get_the_excerpt(), '12'); ?>
	            </div>

	        </div><!-- /.post -->

	        <?php if ( $count == 3 ) { echo '<div class="fix"></div>'; $count = 0; } ?>

	    <?php endwhile; else: ?>

	        <div class="post">
	            <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
	        </div><!-- /.post -->

	    <?php endif; ?>
		<?php $wp_query = $saved; ?>
		<div class="fix"></div>

	<?php else: ?>

		<p class="woo-sc-box info"><?php _e('No tags found','woothemes'); ?></p>

	<?php endif; ?>

<?php else: ?>

	<p class="woo-sc-box info"><?php _e('Please setup Sub Featured Panel tag(s) in your options panel. You must setup tags that are used on active posts.','woothemes'); ?></p>

<?php endif; ?>
<!-- /SUB FEATURED SECTION -->
