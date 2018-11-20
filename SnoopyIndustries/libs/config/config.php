<?php 

$options = array();

$options['ticketform']['title'] = array(
													'label'=>__('Title', AM_THEMES),
													'type'=>'text',
													'std'=>'',
													'validation'=>'required|trim',
													'style'=>array('placeholder'=>'Title'),
													'shorthelp'=>''
												);
$options['ticketform']['category'] = array(
													'label'=>__('Category', AM_THEMES),
													'type'=>'select',
													'std'=>'',
													'validation'=>'required|trim',
													'style'=>array('class'=>''),
													'value'=>fw_get_categories(),
													'shorthelp'=>''
												);
$options['ticketform']['text'] = array(
													'label'=>__('Text', AM_THEMES),
													'type'=>'textarea',
													'std'=>'',
													'validation'=>'required',
													'style'=>array('placeholder'=>'Text'),
													'shorthelp'=>''
												);
$options['login']['log'] = array(
													'label'=>__('Username', AM_THEMES),
													'type'=>'text',
													'std'=>'',
													'validation'=>'required',
													'style'=>array('placeholder'=>'Username', 'class'=> 'half'),
													'shorthelp'=>''
												);
$options['login']['email'] = array(
													'label'=>__('Email', AM_THEMES),
													'type'=>'text',
													'std'=>'',
													'validation'=>'required|email',
													'style'=>array('placeholder'=>'Email', 'class'=>'half'),
													'shorthelp'=>''
												);
$options['login']['facebook'] = array(
													'label'=>__('Facebook', AM_THEMES),
													'type'=>'facebook',
													'std'=>'',
													'validation'=>'',
													'style'=>array('placeholder'=>'Facebook', 'class'=>'half'),
													'shorthelp'=>''
												);
$options['login']['twitter'] = array(
													'label'=>__('Twitter', AM_THEMES),
													'type'=>'twitter',
													'std'=>'',
													'validation'=>'',
													'style'=>array('placeholder'=>'Facebook', 'class'=>'half'),
													'shorthelp'=>''
												);





