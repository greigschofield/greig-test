<?php $likes = get_post_meta(get_the_ID(), 'cinergy_likes', true); ?>
<article <?php post_class( "2cols-blog-article" ); ?>>
  <?php if ( has_post_thumbnail() )  : ?>
        <a href="<?php the_permalink() ?>" class="single-with-sidebar-blog-teaser-img">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php endif;?>
   <header class="2cols-blog-content article-header-container">
        <div class="meta-info-container">
             <div class="article-info">
                  <span class="article-info-buttons publish-date"><a href="<?php the_permalink() ?>"><?php the_time('d/m/Y') ?></a></span>
                  <span class="article-info-buttons author"><?php the_author_link(); ?></span>
                  <span class="article-info-buttons tags"><?php the_category(',','single') ?></span>
             </div>
        </div>
        <h1 class="article-heading">
             <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
        </h1>
   </header>
   <div class="article-content teaser-content">
        <p class="teaser-content"><?php
              $excerpt = get_the_excerpt();
              if(!empty($excerpt)){
                  the_excerpt();
              }else{
                  the_content('');
              }
          ?></p>
   </div>
   <a href="<?php the_permalink() ?>" class="read-more-button"><?php _ex('Read more','blog','cinergy') ?></a>
</article>