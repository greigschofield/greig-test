<?php
/**
 * Shortcoder include for inserting and editing shortcodes in post and pages
 * v1.0
 **/
 
if ( ! isset( $_GET['inline'] ) )
	define( 'IFRAME_REQUEST' , true );

// Load WordPress Administration Bootstrap
//require_once('../../../../wp-admin/admin.php');
//require_once('../functions.php');

if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
    wp_die(__('You do not have permission to edit posts.', AM_THEMES));

// Load all created shortodes
$sc_options = get_option('shortcoder_data');

//if(empty($sc_options))
	//die('no values');
function fwhtml_generator($k,$v,&$settings, $element_only = false)
{
	if( ! is_array($v)) return;
	$html = NULL;
	$id = 0;
	$selected = '';
	$extra = (isset($v['extra'])) ? $v['extra'] : array();
	
	//if(isset($extra['section_title'])) $html .= '<li class="lable hide colr">'.$extra['section_title'].'</li>';
	
	//if(isset($extra['label_position'])) $html .= '<li class="lable hide colr">'.$v['label'].'</li>';
	
	if($v['label'] != '') $html .= '<label class="label">'.$v['label'].':</label> ';
		
	//$html .= '<li class="field">';
	switch($v['type'])
	{
		case "text":
			$value = (isset($settings[$k])) ? $settings[$k] : '';
			$v['style']['data-param'] = $k;
			$element = form_input(array_merge(array('name'=>$k,'value'=>$value,'id'=>$k), (array) $v['style']));
		break;
		
		case "hidden":
			$element = '<input type="hidden"  name="content" value="Add your content here..."  />';
		break;
		
		case "select":
			$v['style'] = array_merge((array) kvalue($v, 'style'), array('id'=>$k));
			$value = (isset($settings[$k])) ? $settings[$k] : '';
			$v['style']['data-param'] = $k;
			$element = form_dropdown($k, $v['value'], $value, $v['style']);
		break;
		case "multiselect":
			$size = (count($v['value']) < 10) ? count($v['value']) * 20 : 220;
			$element = form_multiselect($k.'[]', kvalue($v, 'value'), kvalue($settings, $k), 'style="height:'.$size.'px;" id="'.$k.'", data-param="'.$k.'"' );
		break;
				
		case "textarea":
			$value = !empty($settings[$k]) ? $settings[$k] : !empty($v['value'] ) ? $v['value'] : '' ;
			$element = '<textarea rows="5" name="'.$k.'" class="textbox" id="'.$k.'">'.$value.'</textarea>';
		break;

		case "icons":
			$value = (isset($settings[$k])) ? $settings[$k] : '';
			$v['style']['data-param'] = $k;
			$element = form_input(array_merge(array('name'=>$k,'value'=>$value,'id'=>$k), (array) $v['style']));
			$element .= '<br/><small>Head over to <a href="http://fontawesome.io/icons/">FontAwesome</a> and insert the name of the icon you want to insert. For example "fa-facebook", "fa-calendar-o".</small><br/><br/>';
		break;
		
		case "image":
			$counter = (is_numeric($k)) ? $k : 1;
			$value = (isset($settings[$k])) ? $settings[$k] : '';
			$element = '<div id="imageupload">'.form_input(array_merge(array('name'=>$k,'value'=>$value,'id'=>$k), (array) $v['style']));
			$element .= '<input id="image_button'.$counter.'" class="upload_image bttn" type="button" value="Upload" /></div>';
			$id++;
		break;
		
		case "switch" : 
			$element = '<p class="field switch">';
			$first = true;
			$default = NULL;
			foreach($v['value'] as $key=>$val)
			{
				$class = ($first) ? 'cb-enable' : 'cb-disable';
				$selected = ((isset($settings[$k]) && $settings[$k] == $key) || ( ! $selected && $first == false)) ? $selected = 'selected' : '';
				$default = ($selected && ! $default) ? $key : $default;
				$element .= '<label for="'.$k.'" id="'.$key.'" class="'.$class.' '.$selected.'"><span>'.$val.'</span></label>';
				$first = false;
			}
			
			$default = ($default) ? $default : $key;
			$element .= '<input type="radio" id="'.$k.'" class="checkbox" name="'.$k.'" value="'.$default.'" checked="checked" />';
			$element .= '</p>';
		break;
		
		case "2-input":
			$element = '<label for="'.$k.'">'.ucwords($v['define']).':</label>'.form_input(array_merge(array('name'=>$k,'value'=>$settings[$k],'id'=>$k), (array) $v['style']));
			$element .= '<label for="'.$k.'">'.ucwords($v['define1']).':</label>'.form_input(array_merge(array('name'=>$k.'_1','value'=>$settings[$k.'_1'],'id'=>$k), (array) $v['style']));
		break;
		
		case "radio":
		$element = '';
		foreach($v['value'] as $key=>$val)
			$element .= form_radio($k, $key, ($settings[$k] == $key) ? true : '',$v['style']).'<label for="'.$k.'">'.$val.'</label>';
		break;
		
	}
	
	if($element_only) return $element;
	
	$html .= $element;
	
	if(!empty($v['shorthelp']))
	{
		$html .= '<p class="infobox">'.$v['shorthelp'].'</p>';
	}
		
	//$html .= '</label>';
	if(!empty($v['help']))
	{
		$html .= '<li class="info"><a href="#" class="info"><span class="bubble">'.$v['help'].'</span></a></li>';
	}
	
	return $html;
}
?>

<html>
<head>
<title>Shortcodes created</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<style type="text/css">
body{
	font: 13px Arial, Helvetica, sans-serif;
	padding: 10px;
}
h2{
	font-size: 24px;
	font-weight: 3e3e3e;
	text-align: center;
}
h3{
	font-size: 18px;
	font-weight: 3e3e3e;
	border-bottom: 2px solid #39404a;
}
h4{
	margin: 0px 0px 10px;
}
hr{
	border-width: 0px;
	margin: 10px -10px;
	border-bottom: 1px solid #dfdfdf;
}
.sc_wrap{
	
}
.sc_shortcode{
	background-color: #f9f9f9;
	border-bottom: 1px solid #e5e5e5;
	margin-bottom: 10px;
}
.sc_shortcode_name{
	cursor: pointer;
	padding: 10px;
	color: #333333;
	font-size: 13px;
	font-weight: bold;
}
.sc_params{
	margin: 2px 10px 10px;
	padding: 10px;
	display: none;
}
.sc_insert{
	border-radius:25px;
	background-color: #86d0f6;
	color:#3e3e3e;
	padding:2px 15px;
	border: 0;
	font-weight: bold;
}

.sc_insert:hover{
	background: -moz-linear-gradient(19% 65% 90deg,#0082AD, #0099CC, #0099CC 51%);
	background: -webkit-gradient(linear, 0% 45%, 0% 60%, from(#0099CC), to(#0082AD));
	color: #f1f1f1;
}
label.label{
	padding: 5px;
	width: 40%;
	margin: 0px 25px 10px 0px;
	cursor: pointer;
	display:inline-block;
}
input[type=text], textarea{
	padding: 5px;
	border: 1px solid #d6d6d6;
	width: 40%;
	margin: 0px 25px 10px 0px;
	cursor: pointer;
	background-color: #f0f0f0;
}
select{
	width: 40%;
}
.sc_toggle{
	float: right;
	width: 16px;
	height: 16px;
	opacity: 0.4;
}

.sc_share_iframe{
	background: #FFFFFF;
	border: 1px solid #dfdfdf;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
	-webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
}
.sc_credits{
	background: url(images/aw.png) no-repeat;
	padding-left: 23px;
	color: #8B8B8B;
	margin-left: -5px;
	font-size: 13px;
	text-decoration: none;
}
span.sc_info {
	font-size: 9px;
}
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.sc_shortcode_name').append('<span class="sc_toggle"></span>');
	
	$('.sc_insert').click(function(){
		var params = '';
		var scname = $(this).attr('data-name');
		var sc = '';
		
		$(this).parent().find('input[type="text"], select').each(function(){
			if($(this).val() !== ''){
				attr = $(this).attr('data-param');
				val = $(this).val();
				params += attr + '="' + val + '" ';
			}
		});
		
		var textarea = $(this).parent().find('textarea[name="content"]');
		var hidden = $(this).parent().find('input[name="content"]');
		
		if(wsc(scname)){
			name = '"' + scname + '"';
		}else{
			name = scname;
		}
		if(textarea.val() !== undefined){
			sc = '[AM_' + name + ' ' + params + ']'+ escape(textarea.val()) + '[/AM_'+name+']';
		}else{
			sc = '[AM_' + name + ' ' + params + '][/AM_'+name+']';
			if(hidden.val() !== undefined){
				sc = '[AM_' + name + ' ' + params + ']'+$(hidden).val() + '[/AM_'+name+']';
			}else{
				sc = '[AM_' + name + ' ' + params + '][/AM_'+name+']';
			}
		}
		
		

		if(sc !== '') {parent.send_to_editor(sc);}
	});
	
	$('.sc_share_bar img').mouseenter(function(){
		$this = $(this);
		$('.sc_share_iframe').remove();
		$('body').append('<iframe class="sc_share_iframe"></iframe>');
		$('.sc_share_iframe').css({
			position: 'absolute',
			top: $this.offset()['top'] - $this.attr('data-height') - 15,
			left: $this.offset()['left'] - $this.attr('data-width')/2 ,
			width: $this.attr('data-width'),
			height: $this.attr('data-height'),
		}).attr('src', $this.attr('data-url')).hide().fadeIn();
	
	});
	
	$('.sc_shortcode_name').click(function(e){
		$('.sc_params').slideUp();
		if($(this).next('.sc_params').is(':visible')){
			$(this).next('.sc_params').slideUp();
		}else{
			$(this).next('.sc_params').slideDown();
		}
	})
	
});

var sc_closeiframe = function(){
	$('.sc_share_iframe').remove();
}

function wsc(s){
	if(s == null)
		return '';
	return s.indexOf(' ') >= 0;
}
</script>
</head>
<body>
<?php //sc_admin_buttons('fbrec'); ?>
<h2>Available Shortcodes</h2>
<div class="sc_wrap">
<h3>Columns</h3>
<?php
include_once('shortcodes_columns.php');
$sc_options = $column_options;//$FW_Shortcodes->_codes;print_r($sc_options);exit;
foreach($sc_options as $key=>$value){

		echo '<div class="sc_shortcode"><div class="sc_shortcode_name">' . ucwords(str_replace(array('_', '-'), ' ', $key));
		echo '</div>';

		echo '<div class="sc_params">';
		if(is_array($value)){
			echo '<h4>Available parameters: </h4>';
			$temp = array();
			foreach($value as $k=>$v){
				$settings = array();
				echo fwhtml_generator($k, $v, $settings);
			}
			echo'<hr/>';
		}else{
			echo 'No parameters avaialble - ';
		}
		echo '<input type="button" class="sc_insert cupid-blue" data-name="' . $key . '" value="Insert Shortcode"/>';
		echo '</div>';
		echo '</div>';

}
?>
<h3>Custom Posts</h3>
<?php
include_once('shortcodes_array.php');
$sc_options = $options;//$FW_Shortcodes->_codes;print_r($sc_options);exit;
foreach($sc_options as $key=>$value){
	/*if($key === 'timeline')
		echo "<h3>Resume</h3>";*/
	if($key === 'small_button')
		echo "<h3>Elements</h3>";
		echo '<div class="sc_shortcode"><div class="sc_shortcode_name">' . ucwords(str_replace(array('_', '-'), ' ', $key));
		echo '</div>';

		echo '<div class="sc_params">';
		if(is_array($value)){
			echo '<h4>Available parameters: </h4>';
			$temp = array();
			foreach($value as $k=>$v){
				$settings = array();
				echo fwhtml_generator($k, $v, $settings);
			}
			echo'<hr/>';
		}else{
			echo 'No parameters avaialble - ';
		}
		echo '<input type="button" class="sc_insert cupid-blue" data-name="' . $key . '" value="Insert Shortcode"/>';
		echo '</div>';
		echo '</div>';

}
?>
</div>
</body>
</html>