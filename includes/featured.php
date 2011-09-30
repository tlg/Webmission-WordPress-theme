<?php
global $woo_options;
$count = 0;
?>

<div id="slides" class="col-full">

<?php $woo_featured_tags = get_option('woo_featured_tags'); if ( ($woo_featured_tags != '') && (isset($woo_featured_tags)) ) { ?>
    <?php
    	$shownposts = array(); // An array for storing the posts we don't want to display on the homepage (they're in the featured slider already).
		global $shownposts;
		$featposts = 3; // Number of featured entries to be shown
		$feat_tags_array = explode(',',get_option('woo_featured_tags')); // Tags to be shown
        foreach ($feat_tags_array as $tags){
			$tag = get_term_by( 'name', trim($tags), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 )
				$tag_array[] = $tag['term_id'];
		}
    ?>

	<?php $saved = $wp_query; query_posts(array('tag__in' => $tag_array, 'showposts' => $featposts)); ?>
	<?php if (have_posts()) : $count = 0; ?>

	<div id="slides_container" class="col-left">

		<?php while (have_posts()) : the_post(); ?>
		<?php if (!woo_image('return=true')) continue; // Skip post if it doesn't have an image ?>
        <?php $shownposts[] = $post->ID; $count++; ?>

		<div class="slide">

			<?php woo_image("key=image&width=652&height=290"); ?>

			<div class="caption" <?php if ($count == 1) { ?>style="bottom:0"<?php } ?>>
				<span class="post-meta featured-category"><?php the_category(', '); ?></span>
				<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry">
					<p><?php echo woo_text_trim(get_the_excerpt(), 30); ?></p>
				</div>
			</div><!-- /.caption -->

		</div><!-- /.slide -->

		<?php endwhile; ?>

	</div><!-- /#slides_container -->

	<?php endif; ?>

	<div id="slide-nav" class="pagination col-right">

	<?php rewind_posts(); ?>
	<?php if (have_posts()) : $count = 0; ?>
		<ul>
			<?php while (have_posts()) : the_post(); ?>
			<?php if (!woo_image('return=true')) continue; // Skip post if it doesn't have an image ?>
				<li>
					<a href="#">
						<?php woo_image("key=image&width=307&height=96&link=img"); ?>

						<?php $category = get_the_category(); ?>
						<span class="info">
							<span class="post-meta featured-category"><?php echo $category[0]->cat_name; ?></span>
							<span class="title"><?php echo get_the_title(); ?></span>
						</span>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php $wp_query = $saved; ?>

	</div><!-- /#slide-nav -->

     <?php } else { ?>
     	<p class="woo-sc-box info"><?php _e('Please setup Featured Panel tag(s) in your options panel. You must setup tags that are used on active posts.','woothemes'); ?></p>
     <?php } ?>

</div><!-- /#slides -->