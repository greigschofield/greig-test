<!-- Left Menu -->
<div class="left-menu">
    <div class="arrowlistmenu" id="paginate-slider2">

		<?php
		$i = 0;
		foreach($options as $k=>$v):
		$childs = array_flip(array_keys((array)$v));
		$childs['SUB'] = ''; //REMOVE SUB CHILD
		if(count(array_filter( (array) $childs)) <= 0):?>
         	<h3 class="menuheader" id="<?php echo ($k == $this->name) ? 'imactive-'.$i : '';?>"><span class="<?php echo $k;?>"><?php echo ucwords(str_replace('_', ' ',$k));?></span></h3>
		<?php
		else:
		?>
         	<h3 class="menuheader clickable" id="<?php echo ($k == $this->name) ? 'imactive-'.$i : '';?>"><span class="<?php echo $k;?>"><a href="<?php echo home_url(); ?>/wp-admin/themes.php?page=fw_theme_options&section=<?php echo $k?>" class="optionlink"><?php echo ucwords(str_replace('_', ' ',$k));?></a></span></h3>
        <?php
		endif;?>
        
            <ul class="categoryitems">         
         	<?php if( ! empty($v['SUB'])):
					foreach($v['SUB'] as $sk=>$sv) : ?>
                        <li><a href="<?php echo home_url(); ?>/wp-admin/themes.php?page=fw_theme_options&section=<?php echo $k?>&subsection=<?php echo $sk;?>" class="toc"><?php echo ucwords(str_replace('_', ' ',$sk));?></a></li>
            <?php endforeach;
			 endif;?>
            </ul>
        <?php
		$i++;
		endforeach;?>
    </div>
    <div class="clear">
    </div>
    <a href="https://www.facebook.com/snoopyindustries">
    		<img src="<?php echo FW_URI ?>includes/images/facebook.png" />
    </a>
    <a href="http://twitter.com/snoopyind">
    		<img src="<?php echo FW_URI ?>includes/images/twitter.png" />
    </a>
    <div class="clear">
    </div>
</div>