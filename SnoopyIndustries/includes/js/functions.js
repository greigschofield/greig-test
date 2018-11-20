jQuery(document).ready(function() {
	
	var path = null;
	var mydom = null;
	
	var current_color = '';
	
	jQuery('input[id^="image_button"]').live('click', function(){
	mydom = this;
	 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 return false;
	});
	
	jQuery('h3.clickable').click(function()
	{
		window.location = jQuery('a.optionlink', this).attr('href');
	});

	var count = jQuery('h3[id^="imactive"]').attr('id');
	var selected = parseInt(count.substr(9));

	jQuery( "#paginate-slider2" ).accordion({ autoHeight: false,active: selected });
	 
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery(mydom).parent().find('input:first').val(imgurl);
		tb_remove();
	}
	
	jQuery('#close_message').live('click', function(){
			jQuery(this).parent('div').slideUp('slow');
			jQuery(this).remove();
		});
				
	jQuery(".cb-enable").live('click',function(){
		var parent = jQuery(this).parents('p.switch');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('input', parent).val(jQuery(this).attr('id'));
	});
	jQuery(".cb-disable").live('click',function(){
		var parent = jQuery(this).parents('p.switch');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('input', parent).val(jQuery(this).attr('id'));
	});
	
	jQuery('.fwcolorpicker').ColorPicker({
		color: '#0000ff',
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
			jQuery(el).next('div.colorpreview').css('background-color', '#'+hex);
		},
		onBeforeShow: function () {
			current_color = this;
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb, el) {
			
			jQuery(current_color).val(hex);
			//jQuery(el).ColorPickerHide();
			jQuery(current_color).next('div.colorpreview').css('background-color', '#'+hex);
			
			//jQuery('div.colorpreview').css('background-color', '#'+hex);
			//jQuery('.fwcolorpicker').val(hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	
	jQuery('#importData').click(function(e)
	{
		if (!confirm("Attention: the data import function will replace all of your existing \nadmin panel and widgets settings to default. \n\nstill want to continue?")) e.preventDefault();
	});
});