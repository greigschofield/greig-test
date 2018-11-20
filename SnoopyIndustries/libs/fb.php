<?php $ticketing_settings = get_option(THEME_PREFIX.'ticketing_settings'); //printr($api_settings);?>

<script>
  window.fbAsyncInit = function() {
		FB.init({
			appId      : '<?php echo kvalue($ticketing_settings, 'facebook_api')?>', // App ID
			channelUrl : 'localhost', // Channel File
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
	};
 	
	//your fb login function
	function fblogin() {
		FB.login(function(response) {
			//...
			if (response.status === 'connected') {
				FWAPI();
			} else if (response.status === 'not_authorized') {
				FB.login();
			} else {
				FB.login();
			}
		}, {scope:'offline_access,email,user_about_me'});
	}

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function FWAPI() {
    FB.api('/me', function(response) {
		jQuery.fancybox.showLoading();
		jQuery.ajax({
			url: '<?php echo admin_url('admin-ajax.php');?>?action=fw_ajax_callback&type=fb_login',
			type: 'POST',
			data: response,
			success: function(res)
			{
				if( typeof(res) === 'string' && res === 'success' )
				{
					location.reload();
					//jQuery('.ajax-data').trigger('click');
				}
				if( typeof(res) === 'string' && res === 'failed' )
				{
					alert('Failed to login, Please refresh the page and try again');
				}
				//jQuery.fancybox.hideLoading();
			}
		});
    });
  }
  
  
  
</script>





