<?php if ( ! defined('ABSPATH')) exit('restricted access');
/* ADMIN OPTIONS */

/** Define Base directory path */
define('BASEPATH', dirname(__FILE__));

/** Home URL */
define('HOME_URL', home_url());

//AJAX CALLBACK FUNCTIONS
add_action('wp_ajax_fw_contact_form', 'fw_settings_page');
add_action('wp_ajax_dynamic_settings', 'fw_dynamic_settings');

//LOAD SCRIPT AND STYLE SHEETS FOR THEME OPTIONS PAGE
if (is_admin() && isset($_GET['page']) && strstr($_GET['page'], 'fw_'))
{
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}

global $_webnukes;



//LOAD ADMIN PANEL JAVASCRIPTS (default directory: includes/js)
function my_admin_scripts()
{

	$js = array('jquery.infinite-carousel','contentslider','fcolorpicker');
	foreach($js as $j)
	{
		wp_register_script($j, FW_URI .'/includes/js/'.$j.'.js');
		wp_enqueue_script($j);
	}
	wp_enqueue_script('custom_functions', FW_URI.'/includes/js/functions.js', array('jquery','jquery-ui-core','jquery-ui-sortable', 'jquery-ui-widget','jquery-ui-accordion','media-upload','thickbox'));
}

//LOAD ADMIN PANEL STYLE SHEETS (default directory: includes/css)
function my_admin_styles()
{
	wp_enqueue_style('thickbox');
	echo '<script type="text/javascript">var mytheme_url = \''.get_template_directory_uri().'\'; </script>';
	$css = array('style','colorpicker');
	foreach($css as $c)
	{
		wp_register_style($c, FW_URI.'/includes/css/'.$c.'.css');
		wp_enqueue_style($c);
	}
}

//REGISTER ADMIN PANEL PAGES LINK
function admin_menu_links()
{
	add_theme_page(__('Theme Options', AM_THEMES), __('Theme Options', AM_THEMES), 'edit_users', 'fw_theme_options', 'fw_settings_page');
}

function fw_settings_page()
{
	//option_table();
	$_OPT = new fw_options;
}

function google_fonts_array()
{
	$cache = wp_cache_get( 'alloptions', 'options');
	if( kvalue( $cache, 'google_web_fonts' ) ) $fonts = kvalue( $cache, 'google_web_fonts' );
	else $fonts = @file_get_contents(FW_DIR.'/libs/default_fonts');
	
	$fonts = @json_decode($fonts);
	$return = array();
	foreach( (array) kvalue( $fonts, 'items' ) as $f )
	{
		$return[kvalue($f, 'family')] = kvalue($f, 'family');
	}
	return $return;
}

add_action('admin_menu', 'admin_menu_links');

/** END ADMIN OPTIONS **/

include_once('functions.php');
include_once('helpers.php');
include_once('fields.php');
include_once('validation.php');
$_validation = new Form_validation;

/** Export Data */
//if(current_user_can('edit_themes') && is_admin() && isset($_GET['fw_export_settings'])) fw_export_settings();

//CHECK CALLBACKS
require_once('callback.php');

class fw_options
{	
	var $messages = array();
	private $settings = array();
	private $name = '';
	private $options_name = '';
	private $parent_has_nochild = false;
		
	function __construct()
	{	
		global $options, $_validation, $_dynamics, $_dynamic_headings;
		//echo '<pre>'; print_r($_POST);exit;
		//GET THE CURRENT SECTION INFORMATION
		
		$this->name = $name = (isset($_GET['section'])) ? $_GET['section'] : 'general_settings';
		$this->option_name = $option_name = THEME_PREFIX.$name;
		//VALIDATE SECTION NAME
		if( ! isset($options[$name])) wp_die( '<h3>'.__( 'The requested section was not found on this server.').'</h3>' );

		//GET THE LAST NODE OF THE SECTION SETTING ARRAY		
		$nodes = last_nodes($name);

		if(isset($_GET['subsection']))
		{
			$name = $_GET['subsection'];
			//VALIDATE SUBSECTION NAME
			if( ! isset($options[$this->name]['SUB'][$name])) wp_die( '<h3>'.__( 'The requested section was not found on this server.').'</h3>' );
			$option_name = THEME_PREFIX.'sub_'.$name;

			//GET THE LAST NODE OF THE SECTION SETTING ARRAY
			$nodes = last_nodes(search_node($options[$this->name], $name));
		}else //VALIDATE DO WE HAVE PARENT CHILDS
		{
			$childs = array_flip(array_keys($options[$name]));
			//REMOVE SUB CHILD
			$childs['SUB'] = '';
			if(count(array_filter( (array) $childs)) <= 0) wp_die( '<h3>'.__( 'The requested fields was not found.').'</h3>' );
		}

		//LOAD SETTEINGS FROM DATABASE
		if( ! $settings = get_option($option_name))
		{
			foreach($nodes as $k=>$v)
			{
				$_POST[$k] = kvalue($_POST, $k, kvalue($v, 'std'));
				if(kvalue($v, 'type') == '2-input') $_POST[$k.'_1'] = kvalue($v, 'std_1');
			}
		}
		if(count($_POST))
		{	
			$already_exists = ($settings) ? true : false;
			foreach($nodes as $field=>$setting)
			{
				if($field == 'DYNAMIC')
				{
					if( ! is_array($_POST['DYNAMIC'])) $_POST['DYNAMIC'] = array();
					$old_post = $_POST;
					$DYNAMIC = array();
					foreach($_POST['DYNAMIC'] as $dk=>$dv)
					{
						foreach($dv as $idk=>$idv) $_POST[$idk] = $idv;
						if($name == 'contact_page') $DYNAMIC[] = fw_contact_us($settings['DYNAMIC'], $dv);
						else $DYNAMIC[] = _dynamic_data($nodes, $_POST);
						
						$_validation->run();
					}

					$settings['DYNAMIC'] = $DYNAMIC;
					unset($DYNAMIC);
					$_POST = $old_post;
					
				}else
				{
					$option_value = kvalue($setting, 'value');
		
					if(is_array($option_value))
					{
						foreach($option_value as $k=>$v)
						{
							if(isset($_POST[$k]))
							{
								$settings[$k] = array_values((array)$_POST[$k]);
							}
						}
					}
					
					$settings[$field] = kvalue($_POST, $field);
					
					if($setting['type'] == '2-input')
					{
						$_validation->set_rules($field, '<strong>'.$setting['define'].'</strong>', kvalue($setting, 'validation'));
						$settings[$field.'_1'] = $_POST[$field.'_1'];
						$_validation->set_rules($field.'_1', '<strong>'.$setting['define1'].'</strong>', kvalue($setting, 'validation'));
					}else
					{
						$_validation->set_rules($field, '<strong>'.$setting['label'].'</strong>', kvalue($setting, 'validation'));
					}
				}
			}

			if($_validation->run() !== FALSE || empty($_validation->_error_array))
			{
				
				foreach($_POST as $k=>$v)
				{
					$postdata = $_validation->post($k);
					if($k != 'DYNAMIC') $settings[$k] = ($postdata !== false) ? $postdata : $_POST[$k];
				}
				
				unset($settings['fw_submit']);//REMOVE SYSTEM VARIABLES

				if($already_exists)
					update_option($option_name, $settings);
				else
					add_option($option_name, $settings);
					
				if(strstr($_SERVER['REQUEST_URI'], 'admin-ajax.php')) exit('success');
				
				$this->messages[] = create_message('Database information updated successfully','success');
			}
		}
	
		echo '<div class="wrap">';
		
		$html_data = NULL;
		$is_record = false;
		$conditional = array();
		$shortcodes = get_option(THEME_PREFIX.'shortcodes');

		foreach($nodes as $k=>$v)
		{
			if($k == 'DYNAMIC') continue;
			elseif( ! empty($v['shortcode'])) //REGISTER SHORTCODES
			{
				if((! isset($shortcodes[$v['shortcode']]) && $settings[$k]) || ($shortcodes[$v['shortcode']] != $settings[$k])) $shortcodes[$v['shortcode']] = $settings[$k];
				elseif(empty($settings[$k])) $shortcodes[$v['shortcode']] = '';
			}
			
			$is_record = true;
			if( ! empty($v['conditional']))
				$conditional[$v['conditional']][] = '<ul class="genral_setting_form">'.$this->html_generator($k, $v, $settings).'</ul>';
			else $html_data .= '<ul class="genral_setting_form">'.$this->html_generator($k, $v, $settings).'</ul>';
		}

		if(empty($_validation->_error_array)) update_option(THEME_PREFIX.'shortcodes', array_filter((array)$shortcodes));
		
		if(isset($nodes['DYNAMIC']))
		{
			$textarea = '';
			$js_array = array();
			$_dynamic_left = NULL;
			$_dynamic_right = NULL;
			$_fields = array();
			$counter = 0;
			foreach($nodes['DYNAMIC'] as $k=>$v)
			{
				$position = (isset($v['POSITION'])) ? $v['POSITION'] : 'left';
				
				if($position == 'left')
				{
					$_dynamic_left .= '<ul><li class="leftlist">'.$v['label'].'</li>';
					
					if($v['type'] == 'multiselect') $code = preg_replace('@name="(.*?)"@','name="DYNAMIC[{counter}]['.$k.'][]"', $this->html_generator($k, $v, $settings, true));
					else $code = preg_replace('@name="(.*?)"@','name="DYNAMIC[{counter}][$1]"', $this->html_generator($k, $v, $settings, true));
					$code = kvalue( $code, 'field' );
					$_dynamic_left .= '<li class="rightlist">'.$code.'</li></ul>';
					$_fields[$k] = stristr($v['validation'], 'required') ? 'required' : '';
				}else
				{
					if($v['type'] == 'multiselect') $code = $v['label'].' '.preg_replace('@name="(.*?)"@','name="DYNAMIC[{counter}]['.$k.'][]"', $this->html_generator($k, $v, $settings, true)).'<br />';
					else $code = $v['label'].' '.preg_replace('@name="(.*?)"@','name="DYNAMIC[{counter}][$1]"', $this->html_generator($k, $v, $settings, true)).'<br />';
					
					$_dynamic_right .= $code;
					$_fields[$k] = stristr($v['validation'], 'required') ? 'required' : '';
				}
				
				if($name == 'contact_page')
				{
					$nodes['DYNAMIC'] = array_merge($nodes['DYNAMIC'], $settings['DYNAMIC']);
				}
			}
								
			$_dynamic_left = '<li class="setting">'.$_dynamic_left.'</li>';
			$_dynamic_right = '<li class="slidetext">'.$_dynamic_right.'<div class="clear"></div><div id="controls" style="display:none"><input type="button" value="Save" class="inputbtn" id="save_slide" /><input type="button" value="cancel" class="inputbtn" id="cancel_slide" /></div></li>';
			$_dynamic_data = '<ul class="tablecont" id="inner_ul"><li class="errortxt" style="display:none"></li><li class="count"><span id="reorder">{counter}</span></li><li class="reorder"><a href="javascript:void(0)">&nbsp;</a></li>';
			$_dynamic_data .= $_dynamic_left.$_dynamic_right;
			$_dynamic_data .= '<li class="del"><a href="javascript:void(0)" class="cross" id="delete">&nbsp;</a></li></ul>';
				
			if( ! empty($settings['DYNAMIC']))
			{
				$dynamic_reset = array();
				
				foreach($settings['DYNAMIC'] as $dyna)
				{
					$dynamic_reset[] = $dyna;
				}

				$settings['DYNAMIC'] = $dynamic_reset;
				$DYNAMIC = json_encode($settings['DYNAMIC']);
				
				if(empty($_validation->_error_array))
				update_option($option_name, $settings);
				
			}else $DYNAMIC = '{}';
			
			$subsection = (isset($_GET['subsection'])) ? $_GET['subsection'] : '';
			echo '<script type="application/javascript">var current_section = "'.$this->name.'", subsection = "'.$subsection.'", fields = '.json_encode($_fields).', DYNAMIC = '.$DYNAMIC.', html = "'.str_replace('"','\"',htmlCompress($_dynamic_data)).'";</script>';
			echo '<script type="application/javascript" src="'.FW_URI.'/includes/js/multiadd.js"></script>';
			if($this->name == 'contact_page') echo '<script type="application/javascript" src="'.FW_URI.'/includes/js/formbuilder.js"></script>';
		}
			
		include('skin/main.php');
		echo '</div>';
	}
	
	function html_generator($k,$v,&$settings, $element_only = false)
	{
		if( ! is_array($v)) return;
		$html = NULL;
		$id = 0;
		$selected = '';
		$extra = (isset($v['extra'])) ? $v['extra'] : array();
		
		if(isset($extra['section_title'])) $html .= '<li class="lable hide colr">'.$extra['section_title'].'</li>';
		
		if(isset($extra['label_position'])) $html .= '<li class="lable hide colr">'.$v['label'].'</li>';
		else $html .= '<li class="lable">'.$v['label'].'</li>';
			
		$html .= '<li class="field">';
		switch($v['type'])
		{
			case "usr_name":
			case "email_addr":
			case "text":
				$value = (isset($settings[$k])) ? $settings[$k] : '';
				$element = form_input(array_merge(array('name'=>$k,'value'=>$value,'id'=>$k), (array) $v['style']));
				break;
			case "theme_info":
				$my_theme = wp_get_theme();
				$element  = "<div class='theme_info'><i>Theme URL : <a href='".$my_theme->get( 'ThemeURI' )."'>".$my_theme->get( 'ThemeURI' )."</a></div>";
				$element .= "<div class='theme_info'><i>Theme Version : ".$my_theme->get( 'Version' )."</i></div>";
				$element .= "<div class='theme_info'><i>Theme Author : <a href='".$my_theme->get( 'AuthorURI' )."'>".$my_theme->get( 'Author' )."</a></i></div>";
				break;
			case "theme_documentation":
				$element = "<iframe width='960' height='700' src='http://labs.am-themes.com/Cinergy_WP/Docs/read_me.html' style='margin-left: -35px;' />";
				break;
			case "select":
				$v['style'] = array_merge((array) kvalue($v, 'style'), array('id'=>$k));
				$value = (isset($settings[$k])) ? $settings[$k] : '';
				$element = form_dropdown($k, $v['value'], $value, $v['style']);
			break;
			
			case "multiselect":
				$size = (count($v['value']) < 10) ? count($v['value']) * 20 : 220;
				$element = form_multiselect($k.'[]', kvalue($v, 'value'), kvalue($settings, $k), 'style="height:'.$size.'px;" id="'.$k.'"' );
			break;
			
			case "textarea":
				$value = empty($settings[$k]) ? kvalue($v, 'value') : $settings[$k];
				//$element = '<textarea rows="5" name="'.$k.'" class="textbox" id="'.$k.'">'.$value.'</textarea>';
				$element = form_textarea(array('name'=>$k,'rows'=>5,'cols'=>50), stripslashes($value), kvalue( $v, 'style'));
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
			
			case "colorbox":
				$settings[$k] = ( ! kvalue($settings, $k)) ? '000000' : kvalue($settings, $k);
				$element = form_input(array_merge(array('name'=>$k,'value'=>$settings[$k],'id'=>$k), (array) kvalue($v, 'style')));
				$element .= '<div class="colorpreview" style="background-color:#'.$settings[$k].';">&nbsp;</div>';
			break;
			
			case 'facebook':
				$element = '<a class="btn facebook" href="javascript:void(0);" onclick="fblogin();"><span>'.__('Sign In with Facebook', AM_THEMES).'</span></a>';
			break;
			
			case 'twitter':
				$element = '<a class="btn twitter" href="'.home_url().'/?twitter_signin=true"><span>'.__('Sign In with Twitter', AM_THEMES).'</span></a>';
			break;
			
		}
		
		if($element_only) {
			if( isset( $element ) ){
				$return = array();
				$return['field'] = $element;
				if( kvalue( $v, 'shorthelp' ) ) $return['shorthelp'] = kvalue( $v, 'shorthelp' );
				if( kvalue( $v, 'help' ) ) $return['help'] = kvalue( $v, 'help' );
				return $return;
			}else return '';
		}
		
		$html .= $element;
		
		if(!empty($v['shorthelp']))
		{
			$html .= '<p class="infobox">'.$v['shorthelp'].'</p>';
		}
			
		$html .= '</li>';
		if(!empty($v['help']))
		{
			$html .= '<li class="info"><a href="#" class="info"><span class="bubble">'.$v['help'].'</span></a></li>';
		}
		
		return $html;
	}
}

if(isset($_GET['export_settings']) && $_GET['export_settings'] == true){
	
	include('backup_class.php');
	
	$data = new fw_backup_class;
	
	$data->export();
	
}

if(isset($_GET['firstlook'])){
	
	include('backup_class.php');
	
	$data = new fw_backup_class;
	$data->import();
	
}