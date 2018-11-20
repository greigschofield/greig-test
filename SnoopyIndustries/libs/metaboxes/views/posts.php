
<div class="form-horizontal">
	<?php //printr($fields); ?>
    <?php foreach( $fields as $k => $v ): ?>
    <?php if( kvalue( $v, 'label')): ?>
        <div class="control-group">
            <label class="control-label" for="<?php echo $k; ?>"><?php echo kvalue($v, 'label'); ?></label>
            <div class="controls">
                <?php echo kvalue($v, 'field'); ?>
                <?php if(kvalue( $v, 'shorthelp' ) ): ?>
                    <p><?php echo kvalue($v, 'shorthelp'); ?></p>
                <?php endif; ?>
            </div>
            
        </div>
    <?php else: echo kvalue($v, 'element'); 
    
	endif; ?>
    <?php endforeach; ?>
</div>