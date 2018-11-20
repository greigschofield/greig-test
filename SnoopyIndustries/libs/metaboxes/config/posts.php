<?php 
//$t = $GLOBALS['_wpnukes_videos'];

$options = array();

$options['post']['sidebar']			= array(
											'label' =>__('Post Sidebar', AM_THEMES),
											'type' =>'select',
											'info' => __( 'select the sidebar for the current post' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);


$options['wpnukes_videos']['webnukes_source'] = array(
									'label'=>__('Source', AM_THEMES),
									'type'=>'hidden',
									'icon' => true,
									'settings' => array('heading' => __('Upload Video Detail', AM_THEMES), 'button_text' => __('Submit Video', AM_THEMES)),
								);
$options['wpnukes_videos']['webnukes_id'] = array(
									'label'=>__('ID', AM_THEMES),
									'type'=>'hidden',
								);

$options['wpnukes_videos']['webnukes_safety'] = array(
									'label'=>__('Safety', AM_THEMES),
									'type'=>'dropdown',
									'attrs'=>array('class'=>'input-block-level'),
									'value' => array('on' => __('On', AM_THEMES), 'off' => __('Off', AM_THEMES)),
								);
$options['wpnukes_videos']['webnukes_privacy'] = array(
									'label'=>__('Privacy', AM_THEMES),
									'type'=>'dropdown',
									'attrs'=>array('class'=>'input-block-level'),
									'value' => array('public' => __('Public', AM_THEMES), 'private' => __('Private', AM_THEMES), 'unlisted' => __('Unlisted', AM_THEMES)),
								);
$options['wpnukes_videos']['webnukes_views'] = array(
									'label'=>__('Views', AM_THEMES),
									'type'=>'hidden',
								);

$options['wpnukes_videos']['webnukes_rating'] = array(
									'label'=>__('Rating', AM_THEMES),
									'type'=>'hidden',
								);
$options['wpnukes_videos']['webnukes_duration'] = array(
									'label'=>__('Duration', AM_THEMES),
									'type'=>'hidden',
								);
$options['wpnukes_videos']['webnukes_hd'] = array(
									'label'=>__('High Definition', AM_THEMES),
									'type'=>'hidden',
								);

$options['wpnukes_audios']['webnukes_source'] = array(
									'label'=>__('Source', AM_THEMES),
									'type'=>'hidden',
									'icon' => true,
									'settings' => array('heading' => __('Upload Video Detail', AM_THEMES), 'button_text' => __('Submit Video', AM_THEMES)),
								);
$options['wpnukes_audios']['webnukes_id'] = array(
									'label'=>__('ID', AM_THEMES),
									'type'=>'hidden',
								);

$options['wpnukes_audios']['webnukes_safety'] = array(
									'label'=>__('Safety', AM_THEMES),
									'type'=>'dropdown',
									'attrs'=>array('class'=>'input-block-level'),
									'value' => array('on' => __('On', AM_THEMES), 'off' => __('Off', AM_THEMES)),
								);
$options['wpnukes_audios']['webnukes_privacy'] = array(
									'label'=>__('Privacy', AM_THEMES),
									'type'=>'dropdown',
									'attrs'=>array('class'=>'input-block-level'),
									'value' => array('public' => __('Public', AM_THEMES), 'private' => __('Private', AM_THEMES), 'unlisted' => __('Unlisted', AM_THEMES)),
								);
$options['wpnukes_audios']['webnukes_views'] = array(
									'label'=>__('Views', AM_THEMES),
									'type'=>'hidden',
								);

$options['wpnukes_audios']['webnukes_rating'] = array(
									'label'=>__('Rating', AM_THEMES),
									'type'=>'hidden',
								);
$options['wpnukes_audios']['webnukes_duration'] = array(
									'label'=>__('Duration', AM_THEMES),
									'type'=>'hidden',
								);
$options['wpnukes_audios']['webnukes_hd'] = array(
									'label'=>__('High Definition', AM_THEMES),
									'type'=>'hidden',
								);

$options['fw_slider']['webnukes_embed_code'] = array(
									'label'=>__('Embed Code', AM_THEMES),
									'type'=>'textarea',
									'attrs'=>array('class'=>'input-block-level', 'style' => 'min-height:100px;'),
									'info' => __('Insert the embed code you want to show on slider', AM_THEMES),
								);
$options['fw_slider']['webnukes_detail_url'] = array(
									'label'=>__('Detail Page URL', AM_THEMES),
									'type'=>'input',
									'attrs'=>array('class'=>'input-block-level'),
									'info' => __('Insert the hyperlin to futher detail page of the slide', AM_THEMES),
								);
$options['page']['sidebar']			= array(
											'label' =>__('Page Sidebar 1', AM_THEMES),
											'type' =>'dropdown',
											'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['sidebar1']			= array(
											'label' =>__('Page Sidebar 2', AM_THEMES),
											'type' =>'dropdown',
											'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['author_info']			= array(
											'label' =>__('Show Author Information', AM_THEMES),
											'type' =>'switch',
											//'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['enable_comments']			= array(
											'label' =>__('Enable Comments', AM_THEMES),
											'type' =>'switch',
											//'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['page_builder']			= array(
											'label' =>__('Enable Page Builder', AM_THEMES),
											'type' =>'switch',
											//'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);





