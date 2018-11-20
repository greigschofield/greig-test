<?php
/**
 * Attachment page
 */
get_header();?>
<div class="full-width-container single-page-header-container">
    <header class="container">
        <h1 class="single-page-heading">
            <?php echo wp_title('',false) !== '' ? wp_title('',false) : get_bloginfo( 'name' ); ?>
        </h1>
        <div class="single-page-breadcrumbs">
            <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
        </div>
    </header>
</div>
<div class="container">
   <div class="row">
        <main role="main" class="full-width-blog-content span12">
            <?php if (have_posts()) : 
                while(have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class("single-with-sidebar-blog-article single-post-content-wrap"); ?>>
                        <?php if ( has_post_thumbnail() )  : ?>
                            <a href="<?php the_permalink() ?>" class="blog-pages-tease-img single-with-sidebar-blog-teaser-img">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        <?php endif;?>
                          <header class="single-with-sidebar-blog-content article-header-container">
                               <div class="meta-info-container">
                                     <div class="meta-info">
                                          <span class="meta-info-buttons download-no"><a href="#" title="Views"><?php echo getPostViews(get_the_ID()) ?></a></span>
                                     </div>
                                     <div class="article-info">
                                          <span class="article-info-buttons publish-date"><a href="<?php the_permalink() ?>"><?php the_time('d/m/Y') ?></a></span>
                                          <span class="article-info-buttons author"><?php the_author_link(); ?></span>
                                          <span class="article-info-buttons tags"><?php the_category(',','single') ?></span>
                                     </div>
                                </div>
                          </header>
                          <div class="article-content ">
                            <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "medium"); ?>
                                <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
                                </p>
                            <?php else : ?>
                                <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                            <?php endif; ?>
                            </div>
                            <div class="entry-caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt() ?></div>
 
                            <?php the_content( __( 'Continue reading <span class="meta-nav">&amp;raquo;</span>', 'your-theme' )  ); ?>
                             

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

                <?php endwhile; ?>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php get_footer(); ?>