<div class="slidertable settings" id="custom_urls">
	<input type="button" value="Click to add a new row" class="bttn left" id="add_row" /><br /><br />
    <div id="justborn"></div>
    <ul class="tablehead">
        <li class="count">&nbsp;</li>
        <?php
		if(isset($_dynamic_headings[$name]))
		{
			foreach($_dynamic_headings[$name] as $dk=>$dh)
			{
				echo '<li class="'.$dk.'">'.$dh.'</li>';	
			}
		}else{?>
            <li class="reorder">Reorder</li>
            <li class="setting">Setting</li>
            <li class="slidetext">Short note</li>
        <?php
		}?>
        
        <li class="del">&nbsp;</li>
    </ul>
    
    <div class="re_sortable">
        <ul id="the-list">
            <li id="no-record">No record found</li>
            <?php if(isset($_dynamic_html)) echo $_dynamic_html;?>
        </ul>
        <div id="no-sort"></div>
	</div>
</div>