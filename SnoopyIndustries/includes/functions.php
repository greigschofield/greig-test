<?php if ( ! defined('ABSPATH')) exit('restricted access');

class fw_functions
{
	private $head_data = '';
	function set_value($constant, $value = '', $is_defined = false)
	{
		if($is_defined)
		{
			$constant_value = constant($constant);
			if ( defined($constant) && ! empty($constant_value)) return $constant_value;
			else return $value;
		}else
		{
			if(empty($constant)) return $value;
			else return $constant;
		}
	}
	
	function custom_header()
	{
		global $_GS;
		if($favicon = $this->set_value('FAVICON', '', true))
	    	echo '<link id="page_favicon" href="'.$favicon.'" rel="icon" type="image/x-icon" />'."\n";
		
		if(is_home()) $slider_settings = get_option(THEME_PREFIX.'sub_home_banner_settings'); //Don't load extra options if we're not on homepage
		
		$settings = array('animSpeed'=>500,'pauseTime'=>3000,'startSlide'=>0,'effect'=>'random','slices'=>15,'boxCols'=>8,'boxRows'=>4,'pauseOnHover'=>true,'randomStart'=>false);
		$vars = '';
		foreach($settings as $k=>$v)
		{
			$settings[$k] = (isset($slider_settings[$k])) ? $slider_settings[$k] : $v;
			if($settings[$k] == 'true' || $settings[$k] == 'false') $value = $settings[$k];
			else $value = ( ! is_numeric($settings[$k])) ? "'".$settings[$k]."'" : $settings[$k];
			$vars .= $k.' : '.$value.',';
		}
		
		echo '<script type="text/javascript">var slider_settings = {'.$vars.'},theme_url = "'.get_template_directory_uri().'", ajax_url = "'.admin_url('admin-ajax.php').'";</script>'."\n";
		

		$content = (file_exists(get_template_directory().'/styles/custom.css')) ? file_get_contents(get_template_directory().'/styles/custom.css') : '';
		
		$custom_color = '#'.kvalue($_GS, 'text_color');
		
		if($content) {
			echo '<style title="custom_style">';
			echo str_replace('%s', $custom_color, $content);
			echo '</style>';
		}
	}
	
	function custom_footer()
	{
		
	}
}

$_fw = new fw_functions;
add_action('wp_head', array($_fw, 'custom_header'), 1);
add_action('wp_footer', array($_fw, 'custom_footer'));

if ( ! function_exists('html_style'))
{
	function html_style(&$data, $start = '', $end = '', $break = 0)
	{
		if(empty($data)) return;
		$chunks = array_chunk($data, $break);
		
		$html = '';
		foreach($chunks as $chunk)
		{
			$html .= $start.implode("\n", $chunk)	.$end;
		}

		unset($data);
		return $html;		
	}
}

function get_time_difference($start, $end)
{
    $uts['start'] = $start;
    $uts['end'] = $end ;
    if($uts['start'] !== -1 && $uts['end'] !== -1)
    {
        if($uts['end'] >= $uts['start'])
        {
            $diff = $uts['end'] - $uts['start'];
            if($days = intval((floor($diff/86400))))
                $diff = $diff % 86400;
            if($hours = intval((floor($diff/3600))))
                $diff = $diff % 3600;
            if($minutes = intval((floor($diff/60))))
                $diff = $diff % 60;
            $diff = intval( $diff );
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
        }
    }
    else
    {
        trigger_error( "Invalid date/time data detected", E_USER_WARNING );
    }
	
    return( false );
}