jQuery(document).ready(function($)
{	
	jQuery(".delete").click(function() {
		var delid = jQuery(this).attr("id");
		jQuery('#'+delid).parent().remove();

	});

	var custom_data = jQuery('#the-list');
	var count = 0, value = [], count_id = 0, preventMultiRequest = false;

	jQuery("#add_row").live('click' , function(){
			add_row(false, false);
		});
	
	jQuery.each(DYNAMIC, function(id,value)
		{
			count = (count < id) ? parseInt(id) : count;
			add_row(true, value);
		});

	function add_row(append, default_values)
	{ 
			jQuery('#no-record', custom_data).css('display','none');
			if(jQuery('div#custom_urls').find('ul.active').length || jQuery('div#custom_urls').find('ul.edit').length) return false;

			var newhtml = html.replace(/{counter}/gi,++count);
			var myHTML = jQuery(newhtml);

			if(default_values !== false)
			{
				$.each(default_values, function(k, v)
					{
						jQuery(myHTML).find('#'+k).val(v);
					});
			}
			jQuery(myHTML).append('<li><input type="hidden" name="DYNAMIC['+(++count_id)+'][dynamic_id]" id="dynamic_id" value="'+count_id+'" /></li>');
			
			var Switch = jQuery('p.switch',myHTML);
			if(jQuery(Switch).length) //switch button settings
			{
				jQuery('label', Switch).removeClass('selected');
				jQuery('label#'+jQuery('input',Switch).val(),Switch).addClass('selected');
			}
			
			if(append)
			{
				jQuery(custom_data).append(myHTML);
			}
			else
			{
				jQuery('#no-sort').addClass('disabled');
				jQuery('#justborn').append(myHTML);
				jQuery('#justborn > ul').addClass('active');
				jQuery('#justborn > ul').find('div#controls:first').css('display','');
			}
	}
	
	jQuery('ul#inner_ul').find('input,textarea,select').live('focus', function(){
			if(jQuery('div#custom_urls').find('ul.active').length || jQuery('div#custom_urls').find('ul.edit').length ) return false;
			var p = jQuery(this).parents('#inner_ul:first');
			jQuery(p).addClass('edit');
			jQuery(p).find('#controls').css('display','');
		});
	
	jQuery(".cb-enable, .cb-disable").live('click',function(){
			if(jQuery('div#custom_urls').find('ul.active').length || jQuery('div#custom_urls').find('ul.edit').length ) return false;
			var p = jQuery(this).parents('#inner_ul:first');
			jQuery(p).addClass('edit');
			jQuery(p).find('#controls').css('display','');
		});
	jQuery('input#cancel_slide').live('click',function(){	
			var parent = jQuery(this).parents('ul#inner_ul');
			var is_new = jQuery(parent).parent('#justborn').html();
			if(is_new)
			{
				count--;
				jQuery('#no-sort').removeClass('disabled');
				return jQuery(parent).remove();
			}else jQuery(parent).removeClass('edit');
			jQuery('div#controls', parent).css('display','none');
		});
		
	jQuery('input#save_slide').live('click', function(){
			var leng = 0;
			var parent = jQuery(this).parents('#inner_ul:first');
			var is_new = jQuery(parent).parent('#justborn');
			
			jQuery('.errortxt',parent).css('display','none').html('');//clear error message
			jQuery.each(fields, function(k,v)
			{
				if(v == 'required')
				{
					var field = jQuery(parent).find('#'+k+'_input');
					if(field.val() == '' || field.val() == 'required')
					{
						jQuery('.errortxt', parent).append('<span id="'+k+'_error">The field '+k+' is required!</span>').css('display','');
						//jQuery(field).css('background-color','red').val('required');
						leng++;
					}
				}
			});
			
			if(leng === 0)
			{	
				if(undefined == fields.dynamic_id) fields.dynamic_id = 'required';
				var fields_data = {action:'dynamic_settings',current_settings:current_section,subsection:subsection};
				var multicount = 1, err = false;
				jQuery('input[name^="DYNAMIC"],select[name^="DYNAMIC"],textarea[name^="DYNAMIC"]', parent).each(function(){
					var myID = jQuery(this).attr('id');
					if(myID == 'default_value')
					{
						if(jQuery(this).attr('type') == 'checkbox')
						{
							if(jQuery(this).is(':checked')) fields_data.default_value = jQuery(this).val();
						}
						else if(typeof myID == 'string')
						{
							fields_data.default_value = jQuery(this).val();
						}
					}
					else if(myID == 'multivalues')
					{
						if(undefined == fields_data.values){fields_data.values = {};}
						if(jQuery(this).val())
						{
							fields_data['values'][multicount] = jQuery(this).val();
							multicount++;
						}else
						{
							jQuery('.errortxt', parent).append('<span id="error">The values option '+(multicount++)+' is empty!</span>').css('display','');
							err = true;
						} 
					}
					else fields_data[jQuery(this).attr('id')] = jQuery(this).val();
				});
				
				if(err == false)
				{
					$.ajax({
					  type: 'POST',
					  url:ajaxurl,
					  data: fields_data,
					  beforeSend : function()
					  {
							if(preventMultiRequest) return false;
							else preventMultiRequest = true;
					  },
					  success: function(data)
								{
									if(data == 'success')
									{
										if(jQuery('select#form_field', parent))
										{
											var form_field = jQuery('select#form_field',parent);
											jQuery(form_field).replaceWith('<input type="text" class="sbar" id="form_field" value="'+jQuery(form_field).val()+'" name="'+jQuery(form_field).attr('name')+'" disabled="disabled">');
										}
										
										if(is_new.length)
										{
											jQuery('#no-sort').removeClass('disabled');
											jQuery(parent).removeClass('active');
											jQuery(custom_data).append(parent);
											jQuery('#justborn').html('');
										}else jQuery(parent).removeClass('edit');
										
										jQuery('div#controls', parent).css('display','none');
									}else jQuery('.errortxt', parent).append(data).css('display','');
									preventMultiRequest = false;
								},
					});
				}
			}
			return false;
		});
		
	jQuery('#fw_form').live('submit', function(){
			//Contact us page null fix
			$('#the-list ul.tablecont').each(function(){
			    $(this).find(':disabled').removeAttr('disabled'); 
			});
			
			jQuery('#justborn').remove();
		});
		
	jQuery('#delete').live('click', function(e){
		
		if (!confirm("Are you sure to delete this field?")) e.preventDefault();
		else
		{
			var parent = jQuery(this).parents('ul#inner_ul');
			var is_new = jQuery(parent).parent('#justborn').html();
			if(is_new)
			{
				count--;
				jQuery('#no-sort').removeClass('disabled');
				return jQuery(parent).remove();
			}
			
			var dynamic_id = jQuery('input#dynamic_id', parent).val();
			var fields_data = {action:'dynamic_settings',current_settings:current_section,subsection:subsection,'delete':dynamic_id};
			
			count = 0;
			$.ajax({
				  type: 'POST',
				  url:ajaxurl,
				  data: fields_data,
				  beforeSend : function()
				  {
					  	if(preventMultiRequest) return false;
						else preventMultiRequest = true;
				  },
				  success: function(data)
					{
						jQuery(parent).remove();
						jQuery('#no-sort').removeClass('disabled');
						
						if( ! jQuery('#reorder', custom_data).length)
						{
							jQuery('#no-record', custom_data).css('display','block');
						}else
						{
							jQuery("span#reorder").each(function()
							{
								jQuery(this).html((++count));
							});
						}
						
						preventMultiRequest = false;
					},
			});
		}
	});
	
	jQuery("#the-list").sortable({
			axis: 'y',
			//containment: 'parent',
			revert: true,
			update:function(i)
			{
				count = 0;
				jQuery("ul#inner_ul", this).each(function(){
					jQuery(this).find('#reorder:first').html(++count);
				});
			},
	});
				
	jQuery('input[name="slider_source"]').change(function(){
			toggle_settings();
		});
		
	
	if(jQuery('input[name="slider_source"]:checked').val())
	{
		toggle_settings();
	}
	
	function toggle_settings()
	{
		var checked = jQuery('input[name="slider_source"]:checked').val();

		//jQuery('#slider_settings > div.settings').hide();
		//jQuery('#slider_settings > #' + checked).show();
		jQuery('div.settings').hide();
		jQuery('#' + checked).show();
	}
	
	$(".cb-enable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});
});