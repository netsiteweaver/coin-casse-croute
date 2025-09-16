var saved_smtp_settings = {};
jQuery(function(){
	
	$('#update').on("click",function(){
		var notifications = [];
		$('table.process tr').each(function(i,j){
			let stage = $(this).data('stage');
			let user = $(this).data('user');
			let checked =$(this).find('input[type=checkbox]').is(":checked")

			if (checked) notifications.push({'stage':stage,'user':user});
		})

		$.ajax({
			url: base_url + 'settings/updatenotifications',
			method: 'POST',
			dataType: 'JSON',
			data: {data:notifications},
			success: function(response) {
				window.location.reload();
			},
			complete: function() {

			}
		})
    })
	

	$('.test-email').on('click', function(){

		if($(this).hasClass("running")) return false;

		if(confirm('By proceeding, an email will be sent to the email associated with your account. Would you like to proceed?'))
		{
			//check if smtp settings have changed
			let valid = true;
			$('.form-group.has-warning').removeClass('has-warning');
			$('.save-state').each(function(i,row){
				let name = $(row).attr("name");
				name = name.substring(14,name.length-1);
				if($(this).val() != saved_smtp_settings[name]) {
					$(this).closest('.form-group').addClass("has-warning");
					valid = false;
				}
			})

			if(!valid){
				if(confirm('Some of the settings have changed but has not yet been saved. Test Email will use the saved settings only. Would you still like to proceed without saving?')){
					sendTestEmail();
				}
			}else{
				sendTestEmail();
			}
			
		}
	})

})
