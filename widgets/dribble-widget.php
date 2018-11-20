<?php

/* Register the Dribbble widget. */
function Load_Dribbble_Widget() {
	register_widget( 'Widget_Dribbble_Shots' );
}
add_action( 'widgets_init', 'Load_Dribbble_Widget' );

/* Dribbble widget class. */
class Widget_Dribbble_Shots extends WP_Widget {
	
	function __construct() {
		
		$widget_ops = array('classname' => 'widget-dribbble', 'description' => __('Display your Dribbble shots on your site.', 'cinergy' ));
		$control_options = array(
			'width' => 200,
			'height' => 350
		);
        parent::__construct('cinergy-dribbble', __( '[Cinergy Dribbble Footer]', 'cinergy' ), $widget_ops, $control_options);

	}

	/* Outputs the widget based on the arguments input through the widget controls. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Arguments for the widget. */
		$args['limit'] = strip_tags( $instance['limit'] );
		$args['username'] = strip_tags( $instance['username'] );

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		get_template_part( ABSPATH . WPINC . '/feed.php' );

		if ( function_exists( 'fetch_feed' ) ) :
			$rss = fetch_feed('http://dribbble.com/players/' . $args['username'] . '/shots.rss');
			add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
			if ( !is_wp_error( $rss ) ) :
				$items = $rss->get_items( 0, $rss->get_item_quantity( intval( $args['limit'] ) ) );
			endif;
		endif;

		if ( !empty( $items ) ) :
echo '<div class="footer-widget-content footer-follow-on-dribble-widget">';
			foreach ( $items as $item ) :

				$title = $item->get_title();
				$link = $item->get_permalink();
				$date = $item->get_date( 'm/d/Y' );
				$description = $item->get_description();
				preg_match( "/src=\"(http.*(jpg|jpeg|gif|png))/", $description, $image_url );
				$image = $image_url[1];

				

					echo '<a class="dribbble-link" href="' . esc_url( $link ) . '">';
						echo '<img src="' . esc_html( $image ) . '" alt="' . esc_attr( $title ) . '" />';
					echo '</a><!-- .dribbble-link -->';
				

			endforeach;
echo '</div><!-- .dribbble-wrap -->';
		endif;

		/* Close the theme's widget wrapper. */
		echo $after_widget;

	}

	/* Updates the widget control options for the particular instance of the widget. */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['show_shot_title'] = ( isset( $new_instance['show_shot_title'] ) ? 1 : 0 );
		$instance['show_shot_date'] = ( isset( $new_instance['show_shot_date'] ) ? 1 : 0 );

		return $instance;
	}

	/* Displays the widget control options in the Widgets admin screen. */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title' => 'Dribbble',
			'limit' => '1',
			'username' => 'dribbble',
			'show_shot_title' => true,
			'show_shot_date' => true
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<div class="widget-controls">

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'cinergy' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', 'cinergy' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'cinergy' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" type="number" />
			</p>

		</div><!-- .widget-controls -->

	<?php } } ?>