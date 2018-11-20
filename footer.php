<?php $general_settings = get_option(THEME_PREFIX.'general_settings'); ?>

		
		<!-- START footer.html -->
		<div id="consultation-upsell" class="container">
			<p>Contact us today for a free consultation - <span class="phone">01926 833146</span> or <a href="/contact/">click here</a></p>
		</div>
		
		
		<!-- Signup here -->
		<a name="signup-form"></a>
		<div id="gwd-signup-wrapper" class="container">
			<h2>Signup for News and Updates from Groundwater Dynamics</h2>
			<div id="cf-feedback">
				<div class="msg">
					
				</div>
			</div>
			<form id="signup-form">
				<div class="item">
					<label for="signup-name">Your Name</label>
					<input type="text" placeholder="*Your name" id="signup-name" name="cm-name"/>
				</div>
				<div class="item">
					<label for="signup-email">Your Email</label>
					<input type="text" placeholder="*Your email address" id="signup-email" name="cm-alkhjj-alkhjj"/>
				</div>
				<div class="item cf">
					<input type="submit" value="Signup"/>
				</div>
			</form>
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
				<a href="<?php echo site_url( ); ?>"><span class="copyright"><?php echo !empty($general_settings['copyright']) ? $general_settings['copyright'] : "&copy; 2014 Cinergy - Creative Business Solutions"?></span></a>
				<a href="http://www.chemicalcode.com/"><span class="credit">Website designed and developed by Chemical Code Ltd.</span></a>
				
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
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php wp_footer(); ?>
	</body>
</html>
<!-- END footer.html -->