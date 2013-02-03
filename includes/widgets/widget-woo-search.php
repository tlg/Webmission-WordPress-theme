<?php
/*---------------------------------------------------------------------------------*/
/* Search widget */
/*---------------------------------------------------------------------------------*/
class Woo_Search extends WP_Widget {

	function Woo_Search() {
		$widget_ops = array( 'description' => __( 'This is a WooThemes standardized search widget.', 'woothemes' ) );
		parent::WP_Widget( false, __( 'Woo - Search', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
?>
		<?php echo $before_widget; ?>
        <?php if ( $title ) { echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title; } ?>
        <?php get_template_part( 'search', 'form' ); ?>
		<?php echo $after_widget; ?>
   <?php
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$title = esc_attr( $instance['title'] );
?>
       <p>
	   	   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'woothemes' ); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
       </p>
      <?php
	}
}

register_widget( 'Woo_Search' );
?>