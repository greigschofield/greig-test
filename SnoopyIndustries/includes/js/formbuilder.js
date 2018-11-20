jQuery(document).ready(function()
{	
	var count_id = 1;
	var vcounter = 1;
	jQuery.each(DYNAMIC, function(id,value)
	{
		var parent = jQuery('ul#the-list > ul#inner_ul').eq(id);
		var counter = jQuery(parent).find('#reorder').text();
		var rightlist = jQuery(parent).find('li.rightlist');
		var html = generate_html(html, value.type, counter,value);
		jQuery(rightlist).html('<input type="text" class="sbar" id="form_field" value="'+value.type+'" name="DYNAMIC['+counter+'][form_field]" disabled="disabled">');
		jQuery('li.setting',parent).append(html+'</div>');
	});
		
	jQuery('#fw_form').submit(function(){

			if( ! jQuery('#the-list').find('input:disabled[value="usr_name"]').length || ! jQuery('#the-list').find('input:disabled[value="email_addr"]').length)
			{
				if ( ! confirm("The mandatory fields 'Name' and 'Email Address' are missing, continue anyway?"))
				{
					jQuery('#add_row').trigger('click');
					return false;
				}
			}

			jQuery('#form_field', this).removeAttr('disabled')
		});
		
	jQuery('select#form_field').live('change', function()
	{
		var counter = jQuery(this).parents('ul#inner_ul').find('#reorder').text(), parent = jQuery(this).parents('li.setting');
		jQuery('#dynamic_fields', parent).remove();
		
		var html = generate_html(html, jQuery(this).val(), counter,{});
		jQuery(parent).append(html);
	});
	
	function generate_html(html, type, counter, defaults)
	{
		var label = (defaults.label) ? defaults.label : '', std = (defaults.std) ? defaults.std : '', values = (defaults.value) ? defaults.value : '', isrequired = (defaults.isrequired == 'yes') ? 'yes' : 'no', slug = (defaults.slug) ? defaults.slug : '';
		if(fields.field_name == undefined) fields = {field_name:'required',values:{},default_value:'',isrequired:'',dynamic_id:''};//fields.field_name = 'required';
		//if(fields.values == undefined) fields.values = {};
		//if(fields.default_value == undefined) fields.value = '';
		
		var html = '<div id="dynamic_fields"><ul><li class="leftlist">Field Name</li><li class="rightlist"><input type="text" class="sbar" id="field_name" value="'+label+'" name="DYNAMIC['+counter+'][field_name]"></li></ul>';
		switch(type)
		{
			case "usr_name" :
			case "email_addr" :
			case "text" :
				html += '<ul><li class="leftlist">Default</li><li class="rightlist"><input type="text" class="sbar" id="default_value" value="'+std+'" name="DYNAMIC['+counter+'][default_value]" /></li></ul>';
			break;
			case "textarea" :
				html += '<ul><li class="leftlist">Default</li><li class="rightlist"><textarea id="default_value" class="textbox" name="DYNAMIC['+counter+'][default_value]" rows="5" style="width:210px;">'+std+'</textarea></li></ul>';
			break;
			default :
				html += '<ul><li class="leftlist">Values</li><li class="rightlist"><div id="dynamic_values">';
				if(typeof values == 'object')
				{
					jQuery.each(values, function(k, v){
							var is_checked = (k == std) ? 'checked="checked" ' : '';
							html += '<div><input type="radio" class="radiobtn" id="set_default" name="set_default" value="'+(vcounter++)+'" '+is_checked+'/><br /><input type="text" class="sbar" id="multivalues" value="'+v+'" name="DYNAMIC['+counter+'][values][]" /><a href="javascript:void(0)" id="remove_field">[-]</a></div>';
						});
				}
				else html += '<div><input type="radio" class="radiobtn" id="set_default" name="set_default" value="'+(vcounter++)+'" checked="checked" /><br /><input type="text" class="sbar" id="multivalues" value="" name="DYNAMIC['+counter+'][values][]" /><a href="javascript:void(0)" id="remove_field">[-]</a></div>';
				var dv = (std) ? std : '1';
				html += '<input type="hidden" id="default_value" name="DYNAMIC['+counter+'][default_value]" value="'+dv+'" /></div><br /><a href="javascript:void(0)" id="add_new_field">[Add]</a></li></ul>';
			break;
		}
		
		html += '<input type="hidden" name="DYNAMIC['+counter+'][dynamic_id]" id="dynamic_id" value="'+(count_id++)+'" /></li>'
				
		if(fields.isrequired == undefined) fields.isrequired = '0';

		var cb_enable, cb_disable = '';
		if(isrequired == 'yes')
		{
			cb_enable = 'selected';
		}else cb_disable = 'selected';
		
		html += '<ul><li class="leftlist">Required?</li><li class="rightlist"><p class="field switch"><label class="cb-enable '+cb_enable+'" id="yes" for="isrequired"><span>Yes</span></label><label class="cb-disable '+cb_disable+'" id="no" for="isrequired"><span>No</span></label><input type="radio" checked="checked" value="'+isrequired+'" name="DYNAMIC['+counter+'][isrequired]" class="checkbox" id="isrequired"></p></li></ul>';
		return html;
	}
	
	jQuery('select#form_field').trigger('change');
	jQuery('#add_row').live('click', function(){
			var parent = jQuery('#justborn > ul#inner_ul');
			if(jQuery('#the-list').find('input:disabled[value="usr_name"]').length) jQuery('#form_field > option[value="usr_name"]', parent).remove();
			if(jQuery('#the-list').find('input:disabled[value="email_addr"]').length) jQuery('#form_field > option[value="email_addr"]', parent).remove();
			jQuery('select#form_field').trigger('change');
		});
	
	jQuery('input#set_default').live('click', function()
	{
		if(jQuery(this).parent().children('#multivalues').val() == '')
		{	if ( ! confirm("The default field value is empty, continue anyway?")) return false;}
		jQuery(this).parents('#dynamic_values').children('input#default_value').val(jQuery(this).val());
	});
	jQuery('a#add_new_field').live('click', function(){
			var parent = jQuery(this).parents('ul#inner_ul');
			var counter = jQuery('#reorder', parent).text();
			jQuery('div#dynamic_values', parent).append('<div><input type="radio" class="radiobtn" id="set_default" name="set_default" value="'+(vcounter++)+'" /><br /><input type="text" class="sbar" id="multivalues" value="" name="DYNAMIC['+counter+'][values][]" /><a href="javascript:void(0)" id="remove_field">[-]</a></div>');
		});

	jQuery('a#remove_field').live('click', function(){
			jQuery(this).parent('div').remove();
		});
	
});