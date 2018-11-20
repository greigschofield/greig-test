<?php 

class FW_Metaboxes extends fw_options
{
	var $_config;
	
	function __construct()
	{
		global $pagenow;
		add_action('admin_init', array($this, 'fw_post_meta_box'));
		
		add_action('save_post', array( $this, 'save_post'));
		
	}

	function fw_post_meta_box()
	{
		global $pagenow;

		add_action('admin_print_scripts', array( $this, 'scripts_styles'));
		add_meta_box( 'ticket_settings', __('Ticket Settings', AM_THEMES), array($this, 'post_settings'),
						 'ticket', 'normal',  'core' );
		add_meta_box( 'topic_settings', __('Topic Settings', AM_THEMES), array($this, 'post_settings'),
						 'topic', 'normal',  'core' );

		add_meta_box( 'post_settings', __('Post Settings', AM_THEMES), array($this, 'post_settings'),
						 'post', 'normal',  'core' );
		add_meta_box( 'page_settings', __('Page Settings', AM_THEMES), array($this, 'post_settings'),
						 'page', 'normal',  'core' );
		if($pagenow == 'post.php' || $pagenow == 'post-new.php')
		{
			include(get_template_directory().'/libs/config/posts.php');
			$this->_config = $options;
		}				 
		
	}
	
	function save_post($post_id)
	{
		global $post;
		//printr($_POST);
		$types = array('post', 'page', 'topic', 'ticket');
		$post_type = kvalue($_POST, 'post_type');
	
		if( !in_array( $post_type, $types ) ) return;
		
		$config = kvalue($this->_config, $post_type);
		if( !$config ) return;
		
		$data = array();

		foreach( (array)$config as $k => $v)
		{
			if( kvalue($_POST, $k )) $data[str_replace('webnukes_', '', $k)] = kvalue($_POST, $k );
		}
		
		
		$key = 'wpnukes_'.$post_type.'_settings';
		
		if( $data ) update_post_meta( $post_id, $key, $data);
		if( $data && $post_type == 'ticket' ) update_post_meta( $post_id, 'wpnukes_ticket_status', kvalue( $_POST, 'ticket_status' ) );
		
	}
	
	function scripts_styles()
	{
		global $pagenow, $post_type; //printr($post_type);
		$styles = array('custom_style'=> 'views/css/style.css', 'jqtransform'=>'views/css/jqtransform.css');
		foreach($styles as $k => $v ) wp_register_style( $k, FW_URI . '/libs/'.$v);
		
		if( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			wp_enqueue_style(array('custom_style', 'jqtransform'));
			
			wp_enqueue_script('jqTransform', FW_URI . '/libs/views/js/jquery.jqtransform.js');
		}

	}

	
	function post_settings( $post )
	{	
		global $post_type;
		
		$config = kvalue( $this->_config, $post_type );
		if( !$config ) return;
		
		$format = '';
		//if($post_type == 'wpnukes_videos') $format = 'video';
		//elseif( $post_type == 'wpnukes_audios') $format = 'audio';
		
		$key = 'wpnukes_'.$post_type.'_settings';
		
		$settings = (array)get_post_meta($post->ID, $key, true);
		
		//printr($settings);
		echo $this->generate( $config, $settings );
	}
	
	function generate( $options, $settings)
	{
		
		$data = array();
		//$settings = get_option('wpnukes_video_settings');
		
		foreach( (array)$options as $k=>$v )
		{
			$value = (isset($settings[str_replace('webnukes_', '', $k)])) ? array($k=>$settings[str_replace('webnukes_', '', $k)]) : array($k=>kvalue($v, 'std'));
			$data['fields'][$k] = $this->html_generator($k, $v, $value, true);
			$data['fields'][$k]['label'] = kvalue( $v, 'label' );
		}
		
		extract( $data );
		
		include( get_template_directory().'/libs/views/posts.php' );
	}
	
}

new FW_Metaboxes;