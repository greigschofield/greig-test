<?php //printr( $return ); ?>

<div class="container">
	<div class="sixteen columns">
    	
        <form class="submit-ticket <?php if(is_user_logged_in()) echo " loggedin";?>" method="post" action="<?php echo kvalue( $return, 'form_action'); ?>">
            <div id="response_msg">
				<?php if( $msg = kvalue( $return, 'msg')):
                    foreach( (array) $msg  as $m ):?>
                    <div class="alert alert_<?php echo kvalue( $m, 'type' ); ?>"><?php echo kvalue( $m, 'msg' ); ?></div>
                <?php endforeach;
                endif; ?>
            </div>
			<div class="left">
				<?php foreach( $return as $k => $v ): ?>
                	<?php echo kvalue( $v, 'field'); ?>
                <?php endforeach; ?>
			</div>
			<div class="submit">
            
            	<button type="submit" class="button-transparent">
				<h3 class="coral bold">SUBMIT TICKET</h3>
				<div class="cross" data-alt="<?php echo get_template_directory_uri();?>/images/ajax-loader.gif">
					<img alt="" src="<?php echo get_template_directory_uri();?>/images/plus-big.png">
				</div>
                </button>
			</div>
		</form>
	</div>
</div>