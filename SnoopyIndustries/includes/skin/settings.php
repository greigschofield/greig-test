<div class="contentdiv">
	<?php if($is_record): ?>
    <h5 class="heading"><?php echo ucwords(str_replace('_', ' ', $name));?></h5>
    <?php 
		echo $html_data;
		endif;?>
        
     <?php foreach($conditional as $ck=>$cv) : ?>
            <div id="<?php echo $ck;?>" class="settings"><?php echo implode('', $cv);?></div>
		<?php endforeach; ?>
            
    <div class="slidersettings">
	    <?php 
			if(isset($nodes['DYNAMIC']))
			{
				include('dynamic.php');
			}
		?>
    </div>
</div>