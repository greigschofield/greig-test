<!-- Wrapper -->
<div id="admin-panel-wrap">
	
    <!-- Header -->
    <?php include('header.php');?>
    <!-- Content Section -->
    <div id="ad-cont">
        <!-- Left Column -->
        <div class="ad-col1">
            <?php include('left.php');?>
        </div>
        <!-- Right Column -->
		<div class="ad-col2">
        	<!-- messages -->
            <?php fw_message($this->messages);?>
			<div id="slider2" style="overflow:hidden;">
	            <form method="post" id="fw_form">
					<?php include('settings.php');?>
					<input id="fw_submit" name="fw_submit" type="submit" value="Save Changes" class="inputbtn">
                </form>
        	</div>
    </div>
    <div class="clear"></div>
		</div>
</div>
