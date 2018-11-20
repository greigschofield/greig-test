<?php if ( ! defined('ABSPATH')) exit('restricted access');

if( !function_exists('fw_sidebars_array') )
{
	function fw_sidebars_array()
	{
		global $wp_registered_sidebars;

		$settings = get_option( THEME_PREFIX.'sidebar_settings');
		//printr(wp_get_sidebars_widgets());
		$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;

		$data = array();
		foreach( (array)$sidebars as $sidebar)
		{
			$data[kvalue($sidebar, 'id')] = kvalue($sidebar, 'name');
		}
		
		if( $settings && is_array( kvalue( $settings, 'DYNAMIC' ) ) )
		{
			foreach( kvalue( $settings, 'DYNAMIC' ) as $dynamic ){
				$name = kvalue( $dynamic, 'name');
				$data[texttoslug($name)] = $name;
			}
		}
		return $data;
	}
}



function fw_get_pages()
{
	$pages = get_pages();
	foreach($pages as $page)
	{
		$pages_arr[$page->ID] = $page->post_title;
	}
	return $pages_arr;
}

function printr( $data )
{
	echo '<pre>'; print_r( $data );exit;
}

function form_input($data = '', $value = '', $extra = '')
{
	$defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

	return "<input "._parse_form_attributes($data, $defaults).$extra." />";
}

function form_multiselect($name = '', $options = array(), $selected = array(), $extra = '')
{
	if ( ! strpos($extra, 'multiple'))
	{
		$extra .= ' multiple="multiple"';
	}

	return form_dropdown($name, $options, $selected, $extra);
}

function form_textarea($data = '', $value = '', $extra = '')
{
	$defaults = array('name' => (( ! is_array($data)) ? $data : ''), 'cols' => '90', 'rows' => '12');

	if ( ! is_array($data) OR ! isset($data['value']))
	{
		$val = $value;
	}
	else
	{
		$val = $data['value']; 
		unset($data['value']); // textareas don't use the value attribute
	}
	
	$name = (is_array($data)) ? $data['name'] : $data;
	
	if(is_array($extra))
	{
		$newextra = $extra;
		foreach($newextra as $k=>$v)
		{
			$extra = ' '.$k.'="'.$v.'"';
		}
	}

	return "<textarea data-tolea "._parse_form_attributes($data, $defaults).$extra.">".form_prep($val, $name)."</textarea>";
}

function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
{
	if ( ! is_array($selected))
	{
		$selected = array($selected);
	}

	// If no selected state was submitted we will attempt to set it automatically
	if (count($selected) === 0)
	{
		// If the form name appears in the $_POST array we have a winner!
		if (@isset($_POST[$name]))
		{
			$selected = array($_POST[$name]);
		}
	}
	
	if(is_array($extra))
	{
		$newextra = $extra;
		foreach($newextra as $k=>$v)
		{
			$extra = ' '.$k.'="'.$v.'"';
		}
	}

	if ($extra != '') $extra = ' '.$extra;

	$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

	$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

	foreach ((array)$options as $key => $val)
	{
		$key = (string) $key;

		if (is_array($val))
		{
			$form .= '<optgroup label="'.$key.'">'."\n";

			foreach ($val as $optgroup_key => $optgroup_val)
			{
				$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

				$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
			}

			$form .= '</optgroup>'."\n";
		}
		else
		{
			$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

			$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
		}
	}

	$form .= '</select>';

	return $form;
}

function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
{
	$defaults = array('type' => 'checkbox', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

	if (is_array($data) AND array_key_exists('checked', $data))
	{
		$checked = $data['checked'];

		if ($checked == FALSE)
		{
			unset($data['checked']);
		}
		else
		{
			$data['checked'] = 'checked';
		}
	}

	if ($checked == TRUE)
	{
		$defaults['checked'] = 'checked';
	}
	else
	{
		unset($defaults['checked']);
	}
	
	if(is_array($extra))
	{
		$newextra = $extra;
		foreach($newextra as $k=>$v)
		{
			$extra = ' '.$k.'="'.$v.'"';
		}
	}


	return "<input "._parse_form_attributes($data, $defaults).$extra." />";
}


function form_radio($data = '', $value = '', $checked = FALSE, $extra = '')
{
	if ( ! is_array($data))
	{
		$data = array('name' => $data);
	}

	$data['type'] = 'radio';
	return form_checkbox($data, $value, $checked, $extra);
}



function _parse_form_attributes($attributes, $default)
{
	if (is_array($attributes))
	{
		foreach ($default as $key => $val)
		{
			if (isset($attributes[$key]))
			{
				$default[$key] = $attributes[$key];
				unset($attributes[$key]);
			}
		}

		if (count($attributes) > 0)
		{
			$default = array_merge($default, $attributes);
		}
	}

	$att = '';

	foreach ($default as $key => $val)
	{
		if ($key == 'value')
		{
			$val = form_prep($val, $default['name']);
		}

		$att .= $key . '="' . $val . '" ';
	}

	return $att;
}



function form_prep($str = '', $field_name = '')
{
	static $prepped_fields = array();

	// if the field name is an array we do this recursively
	if (is_array($str))
	{
		foreach ($str as $key => $val)
		{
			$str[$key] = form_prep($val);
		}

		return $str;
	}

	if ($str === '')
	{
		return '';
	}

	// we've already prepped a field with this name
	// @todo need to figure out a way to namespace this so
	// that we know the *exact* field and not just one with
	// the same name
	if (isset($prepped_fields[$field_name]))
	{
		return $str;
	}

	$str = htmlspecialchars($str);

	// In case htmlspecialchars misses these.
	$str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);

	if ($field_name != '')
	{
		$prepped_fields[$field_name] = $field_name;
	}

	return $str;
}

function create_message($message, $type = 'error')
{
	return array('msg'=>$message, 'type'=>$type);
}
//attention, success, error, information
//message = array(messages = array(message, type, return)
function fw_message($messages = array(), $type = 'error', $return = false)
{
	global $_validation;

	if( ! is_array($messages)) 
	{
		$messages = array(create_message($messages, $type));
	}
	
	if( ! empty($_validation->_error_array))
	{
		foreach($_validation->_error_array as $k=>$v)
		{
			$messages[] = array('msg'=>$v,'type'=>'error');
		}
	}
	
	if(empty($messages)) return;
	
	$html = NULL;
	
	foreach($messages as $message)
	{

		$html .= '<!-- '.ucwords($message['type']).' -->';
		$html .= '<div class="fw_'.$message['type'].'">';
		$html .= '<p class="lab bold">'.ucwords($message['type']).'!</p>';
    	$html .= '<p class="txt">'.$message['msg'].'.</p>';
		$html .= '<a href="javascript:void(0)" class="close" id="close_message"></a>';
		$html .= '</div><div class="clear"></div>';
	}
	
	if($return) return $html;
	echo $html;
}

function multi_categories($settings = array())
{
	$categories = fw_get_categories();
	$size = (count($categories) < 10) ? count($categories) * 20 : 220;
	return form_multiselect('categories[selected][]', $categories, $settings['categories'][0], 'style="height:'.$size.'px;"' );	
}

function htmlCompress($html)
{
    preg_match_all('!(<(?:code|pre|script).*>[^<]+</(?:code|pre|script)>)!',$html,$pre);
    $html = preg_replace('!<(?:code|pre).*>[^<]+</(?:code|pre)>!', '#pre#', $html);
    $html = preg_replace('#<!-[^\[].+->#', '', $html);
    $html = preg_replace('/[\r\n\t]+/', ' ', $html);
    $html = preg_replace('/>[\s]+</', '><', $html);
    $html = preg_replace('/[\s]+/', ' ', $html);
    if (!empty($pre[0])) {
        foreach ($pre[0] as $tag) {
            $html = preg_replace('!#pre#!', $tag, $html,1);
        }
    }
    return $html;
}

function fw_contact_us($options, $post)
{
	global $_validation;
	
	if( ! is_array($options)) $options = array();

	if( ! is_numeric($post['dynamic_id'])) exit('Unknown error has been occurred.');
	$_validation->set_rules('form_field', '"Form Field"', 'trim|required|alpha_dash');
	$_validation->set_rules('field_name', '"Field Name"', 'trim|required|min_length[2]|max_length[100]');
	$_validation->set_rules('isrequired', '"Required"', 'required');
	
	if(array_search($post['form_field'], array('select','radio','checkbox')) !== false)
	{
		//CHANGE INDEX 
		$i = 1;
		$values = array();
		foreach($post['values'] as $k=>$v)
			$values[($i++)] = $v;
		$post['values'] = $values;
		$_validation->set_rules('values', 'Values', 'required');
	}
	
	$only_text = trim(preg_replace("#([^A-Za-z0-9])#","_",strtolower($post['field_name'])));
	
	//fix for wordpress name field
	$only_text = ($only_text == 'name') ? 'uname' : $only_text;
	
	$existing = array();
	foreach($options as $k=>$v)
	{
		$existing[$v['slug']] = $v;
	}
	
	$dynamic_id = ($post['dynamic_id'] - 1);

	if( ! isset($options[$dynamic_id]))  //stop dublicate entries
	{
		if(isset($existing[$only_text])) $_validation->_error_array['duplicate'] = 'A similar field name already exists.';
	}	
	
	return array('type'=>kvalue($post, 'form_field'),'label'=>kvalue($post, 'field_name'),'std'=>(kvalue($post, 'default_value') !== false) ? kvalue($post, 'default_value') : 1,'value'=>kvalue($post, 'values'),'text'=>kvalue($post, 'text'),'isrequired'=>kvalue($post, 'isrequired'),'slug'=>$only_text);
}

function fw_dynamic_settings()
{
	global $_dynamics, $_validation, $options;
	
	$name = $_POST['current_settings'];
	$option_name = THEME_PREFIX.$_POST['current_settings'];
	if( ! isset($options[$name])) wp_die( __( '<h3>The requested section was not found on this server.</h3>', AM_THEMES) );

	$nodes = last_nodes($name);
	
	if( ! empty($_POST['subsection']))
	{
		$pnode_name = $name;
		$name = $_POST['subsection'];
		//VALIDATE SUBSECTION NAME
		if( ! isset($options[$pnode_name]['SUB'][$name])) wp_die( __( '<h3>The requested section was not found on this server.</h3>', AM_THEMES) );
		$option_name = THEME_PREFIX.'sub_'.$name;
		//GET THE LAST NODE OF THE SECTION SETTING ARRAY
		$nodes = last_nodes(search_node($options[$pnode_name], $name));
	}

	if(isset($nodes['DYNAMIC']))
	{
		$options = get_option($option_name) or wp_die('Invalid Option name');
		$dynamic_id = (isset($_POST['dynamic_id'])) ? ($_POST['dynamic_id'] - 1) : 0;

		if(isset($_POST['delete']) && is_numeric($_POST['delete']))
		{
			$options['DYNAMIC'][($_POST['delete'] - 1)] = '';
			$options['DYNAMIC'] = array_filter((array) $options['DYNAMIC']);
			update_option($option_name, $options);
			exit('success');
		}elseif($option_name == THEME_PREFIX.'contact_page')
		{
			$options['DYNAMIC'][$dynamic_id] = fw_contact_us($options['DYNAMIC'], $_POST);
		}else
		{
			$options['DYNAMIC'][$dynamic_id] = _dynamic_data($nodes, $_POST);
		}
		
		if($_validation->run() === FALSE || ! empty($_validation->_error_array))
		{
			exit('<span>'.implode('</span><span>', $_validation->_error_array).'</span>');
		}else
		{	

			update_option($option_name, $options);
			exit('success');
		}
	}
}

function _dynamic_data($nodes, $post)
{
	global $_validation;
	$values = array();
	foreach($nodes['DYNAMIC'] as $k=>$v)
	{
		$_validation->set_rules($k, '<strong>"'.$v['label'].'"</strong>', $v['validation']);
		$values[$k] = &$_validation->_field_data[$k]['postdata'];
	}
	
	return $values;
}

function search_node($array, $node)
{
	foreach($array as $k=>$v)
	{
		if( ! is_array($v)) return false;
		if($k == $node)
		{
			return $v;
		}
		elseif(is_array($v))
		{
			$v = search_node($v, $node);
			if($v) return $v;
		}
	}
	return false;
}

function last_nodes($array = array())
{
	global $options;

	if ( ! is_array($array))
	{
		if( ! isset($options[$array])) return false;
		$array = $options[$array];
	}
	
	$settings = array();
	foreach($array as $k=>$v)
	{
		if($k == 'DYNAMIC')
		{
			$settings['DYNAMIC'] = array();
			foreach($v as $dk=>$dv)
			{
				$settings['DYNAMIC'] = array_merge((array) $settings['DYNAMIC'], (array)setting_node($dv, $dk));
			}
		}else $settings = array_merge($settings,(array) setting_node($v, $k));
	}
	return $settings;
}

function setting_node($array = array(), $key)
{
	if ( ! is_array($array)) return array();
	elseif(isset($array['label'])) return array($key=>$array);
	
	$settings = array();
	foreach($array as $k=>$v)
	{	
		if(is_array($v))
		{
			$match = setting_node($v, $k);
			if($match)
			{
				$settings = array_merge($settings, $match);
			}
		}
	}

	return $settings;
}

function fw_get_categories($arg = false)
{
	global $wp_taxonomies;
	if( ! empty($arg['taxonomy']) && ! isset($wp_taxonomies[$arg['taxonomy']]))
	{
		register_taxonomy( $arg['taxonomy'], THEME_PREFIX.$arg['taxonomy']);
	}

	$categories = get_categories($arg);
	//$cats = array('0'=>'Select Category');
	foreach($categories as $category)
	{
		$cats[$category->term_id] = $category->name;
	}
	return $cats;
}

function contact_page($atts)
{
	global $_callback;
	$gen_settings = get_option(THEME_PREFIX.'general_settings');
	if( ! is_page()) return;

	$settings = get_option(THEME_PREFIX.'contact_page');

	$html = '<form method="post" id="contactform" action="'.$_SERVER['REQUEST_URI'].'">';
	
	//ADD MESSAGES
	if(isset($_callback->messages)) $html .= $_callback->messages;
	$html .= '<ul>';
	
	if(strstr($settings['subject'], ','))
	{
		$html .= _contact_html('subject', array('type'=>'select','label'=>'Subject','slug'=>'subject','value'=>array_filter(explode(',', $settings['subject'])), 'std'=>set_value('subject')));
	}

	foreach($settings['DYNAMIC'] as $k=>$v)
	{
		$html .= _contact_html($k, $v);
	}

	//ADD RECAPTCHA AT THE END OF FORM
	if($settings['captcha'] == 'active' && $settings['captcha_api'])
	{
		require_once('recaptchalib.php');
		$html .= '<li class="clear">'.recaptcha_get_html($settings['captcha_api']).'<li>';
	}
	
	//Input hidden callback is a mandatory field
	$html .= '<li class="nopad"><input type="hidden" name="fw_callback" value="contact_page" /><input type="submit" class="go backcolr" name="fw_submit" value="Send Message" /></li>';
	$html .= '</ul></form>';
	return $html;
}

function _contact_html($k, $v)
{
	$html = '<li class="txt bold"><label for="'.$v['slug'].'">'.$v['label'].'</label></li>';
	$value = (isset($_POST[$v['slug']])) ? $_POST[$v['slug']] : set_value($v['slug'], $v['std']);
	$default = (empty($_POST) && $value) ? ' onfocus="if(this.value == \''.$value.'\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \''.$value.'\'; }"' : '';
	switch($v['type'])
	{
		case "usr_name" :
			$html .= '<li class="inputfield">'.form_input(array('name'=>$v['slug'], 'value'=>$value),'', 'class="required bar name"'.$default).'</li>';
		break;
		case "email_addr":
			$html .= '<li class="inputfield">'.form_input(array('name'=>$v['slug'], 'value'=>$value),'', 'class="required email bar"'.$default).'</li>';
		break;
		case "text" :
			$html .= '<li class="inputfield">'.form_input(array('name'=>$v['slug'], 'value'=>$value),'', 'class="bar '.$v['slug'].'"'.$default).'</li>';
		break;
		
		case "select" :
			$html .= '<li class="inputfield">'.form_dropdown($v['slug'], $v['value'], $value).'</li>';
		break;
		case "radio" :
			foreach($v['value'] as $key=>$val)
			{
				$checked = ($key == $value) ? TRUE : FALSE;
				$html .= '<li class="inputfield">'.form_radio($v['slug'], $key, $checked).'<li>';
				$html .= '<label for="'.$v['slug'].'">'.$val.'</label>';
			}
		break;
		case "textarea" :
			$html .= '<li class="textfield">'.form_textarea(array('name'=>$v['slug'],'rows'=>5,'cols'=>50), $value).'</li>';
		break;
		case "checkbox" :
			foreach($v['value'] as $key=>$val)
			{
				$checked = ($key == set_value($v['slug'], $v['std'])) ? TRUE : FALSE;
				$html .= form_checkbox(array('name'=>$v['slug']), $key, $checked);
				$html .= '<label for="'.$v['slug'].'">'.$val.'</label>';
			}
		break;
	}
	return $html;
}

function set_value($key, $value = '')
{
	global $_validation;
	if(empty($_validation)) return $value;
	
	if(isset($_validation->_field_data[$key]['postdata'])) return $_validation->_field_data[$key]['postdata'];
	else return $value;
}


if ( ! function_exists('word_limiter'))
{
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) == '') return $str;
		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}
		
		return rtrim($matches[0]).$end_char;
	}
}

if ( ! function_exists('character_limiter'))
{
	function character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false)
	{
		if($allowed_tags) $str = strip_tags($str, $allowed_tags);
		if (strlen($str) < $n)	return $str;
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n) return $str;

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';
			
			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}		
		}
	}
}

function fw_import_settings($refreshSettings = false)
{
	global $options;
	
	$backup_dir = FW_DIR.'includes/backup';
	$file_path = $backup_dir.'/admin_panel.php';
	if( ! file_exists($file_path)) wp_die('The theme admin panel settings file is missing!');
	
	ob_start();
	include_once($backup_dir.'/admin_panel.php');
	$content = ob_get_contents();
	ob_end_clean();
	$settings = unserialize(base64_decode($content));
	if( ! is_array($settings)) wp_die('The theme admin panel settings are invalid.');
		
	//NOW ADD / UPDATE SETTINGS INTO DATABASE
	foreach($settings as $k=>$v)
	{
		$v = fw_replace_pseudo($v);
		$prefix = THEME_PREFIX.$k;
		if( ! get_option($prefix)) add_option($prefix, $v);
		elseif($refreshSettings) update_option($prefix, $v);
	}
}

function fw_replace_pseudo(&$options = array())
{
	foreach($options as $k=>$v)
	{
		if(is_array($v)) $options[$k] = fw_replace_pseudo($v);
		else
		{	
			$options[$k] = str_replace(array('{TEMPLATE_URL}','{IMAGE_PATH}','{SITE_URL}','{ADMIN_EMAIL}'), array(get_template_directory_uri(),IMAGE_PATH,home_url(),get_option('admin_email')),$v);
		}
	}

	return $options;
}

function fw_export_settings()
{
	global $options;
	//add shortcode support
	$options['shortcodes'] = array();
	
	$export = array();
	foreach($options as $k=>$v)
	{
		if(key($v) == 'SUB')
		{
			foreach($v['SUB'] as $vk=>$vv)
			{
				$option_name = 'sub_'.$vk;
				if($settings = get_option(THEME_PREFIX.$option_name))
				{
					$export[$option_name] = fw_pseudo($settings);
				}
			}
		}else
		{
			$option_name = $k;
			if($settings = get_option(THEME_PREFIX.$option_name))
			{
				$export[$option_name] = fw_pseudo($settings);
			}
		}
	}
	
	exit(base64_encode(serialize($export)));
}

function fw_pseudo($options = array())
{
	global $_validation;

	foreach($options as $k=>$v)
	{
		if(is_array($v)) $options[$k] = fw_pseudo($v);
		elseif(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $v))
		{
			$options[$k] = '{ADMIN_EMAIL}';
		}
		else
		{	
			$options[$k] = str_replace(array(get_template_directory_uri(),IMAGE_PATH,home_url(),get_option('admin_email')),array('{TEMPLATE_URL}','{IMAGE_PATH}','{SITE_URL}','{ADMIN_EMAIL}'),$v);
		}
	}

	return $options;
}

/**
 * Generic function to show a message to the user using WP's
 * standard CSS classes to make use of the already-defined
 * message colour scheme.
 *
 * @param $message The message you want to tell the user.
 * @param $errormsg If true, the message is an error, so use
 * the red message style. If false, the message is a status
  * message, so use the yellow information message style.
 */
 
function adminMessage($message, $errormsg = false)
{
	if ($errormsg) echo '<div id="message" class="error">';
	else echo '<div id="message" class="updated fade">';
	echo "<p><strong>$message</strong></p></div>";
}

function slugtotext($string)
{
	return ucwords(trim(preg_replace("#([^a-z0-9])#i"," ",strtolower($string))));
}