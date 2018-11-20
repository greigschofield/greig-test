<?php if ( ! defined('ABSPATH')) exit('restricted access');

//SUB, DYNAMIC
$options = array();

//GENERAL SETTINGS

$options['general_settings']['background_image'] = array(
												'label'=>__('Background Image','theme options','cinergy'),
												'type'=>'image',
												'shorthelp'=>__('Enter the file url or click upload to use wordpress image manager ','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'define'=>'FAVICON',
												'validation'=>'prep_url|trim',
												'style'=>array('class'=>'bar')
											);

$options['general_settings']['background_color'] = array(
													'label'=>__('Background Color','theme options','cinergy'),
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'ddd',
													'validation'=>'trim',
													'define'=>'BACKGROUND_COLOR',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change the background color.','theme options','cinergy'),
												);
												
/*$options['general_settings']['header_background_color'] = array(
													'label'=>__('Header Background Color',
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'39404A',
													'validation'=>'required|trim',
													'define'=>'HEADER_BACKGROUND_COLOR',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change header background color.'
												);*/
												
$options['general_settings']['background_color_switch'] = array(
													'label'=>__('Enable Background Color','theme options','cinergy'),
													'type'=>'switch',
													'shorthelp'=>__('Enable/Disable background color','theme options','cinergy'),
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'THEMERTL',
													'style'=>array('class'=>'radiobtn checkbox')
												);

$options['general_settings']['custom_logo'] = array(
													'label'=>__('Custom Logo','theme options','cinergy'),
													'type'=>'image',
													'shorthelp'=>__('Enter the image url or click upload to use wordpress image manager.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'prep_url|trim',
													'define'=>'LOGO',
													'style'=>array('class'=>'bar')
												);
												
													
$options['general_settings']['logo_dim'] = array(
													'label'=>__('Logo dimension','theme options','cinergy'),
													'type'=>'2-input',
													'shorthelp'=>__('Adjust the logo width and height, both fields are required.','theme options','cinergy'),
													'value'=>'',
													'define'=>'width',
													'std'=>'302',
													'define1'=>'height',
													'std_1'=>'83',
													'validation'=>'is_natural_no_zero|min_length[2]|max_length[4]|trim',
													'style'=>array('class'=>'ssbar')
												);

$options['general_settings']['favicon'] = array(
												'label'=>__('Custom favicon','theme options','cinergy'),
												'type'=>'image',
												'shorthelp'=>__('Enter the .ico file url or click upload to use wordpress image manager ','theme options','cinergy') . '<br/> <a href="http://en.wikipedia.org/wiki/Favicon" target="_blank"><strong>' . __('what is a favicon?','theme options','cinergy') . '</strong></a>',
												'value'=>'',
												'std'=>'',
												'define'=>'FAVICON',
												//'validation'=>'prep_url|valid_url|trim',
												'style'=>array('class'=>'bar')
											);

$options['general_settings']['404_background'] = array(
												'label'=>__('404 error page background image','theme options','cinergy'),
												'type'=>'image',
												'shorthelp'=>__('Enter the image url of the 404 error page background.','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'define'=>'',
												//'validation'=>'prep_url|valid_url|trim',
												'style'=>array('class'=>'bar')
											);

$options['general_settings']['general_font'] = array(
												'label'=>__('General Font','theme options','cinergy'),
												'type'=>'select',
												'shorthelp'=>__('Select font for the website\'s content.','theme options','cinergy'),
												'value'=>google_fonts_array()
												);
/*$options['general_settings']['blog_author'] = array(
													'label'=>__('Author box on Blog Post',
													'type'=>'switch',
													'shorthelp'=>__('Enable / Disable Author box on blog posts',
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'BLOG_AUTHOR',
													'style'=>array('class'=>'radiobtn checkbox')
												);*/

/*$options['general_settings']['call_action'] = array(
												'label'=>__('Call To Action',
												'type'=>'text',
												'shorthelp'=>__('Enter call to action number',
												'value'=>'',
												'std'=>'',
												'validation'=>'',
												'define'=>'CALL',
												'style'=>array('class'=>'bar')
												);*/
												
/*$options['general_settings']['call_message'] = array(
												'label'=>__('Call To Action',
												'type'=>'textarea',
												'shorthelp'=>__('Enter call to action message, you can use HTML tags as well.',
												'value'=>'',
												'std'=>'',
												'validation'=>'',
												'define'=>'MESSAGE',
												'style'=>array('class'=>'bar')
												);*/
												
$options['general_settings']['call_email'] = array(
												'label'=>__('Contact form email address','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the call to action email address.','theme options','cinergy'),
												'value'=>'',
												'std'=>get_option('admin_email'),
												'validation'=>'required|valid_email',
												'define'=>'EMAIL',
												'style'=>array('class'=>'bar')
												);

$options['general_settings']['footer_logo'] = array(
													'label'=>__('Footer Logo [for Custom Widget]','theme options','cinergy'),
													'type'=>'image',
													'shorthelp'=>__('Enter the image url or click upload to use wordpress image manager.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'prep_url|trim',
													'define'=>'FOOTER_LOGO',
													'style'=>array('class'=>'bar')
												);

$options['general_settings']['copyright_logo'] = array(
													'label'=>__('Copyright Logo','theme options','cinergy'),
													'type'=>'image',
													'shorthelp'=>__('Enter the image url or click upload to use wordpress image manager.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'prep_url|trim',
													'define'=>'COPYRIGHT_LOGO',
													'style'=>array('class'=>'bar')
												);
												
$options['general_settings']['copyright'] = array(
												'label'=>__('Custom Copyright Text','theme options','cinergy'),
												'type'=>'textarea',
												'shorthelp'=>__('Change the default copyright text, you can use HTML tags as well.','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'validation'=>'trim|stripslashes',
												'define'=>'COPYRIGHT',
												'style'=>array('class'=>'textbox')
												 );

// Sidebar creator
/*$options['sidebar_settings']['category'] = 						array(
																	'label'=>__('Category Sidebar',
																	'type'=>'select',
																	'shorthelp'=>__('Select the sidebar for the category page',
																	'value'=>fw_sidebars_array(),
																	'std'=>'blog',
																	'validation'=>'',
																	'style'=>array('class'=>'')
																 );
$options['sidebar_settings']['archive'] = 						array(
																	'label'=>__('Archive Sidebar',
																	'type'=>'select',
																	'shorthelp'=>__('Select the sidebar for the archive page',
																	'value'=>fw_sidebars_array(),
																	'std'=>'blog',
																	'validation'=>'',
																	'style'=>array('class'=>'')
																 );
$options['sidebar_settings']['author'] = 						array(
																	'label'=>__('Author Sidebar',
																	'type'=>'select',
																	'shorthelp'=>__('Select the sidebar for the author page',
																	'value'=>fw_sidebars_array(),
																	'std'=>'blog',
																	'validation'=>'',
																	'style'=>array('class'=>'')
																 );
$options['sidebar_settings']['search'] = 						array(
																	'label'=>__('Search Sidebar',
																	'type'=>'select',
																	'shorthelp'=>__('Select the sidebar for category page',
																	'value'=>fw_sidebars_array(),
																	'std'=>'blog',
																	'validation'=>'',
																	'style'=>array('class'=>'')
																 );	
$options['sidebar_settings']['tags'] =	 						array(
																	'label'=>__('Tags Sidebar',
																	'type'=>'select',
																	'shorthelp'=>__('Select the sidebar for category page',
																	'value'=>fw_sidebars_array(),
																	'std'=>'blog',
																	'validation'=>'',
																	'style'=>array('class'=>'')
																 );


*/
// TYPOGRAPHY SETTINGS
/*$options['typography_settings']['home_heading_font'] = array(
												'label'=>__('Home Page Headings Font','theme options','cinergy'),
												'type'=>'select',
												'shorthelp'=>__('Select font for the Homepage headings.','theme options','cinergy'),
												'value'=>google_fonts_array()
												);
$options['typography_settings']['home_heading_color'] = array(
													'label'=>__('Home Page Headings Color','theme options','cinergy'),
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'',
													'validation'=>'required|trim',
													'define'=>'COLOR_SCHEME',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change the color of contents according to your requirement.','theme options','cinergy'),
												);
$options['typography_settings']['home_content_font'] = array(
												'label'=>__('Home Page Content Font','theme options','cinergy'),
												'type'=>'select',
												'shorthelp'=>__('Select font for the content','theme options','cinergy'),
												'value'=>google_fonts_array()
												);
												
$options['typography_settings']['home_content_color'] = array(
													'label'=>__('Home Page Content Color','theme options','cinergy'),
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'fff',
													'validation'=>'required|trim',
													'define'=>'COLOR_SCHEME',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change the color of contents according to your requirement.','theme options','cinergy'),
												);
$options['typography_settings']['sidebar_heading_font'] = array(
												'label'=>__('Sidebar Headings Font','theme options','cinergy'),
												'type'=>'select',
												'shorthelp'=>__('Select font for the Homepage headings.','theme options','cinergy'),
												'value'=>google_fonts_array()
												);
$options['typography_settings']['sidebar_heading_color'] = array(
													'label'=>__('Sidebar Headings Color','theme options','cinergy'),
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'',
													'validation'=>'required|trim',
													'define'=>'COLOR_SCHEME',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change the color of contents according to your requirement.','theme options','cinergy'),
												);
$options['typography_settings']['sidebar_content_font'] = array(
												'label'=>__('Sidebar Content Font','theme options','cinergy'),
												'type'=>'select',
												'shorthelp'=>__('Select font for the content','theme options','cinergy'),
												'value'=>google_fonts_array()
												);
												
$options['typography_settings']['sidebar_content_color'] = array(
													'label'=>__('Sidebar Content Color','theme options','cinergy'),
													'type'=>'colorbox',
													'value'=>'',
													'std'=>'eee',
													'validation'=>'required|trim',
													'define'=>'COLOR_SCHEME',
													'style'=>array('class'=>'fwcolorpicker bar'),
													'shorthelp'=>__('Change the color of contents according to your requirement.','theme options','cinergy'),
												);*/



												
// LAYOUT SETTINGS
													
/*$options['layout_settings']['page_comments'] = array(
													'label'=>__('Page Comments',
													'type'=>'switch',
													'shorthelp'=>__('Enable/Disable page comments',
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'PAGE_COMMETNS',
													'style'=>array('class'=>'radiobtn checkbox')
													);
													
$options['layout_settings']['post_comments'] = array(
													'label'=>__('Post Commetns',
													'type'=>'switch',
													'shorthelp'=>__('Enable/Disable post comments',
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'POST_COMMETNS',
													'style'=>array('class'=>'radiobtn checkbox')
													);
$options['layout_settings']['blog_social'] = array(
													'label'=>__('Social Sharing Icons on Blog Post',
													'type'=>'switch',
													'shorthelp'=>__('Enable / Disable social sharing icons on blog posts',
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'BLOG_SHARING',
													'style'=>array('class'=>'radiobtn checkbox')
												);						 
$options['layout_settings']['image_social'] = array(
													'label'=>__('Social Sharing Icons on Image Post',
													'type'=>'switch',
													'shorthelp'=>__('Enable / Disable social sharing icons on image posts',
													'value'=>array('on'=>'','off'=>''),
													'std'=>'on',
													'validation'=>'',
													'define'=>'IMAGE_SHARING',
													'style'=>array('class'=>'radiobtn checkbox')
												);	*/


//CONTACT PAGE SETTINGS
												 
/*$options['contact_page_settings']['contact_background'] = array(
											'label'=>__('Upload Background',
											'type'=>'image',
											'shorthelp'=>__('Enter the image url or click upload to use wordpress image manager.',
											'value'=>'',
											'std'=>'',
											'validation'=>'prep_url|valid_url|trim',
											'style'=>array('class'=>'bar')
										 );*/
												 


$options['contact_page_settings']['contact_to'] = array(
												'label'=>__('Email','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the email address where you want to receive the emails.','theme options','cinergy'),
												'value'=>'',
												'std'=>get_option('admin_email'),
												'validation'=>'required|valid_email',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['subject'] = array(
												'label'=>__('Subjects','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the subject of the mail, for multiple options use comma.','theme options','cinergy'),
												'value'=>'',
												'std'=>'Inquiry',
												'validation'=>'required|stripslashes',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['success_message'] = array(
												'label'=>__('Success Message','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the message you want to show after successfull submission.','theme options','cinergy'),
												'value'=>'',
												'std'=>'The form has been submitted successfully.',
												'validation'=>'required|stripslashes',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['google_map'] = array(
												'label'=>__('Google Map','theme options','cinergy'),
												'type'=>'textarea',
												'shorthelp'=>__('Enter the google map iframe code (standard sizes are 1920x500).','theme options','cinergy'),
												'help'=>'',
												'value'=>'',
												'std'=>'',
												'validation'=>'trim|stripslashes',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['title'] = array(
												'label'=>__('Primary title','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the title above the contact form.','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'validation'=>'',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['secondary_title'] = array(
												'label'=>__('Secondary title','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the secondary title shown below the Primary title.','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'validation'=>'',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['description'] = array(
												'label'=>__('Page description','theme options','cinergy'),
												'type'=>'textarea',
												'shorthelp'=>__('Enter the message shown above the contact form ( below the titles ) .','theme options','cinergy'),
												'help'=>'',
												'value'=>'',
												'std'=>'',
												'validation'=>'trim|stripslashes',
												'style'=>array('class'=>'bar')
												);

$options['contact_page_settings']['categories'] = array(
												'label'=>__('Contact Form Categories','theme options','cinergy'),
												'type'=>'text',
												'shorthelp'=>__('Enter the categories that should appear in the contact form\'s selector ( separate each category with comma ).','theme options','cinergy'),
												'value'=>'',
												'std'=>'',
												'validation'=>'trim',
												'style'=>array('class'=>'bar')
												);

// SEO SETTINGS
										 
$options['seo_meta_settings']['seo_meta_title'] = 		array(
															'label'=>__('Meta Title','theme options','cinergy'),
															'type'=>'text',
															'shorthelp'=>__('Enter meta title for home page','theme options','cinergy'),
															'std'=>get_bloginfo('name'),
															'extra'=>array('section_title'=>'Home Page'),
															'style'=>array('class'=>'bar')
														);
					
$options['seo_meta_settings']['site_meta_slogan'] = 	array(
															'label'=>__('Site Slogan','theme options','cinergy'),
															'type'=>'text',
															'shorthelp'=>__('Enter slogan for home page','theme options','cinergy'),
															'help'=>'',
															'std'=>get_bloginfo('description'),
															'style'=>array('class'=>'bar')
														);
					
$options['seo_meta_settings']['meta_description'] =     array(
															'label'=>__('Meta Description','theme options','cinergy'),
															'type'=>'textarea',
															'shorthelp'=>__('Enter meta description for home page','theme options','cinergy'),
															'help'=>'',
															'value'=>'',
															'std'=>'',
															'style'=>array('class'=>'bar')
														);
													
$options['seo_meta_settings']['meta_keywords'] = 		array(
															'label'=>__('Meta Keywords','theme options','cinergy'),
															'type'=>'textarea',
															'shorthelp'=>__('Enter meta keyword for home page','theme options','cinergy'),
															'help'=>'',
															'value'=>'',
															'std'=>'',
															'style'=>array('class'=>'bar')
														);
													
$options['seo_meta_settings']['meta_before_sep'] = 		array(
															'label'=>__('Title Before Separator','theme options','cinergy'),
															'type'=>'select',
															'shorthelp'=>__('Select meta title to appear before seperator','theme options','cinergy'),
															'value'=>array('site_title'=>'Site Title', 'page_title'=>'Page Title'),
															'std'=>get_bloginfo('name'),
															'extra'=>array('section_title'=>'Single Post/Page'),
														);
					
$options['seo_meta_settings']['separator'] = 			array(
															'label'=>__('Separator','theme options','cinergy'),
															'type'=>'text',
															'shorthelp'=>__('Enter separator for meta title','theme options','cinergy'),
															'help'=>'',
															'value'=>'',
															'std'=>'',
															'style'=>array('class'=>'bar')
														);
					
$options['seo_meta_settings']['meta_after_sep'] = 		array(
														'label'=>__('Title After Separator','theme options','cinergy'),
														'type'=>'select',
														'shorthelp'=>__('Select meta title to appear after seperator','theme options','cinergy'),
														'value'=>array('site_title'=>'Site Title', 'slogan' =>'Slogan', 'page_title'=>'Page/Post Title'),
														'std'=>get_bloginfo('name'),
													);
												 
// CUSTOM CODE
										 
$options['custom_settings']['header_code'] = array(
													'label'=>__('Header','theme options','cinergy'),
													'type'=>'textarea',
													'shorthelp'=>__('Add javascript or css code in &lt;head&gt; section.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'trim|stripslashes',
													'style'=>array('class'=>'textbox')
												 );


$options['custom_settings']['footer_code'] = array(
													'label'=>__('Footer','theme options','cinergy'),
													'type'=>'textarea',
													'shorthelp'=>__('Add javascript or HTML code in &lt;footer&gt; section.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'trim|stripslashes',
													'style'=>array('class'=>'textbox')
												 );
												 
$options['custom_settings']['google_analytics_code'] = array(
													'label'=>__('Google Analytics','theme options','cinergy'),
													'type'=>'textarea',
													'shorthelp'=>__('Add google analytics code.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'trim|stripslashes',
													'style'=>array('class'=>'textbox')
												 );
$options['custom_settings']['custom_css'] = array(
													'label'=>__('Custom CSS','theme options','cinergy'),
													'type'=>'textarea',
													'shorthelp'=>__('Add your own css code.','theme options','cinergy'),
													'value'=>'',
													'std'=>'',
													'validation'=>'',
													'style'=>array('class'=>'textbox')
												 );
$options['theme_information']['theme_info'] = array(
													'label'=>__('Theme information','theme options','cinergy'),
													'type'=>'theme_info',
													'shorthelp'=>'',
													'value'=>'',
													'std'=>'',
													'validation'=>'',
													'style'=>array('class'=>'textbox')
												 );
$options['theme_information']['theme_documentation'] = array(
													'label'=>__('Theme Documentation','theme options','cinergy'),
													'type'=>'theme_documentation',
													'shorthelp'=>'',
													'value'=>'',
													'std'=>'',
													'validation'=>'',
													'style'=>array('class'=>'textbox')
												 );
												 
								 



//define('IMAGE_PATH', get_template_directory_uri().'/images/');
$_GS = get_option(THEME_PREFIX.'general_settings');


//DEFINE CONSTANTS
foreach($options['general_settings'] as $key=>$settings)
{
	if(	! @defined($settings['define']))
	{
		@define(strtoupper($settings['define']), $_GS[$key]);
		
		if($settings['type'] == '2-input')
		{
			@define(strtoupper($settings['define1']), $_GS[$key.'_1']);
		}
	}
}


//SHORTCODES REGISTERATION
$_shortcodes = (array) get_option(THEME_PREFIX.'shortcodes');
foreach($_shortcodes as $k=>$v)
{
	add_shortcode($v, $k);
}