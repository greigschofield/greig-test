<?php get_header(); 
$general_settings = get_option(THEME_PREFIX.'general_settings');
?>

<div class="full-width-container fof-wrapper">
   <div class="container">
        <main role="main" class="fof-full-content span12">
             <article class="fof-full-article">
                  <h1 class="article-heading fof-heading">
                       <a href="<?php echo site_url() ?>"><?php _ex('You just got 404\'d!','404 page','cinergy')?></a>
                       <a href="<?php echo site_url() ?>"><?php _ex('Oh snap, it looks like we are missing a piece!','404 page','cinergy')?></a>
                  </h1>
                  <div class="fof-content">
                       <div class="fof-button">
                            <a href="<?php echo site_url( ); ?>"><?php _ex('Please, search our website','404 page','cinergy')?></a>
                       </div>
                  </div>
             </article>
        </main>
   </div>
</div>
<?php if(!empty($general_settings['404_background'])) : ?>
    <style type="text/css">
        .fof-wrapper{
            background: url('<?php echo $general_settings["404_background"] ?>');
        }
    </style>
<?php endif; ?>
<?php get_footer(); ?>