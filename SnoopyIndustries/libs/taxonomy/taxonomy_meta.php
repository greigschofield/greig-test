<?php
$key = '_wpnukes_'.kvalue($term, 'taxonomy').'_'.kvalue($term, 'term_id');

$edit = (kvalue($_GET, 'action') == 'edit') ? true : false;



if(kvalue( kvalue($current_user, 'roles'), '0') == 'administrator')
{

	$image = get_option($key.'_image');?>
    
	
	<?php echo ( $edit ) ? '<tr><th>' : '<div class="form-field">'; ?>
		<label for="author"><?php _e('Image', AM_THEMES); ?> </label>
        <?php if($edit) echo '</th><td>'; ?>
        
		<div id="category_image">
			<?php if( $edit ) echo '<img src="'.$image.'" height="150" width="150" style="display:block;" />'; ?>
        </div>
        
        <input id="upload_image" type="text" name="ad_image" value="<?php echo $image; ?>" style="width:75%;" placeholder="//example.com/image.jpg" /> 
        <a title="<?php _e('Add Media', AM_THEMES); ?>" data-editor="content" class="button upload_image_button" id="insert-media-button" href="javascript:void(0);">
            <?php _e('Add Image', AM_THEMES); ?>
        </a>
        <?php echo ($edit) ? '</td></tr>' : '</div>'; ?>
	<?php
}