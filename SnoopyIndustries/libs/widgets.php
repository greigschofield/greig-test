<?php if ( ! defined('ABSPATH')) exit('restricted access'); 

/**
* About_Widget Class
*/
class FW_about extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'about', /* Name */'Ticketrama: About Us', array( 'description' => 'About us widget' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		$default = array('title'=>'About Ticketrama','content'=>'');
		$instance = array_merge($default, (array) $instance);
		extract($args);
		echo $before_widget;
	?>
   
    	<div id="about" class="one-third column">
			<h6 class="half-bottom grey"><?php if($instance['title']) echo $instance['title'];?></h6>
			<p class="opensans grey small remove-bottom"><?php if($instance['content']) echo $instance['content'];?></p>
		</div>
  
	<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = strip_tags($new_instance['content']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$content = isset($instance['content']) ? esc_attr($instance['content']) : '';
	
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:',THEME_NAME); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" ><?php echo $content; ?></textarea>
          
        </p>
	<?php 
	
		
	}

} 

/**
* Contactus_Widget Class
*/
class FW_contact_us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'contact_us', /* Name */'Ticketrama: Contact Us', array( 'description' => 'Contact us widget' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		$default = array('phone'=>'','mobile'=>'','email'=>'');
		$instance = array_merge($default, (array) $instance);
		extract($args);
		echo $before_widget;
		
	?>
    
    	<div id="contact-footer" class="one-third column">
			<ul>
				<li class="opensans-bold grey"><?php if($instance['phone']) echo $instance['phone'];?><?php echo _e(' or ', AM_THEMES)?><?php if($instance['mobile']) echo $instance['mobile'];?></li>
				<li class="opensans-bold grey"><?php if($instance['email']) echo $instance['email'];?></li>
			</ul>
		</div>
  
	<?php
		
		echo $after_widget;
	
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['mobile'] = strip_tags($new_instance['mobile']);
		$instance['email'] = strip_tags($new_instance['email']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$mobile = isset($instance['mobile']) ? esc_attr($instance['mobile']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
	?>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
           <label for="<?php echo $this->get_field_id('mobile'); ?>"><?php _e('Mobile:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" type="text" value="<?php echo $mobile; ?>" />
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
          
        </p>
	<?php 
	}

} // class Feedburner_Widget

/**
* Social_Newletter_Widget Class
*/
class FW_social_newsletter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'social_newsletter', /* Name */'Ticketrama: Social & Newsletter', array( 'description' => 'Show social icons and newletter form' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		$default = array('title'=>'','sub_title'=>'','email'=>'','facebook','gplus','twitte','rss','feedburner_id');
		$instance = array_merge($default, (array) $instance);
		extract($args);
		echo $before_widget;
		
	?>
    
    	<div id="social-footer" class="two-thirds column">
			<div class="left">
				<?php if($instance['title']);?><h6 class="grey"><?php echo $instance['title'];?></h6>
                <?php if($instance['facebook']):?>
					<a href="<?php echo $instance['facebook'];?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/facebook.png" alt="Facebook"></a>
                <?php endif;?>
                <?php if($instance['gplus']):?>
					<a href="<?php echo $instance['gplus'];?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/google-plus.png" alt="Google Plus"></a>
                <?php endif;?>
                <?php if($instance['twitter']):?>
					<a href="<?php echo $instance['twitter'];?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/twitter.png" alt="Twitter"></a>
                <?php endif;?>
                <?php if($instance['rss']):?>
					<a href="<?php echo $instance['rss']; ?>"><img src="<?php echo get_template_directory_uri();?>/images/rss.png" alt=""></a>
                <?php endif;?>
			</div>
			<div class="left">
            
				<?php if($instance['sub_title']);?><h6 class="grey"><?php echo $instance['sub_title']; ?></h6>
				<div>
					
					<form target="popupwindow" action="http://feedburner.google.com/fb/a/mailverify" class="newsletter">
                    	<input class="small-btn right" type="submit" value="<?php echo _e('send', AM_THEMES);?>">
						<input class="newsletter" type="text" value="your email" onblur="if(this.value == '') { this.value='your email'}" onfocus="if (this.value == 'your email') {this.value=''}"/>
						<input type="hidden" value="<?php echo $instance['feedburner_id']; ?>" name="uri" id="uri" />
                    	<input type="hidden" name="loc" value="en_US" />
                    </form>
				</div>
			</div>
		</div>
  
	<?php
		
		echo $after_widget;
	
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['gplus'] = strip_tags($new_instance['gplus']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		$instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$sub_title = isset($instance['sub_title']) ? esc_attr($instance['sub_title']) : '';
		$facebook = isset($instance['facebook']) ? esc_attr($instance['facebook']) : '';
		$gplus = isset($instance['gplus']) ? esc_attr($instance['gplus']) : '';
		$twitter = isset($instance['twitter']) ? esc_attr($instance['twitter']) : '';
		$rss = isset($instance['rss']) ? esc_attr($instance['rss']) : '';
		$feedburner_id = isset($instance['feedburner_id']) ? esc_attr($instance['feedburner_id']) : '';
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Social Network Title:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
            <label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Google Plus URL:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo $gplus; ?>" />
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
         </p>
         <p>
         	<label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php _e('Newsletter Title:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title'); ?>" name="<?php echo $this->get_field_name('sub_title'); ?>" type="text" value="<?php echo $sub_title; ?>" />
            <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner ID:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
         </p>
	<?php 
	}

} // class Feedburner_Widget


class FW_Latest_Topics extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'latest_topics', /* Name */'Ticketrama: Latest Topics', array( 'description' => 'Latest Topics widget' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		global $wpdb, $post; 
		
		$default = array('title'=>'Latest Topics');
		$instance = array_merge($default, (array) $instance);
		extract($args);
		echo $before_widget;
		
		$the_query = new WP_Query( array('post_type' => 'topic', 'status' => 'publish', 'posts_per_page' => kvalue($instance, 'topics_num'), 'order' => 'DESC', 'orderby' => 'ID') );//printr($the_query);
   		$page_template = fw_page_template('tpl-topics.php');//printr($the_query);
	?>
        
        <h5 class="grey bold add-bottom"><?php if($instance['title']) echo $instance['title'];?></h5>
        <?php while($the_query->have_posts()):$the_query->the_post()?>
        
            <div class="sidebar-topics">
                <p class="opensans remove-bottom"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></p>
                <ul class="topics-meta square opensans">
                    <?php if(kvalue($instance, 'show_date')): ?><li><?php echo get_the_date('d/m/Y'); ?></li><?php endif;?>
                    <?php if(kvalue($instance, 'show_comments_count')): ?><li><?php echo kvalue($post, 'comment_count');?><?php echo _e(' comments', AM_THEMES);?></li><?php endif;?>
                </ul>
            </div>
            
        <?php endwhile;?>
        
        	 <?php if(kvalue($instance, 'show_more_topics')): ?><div class="row-more dub-bottom"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/plus.png" class="right"><h6 class="bold white"><a href="<?php echo $page_template->guid; ?>"><?php echo _e('SHOW MORE TOPICS', AM_THEMES); ?></a></h6></div><?php endif;?>
        
		<?php wp_reset_query();?>
  
	<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['topics_num'] = strip_tags($new_instance['topics_num']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		$instance['show_comments_count'] = strip_tags($new_instance['show_comments_count']);
		$instance['show_more_topics'] = strip_tags($new_instance['show_more_topics']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$topics_num = isset($instance['topics_num']) ? esc_attr($instance['topics_num']) : '';
		$show_date = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
		$show_comments_count = isset($instance['show_comments_count']) ? esc_attr($instance['show_comments_count']) : '';
		$show_more_topics = isset($instance['show_more_topics']) ? esc_attr($instance['show_more_topics']) : '';
	
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <label for="<?php echo $this->get_field_id('topics_num'); ?>"><?php _e('Number of Topics:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('topics_num'); ?>" name="<?php echo $this->get_field_name('topics_num'); ?>" type="text" value="<?php echo $topics_num; ?>" />
        </p>    
           	
        <p>	<input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_date == 'true') echo ' checked=checked';?> />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show Date:', AM_THEMES); ?></label></p> 
            
            
        <p> <input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_comments_count'); ?>" name="<?php echo $this->get_field_name('show_comments_count'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_comments_count == 'true') echo ' checked=checked';?> />
        	<label for="<?php echo $this->get_field_id('show_comments_count'); ?>"><?php _e('Show Comments Count:', AM_THEMES); ?></label></p> 
            
        <p> <input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_more_topics'); ?>" name="<?php echo $this->get_field_name('show_more_topics'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_more_topics == 'true') echo ' checked=checked';?> />
        	<label for="<?php echo $this->get_field_id('show_more_topics'); ?>"><?php _e('Show More Topics Link:', AM_THEMES); ?></label> </p>
	<?php 
	
		
	}

} 

class FW_Popular_Topics extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'popular_topics', /* Name */'Ticketrama: Popular Topics', array( 'description' => 'Popular Topics widget' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		global $wpdb, $post; 
		
		$default = array('title'=>'Popular Topics');
		$instance = array_merge($default, (array) $instance);
		extract($args);
		echo $before_widget;
		
		$the_query = new WP_Query( array('post_type' => 'topic', 'status' => 'publish', 'posts_per_page' => kvalue($instance, 'topics_num') , 'orderby' => 'comment_count','order' => 'DESC') );//printr($the_query);
   		$page_template = fw_page_template('tpl-topics.php');//printr($the_query);
	?>
        
        <h5 class="grey bold add-bottom"><?php if($instance['title']) echo $instance['title'];?></h5>
        <?php while($the_query->have_posts()):$the_query->the_post()?>
        
            <div class="sidebar-topics">
                <p class="opensans remove-bottom"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></p>
                <ul class="topics-meta square opensans">
                    <?php if(kvalue($instance, 'show_date')): ?><li><?php echo get_the_date('d/m/Y'); ?></li><?php endif;?>
                    <?php if(kvalue($instance, 'show_comments_count')): ?><li><?php echo kvalue($post, 'comment_count');?><?php echo _e(' comments', AM_THEMES);?></li><?php endif;?>
                </ul>
            </div>
            
        <?php endwhile;?>
        
        	 <?php if(kvalue($instance, 'show_more_topics')): ?><div class="row-more dub-bottom"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/plus.png" class="right"><h6 class="bold white"><a href="<?php echo $page_template->guid; ?>"><?php echo _e('SHOW MORE TOPICS', AM_THEMES); ?></a></h6></div><?php endif;?>
        
		<?php wp_reset_query();?>
  
	<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['topics_num'] = strip_tags($new_instance['topics_num']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		$instance['show_comments_count'] = strip_tags($new_instance['show_comments_count']);
		$instance['show_more_topics'] = strip_tags($new_instance['show_more_topics']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$topics_num = isset($instance['topics_num']) ? esc_attr($instance['topics_num']) : '';
		$show_date = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
		$show_comments_count = isset($instance['show_comments_count']) ? esc_attr($instance['show_comments_count']) : '';
		$show_more_topics = isset($instance['show_more_topics']) ? esc_attr($instance['show_more_topics']) : '';
	
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <label for="<?php echo $this->get_field_id('topics_num'); ?>"><?php _e('Number of Topics:', AM_THEMES); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('topics_num'); ?>" name="<?php echo $this->get_field_name('topics_num'); ?>" type="text" value="<?php echo $topics_num; ?>" />
        </p>    
           	
        <p>	<input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_date == 'true') echo ' checked=checked';?> />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show Date:', AM_THEMES); ?></label></p> 
            
            
        <p> <input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_comments_count'); ?>" name="<?php echo $this->get_field_name('show_comments_count'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_comments_count == 'true') echo ' checked=checked';?> />
        	<label for="<?php echo $this->get_field_id('show_comments_count'); ?>"><?php _e('Show Comments Count:', AM_THEMES); ?></label></p> 
            
        <p> <input style="width:auto; float:left; margin-right:5px;" class="widefat" id="<?php echo $this->get_field_id('show_more_topics'); ?>" name="<?php echo $this->get_field_name('show_more_topics'); ?>" type="checkbox" value="<?php echo "true"; ?>" <?php if($show_more_topics == 'true') echo ' checked=checked';?> />
        	<label for="<?php echo $this->get_field_id('show_more_topics'); ?>"><?php _e('Show More Topics Link:', AM_THEMES); ?></label> </p>
	<?php 
	
		
	}

} 


//About Us widget
add_action('widgets_init', create_function('', 'register_widget("FW_about");' ) );

//Contact Us widget
add_action('widgets_init', create_function('', 'register_widget("FW_contact_us");' ) );

//Social Newsletter widget
add_action('widgets_init', create_function('', 'register_widget("FW_social_newsletter");' ) );

//Latest Topics widget
add_action('widgets_init', create_function('', 'register_widget("FW_latest_topics");' ) );

//Latest Topics widget
add_action('widgets_init', create_function('', 'register_widget("FW_popular_topics");' ) );