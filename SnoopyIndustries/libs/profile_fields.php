<tr>
    <?php $image = get_user_meta( kvalue( $profile, 'ID' ), '_profile_image', true ); ?>
    <th><label for="user_login"><?php _e('Profile Image', AM_THEMES); ?></label></th>
    <td><div id="category_image">
			<?php echo '<img src="'.$image.'" height="150" width="150" style="display:block;border:1px solid #aaaaaa; padding:2px;" />'; ?>
        </div>
        
        <input id="upload_image" class="regular-text" type="text" name="ad_image" value="<?php echo $image; ?>" placeholder="//example.com/image.jpg" /> 
        <a title="<?php _e('Add Media', AM_THEMES); ?>" data-editor="content" class="button upload_image_button" id="insert-media-button" href="javascript:void(0);">
            <?php _e('Add Image', AM_THEMES); ?>
        </a> 
	</td>
</tr>


<script type="text/javascript">
	jQuery(document).ready(function($) {
    
	  // Uploading files
	  var file_frame;
	 
	  jQuery('.upload_image_button').live('click', function( event ){
	 
		event.preventDefault();
	 
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}
	 
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false  // Set to true to allow multiple files to be selected
		});
	 
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  // We set multiple to false so only get one image from the uploader
		  attachment = file_frame.state().get('selection').first().toJSON();
			$('#upload_image').val(attachment.url);
			$('#category_image').html('<img src="'+attachment.url+'" height="150" width="150" style="display:block;" />');
		  // Do something with attachment.id and/or attachment.url here
		});
	 
		// Finally, open the modal
		file_frame.open();
	  });
	  
	});
</script>