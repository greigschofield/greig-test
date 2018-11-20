<?php
/*
  Description: Displays Posts and Comments
  Author: SnoopyIndustries
  Version: 1
 */

class PostsCommentsWidget extends WP_Widget {
	
	 function __construct(){
     	$widget_ops = array('classname' => 'PostsCommentsWidget', 'description' => __('Displays Recent Posts and Comments number.') );
        parent::__construct('PostsCommentsWidget', __('[Cinergy] Recent Posts'), $widget_ops);
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('nr_posts' => 3, 'title' => __('Recent Posts','cinergy')));
        $nr_posts = $instance['nr_posts'];
        $title = $instance['title'];?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">Nr of posts to show: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="title" value="<?php echo esc_attr($title); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('nr_posts'); ?>">Nr of posts to show: <input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="title" value="<?php echo esc_attr($nr_posts); ?>" /></label></p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['nr_posts'] = $new_instance['nr_posts'];
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $nr_posts = empty($instance['nr_posts']) ? 3 : $instance['nr_posts'];
        $title = $instance['title'];
        echo $before_widget . $before_title . $title . $after_title;
        $recent_posts = wp_get_recent_posts(array('post_type'=>'post','numberposts' => $nr_posts));
        foreach ($recent_posts as $recent) : ?>
            <article class="footer-recent-posts">
                <h2 class="footer-recent-posts-heading">
                    <a href="<?php echo get_permalink($recent['ID']) ?>"><?php echo get_the_title($recent['ID']) ?></a>
                </h2>
                <time class="footer-recent-posts-time"><?php echo get_the_time('F jS, Y', $recent['ID'])?></time>
                <span class="footer-recent-posts-comments-number"><a href="<?php echo get_permalink($recent['ID']) ?>"><?php echo get_comments_number( $recent['ID'] ); _e(' Comments','cinergy')?></a></span>
            </article>
        <?php endforeach; 
        echo $after_widget;
    }

}

$register_post_comments = function($name)
{
   return register_widget("PostsCommentsWidget");
};

add_action('widgets_init', $register_post_comments);