<?php
/*
Template Name: Image Gallery
*/
?>

<?php get_header(); ?>
       
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
                                                                            
				<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
				<div id="breadcrumb">
					<?php woo_breadcrumbs(); ?>
				</div><!--/#breadcrumbs -->
			<?php } ?>
            <div class="post">

                <h1 class="title"><?php the_title(); ?></h1>
                
				<div class="entry">

		            <?php if (have_posts()) : the_post(); ?>
	            	<?php the_content(); ?>
		            <?php endif; ?>  

                <?php query_posts('showposts=60'); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
                    <?php $wp_query->is_home = false; ?>

                    <?php woo_image('key=image&width=90&height=90&class=imagegallery alignleft'); ?>
                
                <?php endwhile; endif; ?>	
                </div>
			
			<div class="fix"></div>   
            </div><!-- /.post -->
                         
                                                            
		</div><!-- /#main -->
		
        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>