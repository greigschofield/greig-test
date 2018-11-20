<?php $general_settings = get_option(THEME_PREFIX.'general_settings'); ?>

		
		<!-- START footer.html -->
		<div id="consultation-upsell" class="container">
			<p>Contact us today for a free consultation - <span class="phone">01926 833146</span> or <a href="/contact-full-width/">click here</a><p>
		</div>
		<div class="full-width-container footer-widgets-container clearfix">
			
			
			<footer class="container">
				<div class="row">
					<?php dynamic_sidebar('footer') ?>
				</div>
			</footer>
		</div>
		<footer role="contentinfo" class="container">
			<h2 class="logo-wrap">
				<a href="<?php echo site_url( ); ?>">
				<?php if(COPYRIGHT_LOGO) : ?>
					<img src="<?php echo COPYRIGHT_LOGO ?>" alt="Cinergy" />
				<?php endif; ?>
					<span><?php echo !empty($general_settings['copyright']) ? $general_settings['copyright'] : "&copy; 2014 Cinergy - Creative Business Solutions"?></span>
				</a>
			</h2>
			<nav class="main-nav hidden-tablet hidden-phone" role="navigation">
				<ul>
					<?php wp_nav_menu( array( 
                                'title_li'=>'',
                                'theme_location' => 'footer_menu',
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'fallback_cb' => 'wp_list_pages'
                            ) );?>
				</ul>
			</nav>
		</footer>
		<!--[if lt IE 9]>
			<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php wp_footer(); ?>
	</body>
</html>
<!-- END footer.html -->