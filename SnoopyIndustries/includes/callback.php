<?php if ( ! defined('ABSPATH')) exit('restricted access');

class fw_callback
{
	var $messages = '';
	function contact_page()
	{
		global $_validation;
		//LOAD CONTACT PAGE SETTINGS

		$settings = get_option(THEME_PREFIX.'contact_page');
		//printr($_POST);
		//VALIDATE CAPTCHA
		if($settings['captcha'] == 'active' && $settings['captcha_api'])
		{
			require_once('recaptchalib.php');
								
			$resp = recaptcha_check_answer ($settings['pri_captcha_api'],
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

			  if ( ! $resp->is_valid)
			  {
				  $_validation->_error_array['captcha'] = 'Invalid captcha entered, please try again.';
			  }
		}
		
		if(empty($_validation->_error_array))
		{
			//SUBJECT
			if(strstr(kvalue($settings, 'contact_type'), ','))
			{
				$_validation->set_rules('subject','Subject', 'required');
				$subjects = explode(',', $settings['subject']);
				if( ! isset($subjects[$_POST['subject']])) $_validation->_error_array['subject'] = 'Invalid subject! Please make sure you have selected the subject.';
				else $subject = $subjects[$_POST['subject']];
			}else $subject = $settings['subject'];
	
			//USEREMAIL 
			$_validation->set_rules('contact_email','Email Address', 'required|valid_email');
			$_validation->set_rules('contact_name', 'Your Name', 'required|min_length[5]|max_length[30]');
			$_validation->set_rules('contact_type', 'Contact Type', 'required');
			$_validation->set_rules('contact_message', 'Message', 'required');

			
			
			$data = array();
			$name = 'User';
			$email = $settings['contact_to'];
			if(isset($settings['DYNAMIC']))
			foreach($settings['DYNAMIC'] as $k=>$v)
			{
				$rules = 'trim|encode_php_tags|htmlspecialchars';
				
				if($v['isrequired'] == 'yes') $rules = 'required|'.$rules;

				if($v['type'] == 'usr_name')
				{
					$name = $_POST[$v['slug']];
					$rules = $rules.'|min_length[5]|max_length[30]';
				}
				elseif($v['type'] == 'email_addr')
				{
					$email = $_POST[$v['slug']];
					$rules = $rules.'|valid_email';
				}
				
				$_validation->set_rules($v['slug'], '<strong>'.$v['label'].'</strong>', $rules);
				
				if( ! empty($v['value']))
				{
					if( ! isset($v['value'][$_POST[$v['slug']]])) $_validation->_error_array[$v['slug']] = 'Invalid Option of '.$v['label'].' selected.';
					else $data[$v['label']] = $v['label'].":\r\n".$v['value'][$_POST[$v['slug']]]."\r\n\r\n";
				}else $data[$v['label']] = $v['label'].":\r\n".$_POST[$v['slug']]."\r\n\r\n";
			}

			if($_validation->run() !== FALSE && empty($_validation->_error_array))
			{
				//$name = ($name) ? $name : $_validation->post('usr_name');
				//$email = ($email) ? $email : $_validation->post('email_addr');
				
				$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
				wp_mail($settings['contact_to'], $subject, implode("\r\n",$data), $headers);
				$message = ($settings['success_message']) ? $settings['success_message'] : 'Thank you <strong>'.$name.'</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.';

				$this->messages = '<div class="successmsg">
										<div><p><strong>Email Successfully Sent!</strong></p>
                                    		<p>'.$message.'</p>
                    					</div>
		        					</div>';
									
				if( ! empty($settings['redirect'])) header('location:'.$settings['redirect']);
			}else $this->_message($_validation->_error_array);
		}else $this->_message($_validation->_error_array);

	}
	
	function _message($messages = array())
	{
		if( ! is_array($messages))
		{
			$messages = array($messages);
		}
		$this->messages = '<div class="clear"></div>';
		foreach($messages as $k=>$message)
		{
			$this->messages .= '<div class="notif_red">
									<div class="alertin">
										<h6 class="bold white">field error</h6>
										<p>'.$message.'</p>
									</div>
								</div>';
		}
	}
}

if(isset($_POST['fw_callback']))
{
	$GLOBALS['_fw_callback'] = new fw_callback; // FOR SECURITY REASON CALL ONLY CALLBACK FILE METHODS
	if(method_exists($GLOBALS['_fw_callback'], $_POST['fw_callback']))
	{
		//SKIP IF THE FUNCTION IS PRIVATE
		if(substr($_POST['fw_callback'], 0, 1) != '_')
		{
			$GLOBALS['_fw_callback']->$_POST['fw_callback']();
		}
	}
}