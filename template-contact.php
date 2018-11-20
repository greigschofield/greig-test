<?php
/*
Template Name: Contact
*/
get_header(); 
$contact_settings = get_option(THEME_PREFIX.'contact_page_settings');
$title = $contact_settings['title'] ;
$secondary_title = $contact_settings['secondary_title'] ;
$map = $contact_settings['google_map'] ;
$description = $contact_settings['description'] ;
$categs = !empty($contact_settings['categories']) ? explode(',', trim($contact_settings['categories'])) : FALSE ;
$layout = get_post_meta( $post->ID , 'cinergy_layout' ,true);
$classes = !empty($layout) && $layout === 'full' ? 'span12' : 'contact-with-sidebar span9';
?>

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

<?php if (!empty($map)) : ?>
    <div class="contact-full-teaser-img">
       <?php echo $map ?>
    </div>
<?php endif; ?>
<div class="container contact-full-container">
   <div class="row">
        <main role="main" class="contact-full-content <?php echo $classes ?>">
             <article class="contact-full-article<?php echo $classes == 'contact-with-sidebar span9' ? ' contact-with-sidebar' : '' ?>">
                  <h1 class="article-heading">
                        <?php if(!empty($title)) : ?>
                            <a href="#contact-form"><?php echo $title ?></a>
                        <?php endif; ?>
                        <?php if(!empty($secondary_title)) : ?>
                            <a href="#contact-form"><?php echo $secondary_title ?></a>
                        <?php endif; ?>
                  </h1>
                  <div class="article-content">
                        <?php if(!empty($description)) : ?>
                            <p><?php echo $description ?></p>
                        <?php endif; ?>
                       <div class="contact-form-wrapper">
                            <form id="contact-form" action="send_message">
                                 <label class="hide" for="author"><?php _ex('Full Name','contact','cinergy') ?></label>
                                 <input class="input-fields" id="author" name="author" type="text" placeholder="<?php _ex('Full Name','contact placeholder','cinergy') ?>" value=""/>
                                 <label class="hide" for="email"><?php _ex('Email','contact','cinergy') ?></label> 
                                 <input class="input-fields" id="email" name="email" type="text" placeholder="<?php _ex('Email address','contact placeholder','cinergy') ?>" value=""/>
                                 <?php if($categs) : ?>
                                     <label class="hide" for="select_category"><?php _ex('Choose category','contact','cinergy') ?></label> 
                                     <span id="select-group" class="select-group">
                                          <select name="select_category">
											  <option value="">Choose a category...</option>
                                                <?php foreach($categs as $categ) : ?>
                                                    <option value="<?php echo $categ ?>"><?php echo $categ ?></option>
                                                <?php endforeach; ?>
                                          </select>
                                     </span>
                                <?php endif; ?>
                                 <label class="hide" for="subject_title"><?php _ex('Subject title','contact','cinergy') ?></label> 
                                 <input class="input-fields" id="subject_title" name="subject_title" type="text" placeholder="<?php _ex('Contact number','contact placeholder','cinergy') ?>" value=""/>

                                 <label class="hide" for="comment"><?php _ex('Message','contact','cinergy') ?></label> 
                                 <textarea id="comment" class="input-fields" placeholder="<?php _ex('Comments','contact placeholder','cinergy') ?>" name="comment" cols="40" rows="200"></textarea>
                                 
                                 <input name="submit" type="submit" id="submit-contact-info" class="contact-info-submit form-submit-button" value="<?php _ex('Send message','contact','cinergy') ?>">
                            </form>
                       </div>
                  </div>
             </article>
        </main>
        <?php if (!empty($layout) && $layout != 'full') : ?>
            <aside role="complementary" class="2cols-blog-sidebar span3 hidden-tablet hidden-phone">
                <?php dynamic_sidebar('contact') ?>
            </aside>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php if (have_posts()) : 
            while(have_posts()) : the_post(); ?>

                <?php the_content( ); ?>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>