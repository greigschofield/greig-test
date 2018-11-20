<?php
/*
  Widget Name: Custom Footer Cinergy
  Widget URI: 
  Description: Displays the logo , text and socials
  Author: AM
  Version: 1
 */

class CustomFooter extends WP_Widget {

	 function __construct(){
		 add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
     	$widget_ops = array('classname' => 'CustomFooter', 'description' => __('Displays the logo , text and socials.') );
        parent::__construct('CustomFooter', __('[Cinergy] Custom Footer'), $widget_ops);
    }

	function my_custom_load() {      
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_media();
    } 

	function form($instance) {
		$instance = wp_parse_args((array) $instance, array(
			'title' => '',
			'text' => '',
			'twitter' => '',
			'vimeo' => '',
			'skype' => '',
			'youtube' => '',
			'lin' => '',
			'digg' => ''
			));
		?>

		<p><label>Title:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' )?>" id="<?php echo $this->get_field_id( 'title' )?>" value="<?php echo esc_attr($instance['title'])?>" class="widefat" />
		</p>
		<p><label>Text:</label>
			<textarea type="text" name="<?php echo $this->get_field_name( 'text' )?>" id="<?php echo $this->get_field_id( 'text' )?>" class="widefat" ><?php echo $instance['text']?></textarea>
		</p>
		<p><label>Twitter:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'twitter' )?>" id="<?php echo $this->get_field_id( 'twitter' )?>" value="<?php echo esc_attr($instance['twitter'])?>" class="widefat" />
		</p>
		<p><label>Vimeo:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'vimeo' )?>" id="<?php echo $this->get_field_id( 'vimeo' )?>" value="<?php echo esc_attr($instance['vimeo'])?>" class="widefat" />
		</p>
		<p><label>Skype:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'skype' )?>" id="<?php echo $this->get_field_id( 'skype' )?>" value="<?php echo esc_attr($instance['skype'])?>" class="widefat" />
		</p>
		<p><label>Youtube:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'youtube' )?>" id="<?php echo $this->get_field_id( 'youtube' )?>" value="<?php echo esc_attr($instance['youtube'])?>" class="widefat" />
		</p>
		<p><label>Linkedin:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'lin' )?>" id="<?php echo $this->get_field_id( 'lin' )?>" value="<?php echo esc_attr($instance['lin'])?>" class="widefat" />
		</p>
		<p><label>Digg:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'digg' )?>" id="<?php echo $this->get_field_id( 'digg' )?>" value="<?php echo esc_attr($instance['digg'])?>" class="widefat" />
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['skype'] = $new_instance['skype'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['lin'] = $new_instance['lin'];
		$instance['digg'] = $new_instance['digg'];
		return $instance;
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		echo $before_title;

		if(FOOTER_LOGO) : ?>
			<a href="<?php echo site_url( ); ?>">
				<img src="<?php echo FOOTER_LOGO ?>" alt="footer logo">
			</a>
		<?php elseif(!empty($instance['title'])) :
			echo $instance['title'] ;
		endif;

		echo $after_title;
		?>
		<div class="footer-widget-content">
			<p><?php echo $instance['text'] ?></p>
			<span class="footer-social-icons">
				<?php if(!empty($instance['twitter'])) : ?>
					<a class="twitter-footer" href="<?php echo esc_attr( $instance['twitter'] ); ?>"></a>
				<?php endif; ?>
				<?php if(!empty($instance['vimeo'])) : ?>
					<a class="vimeo-footer" href="<?php echo esc_attr( $instance['vimeo'] ); ?>"></a>
				<?php endif; ?>
				<?php if(!empty($instance['skype'])) : ?>
					<a class="skype-footer" href="<?php echo esc_attr( $instance['skype'] ); ?>"></a>
				<?php endif; ?>
				<?php if(!empty($instance['youtube'])) : ?>
					<a class="youtube-footer" href="<?php echo esc_attr( $instance['youtube'] ); ?>"></a>
				<?php endif; ?>
				<?php if(!empty($instance['lin'])) : ?>
					<a class="lin-footer" href="<?php echo esc_attr( $instance['lin'] ); ?>"></a>
				<?php endif; ?>
				<?php if(!empty($instance['digg'])) : ?>
					<a class="digg-footer" href="<?php echo esc_attr( $instance['digg'] ); ?>"></a>
				<?php endif; ?>
			</span>
		</div>
		<?php
		echo $after_widget;
	}
}

$register_custom_footer = function()
{
   return register_widget("CustomFooter");
};

add_action('widgets_init', $register_custom_footer);
