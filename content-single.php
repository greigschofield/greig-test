<?php $likes = get_post_meta(get_the_ID(), 'cinergy_likes', true); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("single-with-sidebar-blog-article single-post-content-wrap"); ?>>
    <?php if ( has_post_thumbnail() )  : ?>
            <?php the_post_thumbnail(); ?>
    <?php endif;?>
      <header class="single-with-sidebar-blog-content article-header-container">
           <div class="meta-info-container">
                 <div class="article-info">
                      <span class="article-info-buttons publish-date"><a href="<?php the_permalink() ?>"><?php the_time('d/m/Y') ?></a></span>
                      <span class="article-info-buttons author"><?php the_author_link(); ?></span>
                      <span class="article-info-buttons tags"><?php the_category(',','single') ?></span>
                 </div>
            </div>
           <h1 class="article-heading">
                <a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a>
           </h1>
      </header>
      <div class="article-content ">
           <?php the_content( ); ?>
           <div class="post_tags">
                 <?php the_tags(__('Tags : ','cinergy'),',') ?>
           </div>
      </div>
      
            <?php wp_link_pages(array(
                'before'           => '<div class="pagination-tabs"><ul class="pagination-list">',
                'after'            => '</ul></div>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => '</li><li>',
                'nextpagelink'     => __( 'Next page','cinergy' ),
                'previouspagelink' => __( 'Previous page','cinergy' ),
                'pagelink'         => '%',
                'echo'             => 1
            )); ?>
</article>
<?php setPostViews(get_the_ID()) ?>