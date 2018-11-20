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

$options['page']['sidebar']			= array(
											'label' =>__('Page Sidebar', AM_THEMES),
											'type' =>'select',
											'info' => __( 'select the sidebar for the current page' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);

$options['topic']['sidebar']			= array(
											'label' =>__('Topic Sidebar', AM_THEMES),
											'type' =>'select',
											'info' => __( 'select the sidebar for the current topic' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['ticket']['sidebar']			= array(
											'label' =>__('Ticket Sidebar', AM_THEMES),
											'type' =>'select',
											'info' => __( 'select the sidebar for the current ticket' , AM_THEMES),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['ticket']['ticket_status']			= array(
											'label' =>__('Status', AM_THEMES),
											'type' =>'select',
											'info' => __( 'Choose the status for the current ticket' , AM_THEMES),
											'validation'=>'',
											'value' => array('solved'=>'Solved', 'pending'=>'Pending'),
											'attrs'=>array('class' => 'input-block-level'),
										);









