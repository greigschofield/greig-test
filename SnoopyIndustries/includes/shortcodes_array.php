<?php
$options = array();
//==========Profile box============================
$options['team']['bg_img'] = array(
								'label'=>'Background Image',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['team']['link_img'] = array(
								'label'=>'Header Image',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['team']['link_img_link'] = array(
								'label'=>'Header Image and Members link',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['team']['size'] = array(
								'label'=>'Size',
								'type'=>'select',
								'value'=>array('1'=>'One', '2'=>'Two', '3'=>'Three', '4'=>'Four', '5'=>'Five', '6'=>'Six', '7'=>'Seven','8'=>'Eight', '9'=>'Nine', '10'=>'Ten', '11'=>'Eleven', '12'=>'Twelve'),
								'std'=>'4',
								);
$options['team']['nr'] = array(
								'label'=>'Nr of team members to show',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
//==============Services==================================

$options['services_box']['size'] = array(
								'label'=>'Each item\'s Size',
								'type'=>'select',
								'value'=>array('1'=>'One', '2'=>'Two', '3'=>'Three', '4'=>'Four', '5'=>'Five', '6'=>'Six', '7'=>'Seven','8'=>'Eight', '9'=>'Nine', '10'=>'Ten', '11'=>'Eleven', '12'=>'Twelve'),
								'std'=>'',
								);
//==============Case study==================================
$options['case_study']['background_image'] = array(
								'label'=>'Background Image',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['case_study']['title'] = array(
								'label'=>'Primary Title',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['case_study']['subtitle'] = array(
								'label'=>'Secondary title',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
//==============Facts==================================
$options['facts']['title'] = array(
								'label'=>'Title',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);

// ===========================Button=====================

$options['small_button']['label'] = array(
								'label'=>'Button Label',
								'type'=>'text',
								'value'=>'',
								'std'=>'MORE INFO',
								);
$options['small_button']['color'] = array(
								'label'=>'Button Preset Colors',
								'type'=>'select',
								'value'=>array('green'=>'Green','blue'=>'Blue','darkblue'=>'Dark Blue','pink'=>'Pink','orange'=>'Orange','yellow'=>'Yellow')
								);
$options['small_button']['link'] = array(
								'label'=>'Button Link',
								'type'=>'text',
								'value'=>'',
								'std'=>'#',
								);

$options['big_button']['label'] = array(
								'label'=>'Button Label',
								'type'=>'text',
								'value'=>'',
								'std'=>'MORE INFO',
								);
$options['big_button']['color'] = array(
								'label'=>'Button Preset Colors',
								'type'=>'select',
								'value'=>array('green'=>'Green','blue'=>'Blue','darkblue'=>'Dark Blue','pink'=>'Pink','orange'=>'Orange','yellow'=>'Yellow')
								);
$options['big_button']['link'] = array(
								'label'=>'Button Link',
								'type'=>'text',
								'value'=>'',
								'std'=>'#',
								);
//=============Side Blockquote==============================

$options['quote']['position'] = array(
								'label'=>'Blockquote alignment',
								'type'=>'select',
								'value'=>array('left'=>'Left', 'right'=>'Right'),
								'std'=>'left',
								);
$options['quote']['content'] = array(
								'label'=>'',
								'type'=>'hidden',
								);

//=============Icons==============================

$options['fa_icons']['icon'] = array(
								'label'=>'Fontawesome Icon name',
								'type'=>'icons',
								'std'=>'',
								);
$options['fa_icons']['class'] = array(
								'label'=>'Icon Class (for extra styling)',
								'type'=>'text',
								'std'=>'',
								);

//=============Alerts==============================

$options['alert']['type'] = array(
								'label'=>'Alert Box Type',
								'type'=>'select',
								'value'=>array('notice'=>'Notice', 'warning'=>'Warning','success'=>'Success','error'=>"Error",'info'=>'Info'),
								'std'=>'',
								);
$options['alert']['close'] = array(
								'label'=>'Close Button',
								'type'=>'select',
								'value'=>array('1'=>'Yes', '0'=>'No'),
								'std'=>'',
								);
$options['alert']['content'] = array(
								'label'=>'',
								'type'=>'hidden',
								);
//=============ACcordion============================
$options['accordion']['title'] = array(
								'label'=>'Title of the accordion',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['accordion']['size'] = array(
								'label'=>'Width',
								'type'=>'select',
								'value'=>array('1'=>'One', '2'=>'Two', '3'=>'Three', '4'=>'Four', '5'=>'Five', '6'=>'Six', '7'=>'Seven', 
								'8'=>'Eight', '9'=>'Nine', '10'=>'Ten', '11'=>'Eleven', '12'=>'Twelve'),
								'std'=>'6',
								);
$options['accordion']['content'] = array(
								'label'=>'',
								'type'=>'hidden',
								);
$options['accordion_tab']['title'] = array(
								'label'=>'Heading',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['accordion_tab']['color'] = array(
								'label'=>'Button Preset Colors',
								'type'=>'select',
								'value'=>array('green'=>'Green','red'=>'Red','pink'=>'Pink','orange'=>'Orange','yellow'=>'Yellow')
								);
$options['accordion_tab']['content'] = array(
								'label'=>'',
								'type'=>'hidden',
								);
//=============Pricing table============================
$options['pricing_table']['size'] = array(
								'label'=>'Width',
								'type'=>'select',
								'value'=>array('1'=>'One', '2'=>'Two', '3'=>'Three', '4'=>'Four', '5'=>'Five', '6'=>'Six', '7'=>'Seven', 
								'8'=>'Eight', '9'=>'Nine', '10'=>'Ten', '11'=>'Eleven', '12'=>'Twelve'),
								'std'=>'6',
								);
$options['pricing_table']['style'] = array(
								'label'=>'Style',
								'type'=>'select',
								'value'=>array('simple'=>'Simple','dark'=>'Dark')
								);
$options['pricing_table']['type'] = array(
								'label'=>'Type',
								'type'=>'select',
								'value'=>array('simple'=>'Simple','deluxe'=>'Deluxe')
								);
$options['pricing_table']['color'] = array(
								'label'=>'Color',
								'type'=>'select',
								'value'=>array('green'=>'Green','blue'=>'Blue','orange'=>'Orange','violet'=>'Violet')
								);
$options['pricing_table']['title'] = array(
								'label'=>'Title of the accordion',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['pricing_table']['price'] = array(
								'label'=>'Price',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['pricing_table']['under_price'] = array(
								'label'=>'Text under price',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);

$options['pricing_table']['button_label'] = array(
								'label'=>'Buton Label',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['pricing_table']['button_link'] = array(
								'label'=>'Button Link',
								'type'=>'text',
								'value'=>'',
								'std'=>'',
								);
$options['pricing_table']['content'] = array(
								'label'=>'',
								'type'=>'hidden',
								);