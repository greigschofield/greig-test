<li class="news-item clearfix">
    <figure class="media-object">
        
		<?php if(has_post_thumbnail()):?>
        	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
        <?php endif; ?>
        
        <figcaption class="caption clearfix">
            <div class="news-date left">
                <img alt="" src="<?php echo get_template_directory_uri();?>/images/calendar.png" class="icon">
                <a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><?php echo get_the_date(); ?></a>
            </div>
            <div class="news-comments right">
                <img alt="" src="<?php echo get_template_directory_uri();?>/images/comments.png" class="icon">
                <a href="<?php the_permalink(); ?>#comments"><?php comments_number(); ?></a>
            </div>
        </figcaption>
        
    </figure>
    <h5 class="news-title opensans-bold">
        <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h5>
    <p class="news-excerpt opensans">
        <?php the_excerpt(); ?>
    </p>
    <a class="small-btn readmore-btn left" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Read More', AM_THEMES); ?></a>
    <div class="news-tags right">
    	<?php the_tags('<span class="tag-title opensans-bold">Tags: </span><span class="tags">', ', ', '</span>'); ?>
    </div>
</li>