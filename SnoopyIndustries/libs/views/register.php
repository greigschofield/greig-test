<div class="container">
	<div class="sixteen columns register">
    	<div id="response_msg"></div>
		<div class="register">
        	
            
            <?php if( get_option( 'users_can_register' ) ): ?>
                <img class="left" src="<?php echo get_template_directory_uri(); ?>/images/reg-title.png" alt="">
                <div class="left">
                    <form class="fw-submit-login" action="<?php echo admin_url('admin-ajax.php?action=fw_ajax_callback&type=login_register&subaction=register'); ?>" method="post">
                        <h5 class="grey show-res text-center add-bottom"><?php _e('REGISTRATION', AM_THEMES); ?></h5>
                        <input type="text" placeholder="<?php _e('Username', AM_THEMES); ?>" name="user_login" />
                        <div class="valid"></div>
                        <input type="text" value="" placeholder="<?php _e('Email', AM_THEMES); ?>" name="user_email" />
                        <div class="valid"></div>
                        
                        <input class="medium-btn" value="<?php _e('REGISTER', AM_THEMES); ?>" type="submit"/>
                    </form>
                </div>
			<?php endif; ?>
       	
			<div class="left">

                    <form class="fw-submit-login" action="<?php echo admin_url('admin-ajax.php?action=fw_ajax_callback&type=login_register&subaction=login'); ?>" method="post">
                    	
                        <h5 class="grey show-res text-center add-bottom"><?php _e('LOGIN', AM_THEMES); ?></h5>
                        
                        <input type="text" placeholder="<?php _e('Username', AM_THEMES); ?>" value="" name="log" />
                        <div class="valid"></div>
                        
                        <input type="password" value="" name="pwd" />
                        <div class="valid"></div>
    					
                        <input type="hidden" value="<?php echo home_url(); ?>" name="redirect_to" />
	                    <input type="hidden" name="testcookie" value="1" />
                        <input type="submit" class="medium-btn" value="<?php _e('LOGIN', AM_THEMES); ?>"/>
                        
                    </form>
			</div>
            <img class="left" src="<?php echo get_template_directory_uri(); ?>/images/login-title.png" alt="">

			
            <div class="clear"></div>
                        
            
            
         </div>
         <?php if( get_option( 'users_can_register' ) ): ?>
            <div class="twitter-connect">
                <a href="<?php echo home_url(); ?>/?twitter_signin=true" class="medium-btn"><?php _e('Connect with Twitter', AM_THEMES); ?></a>
                <a href="javascript:void(0);" onclick="fblogin();" class="medium-btn facebook"><?php _e('Connect with Facebook', AM_THEMES); ?></a>
            </div>
        <?php endif; ?>
	</div>
</div>