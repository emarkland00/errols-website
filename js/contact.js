(function($) {
	var success = function(data) {
		
	}, 
	failure = function (data) {
		
	};
	
	var validateForm = function() {
		var email = $('#email').val();
		if (!email) {
			// missing email
		}
		
		var subject = $('#subject').val();
		if (!subject) {
			// missing subject
		}
		
		var details = $('#details').val();
		if (!details) {
			// missing details
		}
		
		var json = {
			email: email,
			subject: subject,
			details: details
		};
		
		$.ajax({
			type: 'POST',
			url: '/handlers/contact.php',
			data: json,
			dataType: 'json'
		})
		.done(success)
		.fail(failure);
	};
	
	var start = function() {
		$('#submit-button').val("Sending...");
		$('#loading-gif').show();
	}, stop = function() {
		// $('#submit-button').val("Sent!");
		// $('#loading-gif').hide();
	};
	
	$(document).ajaxStart(start);
	$(document).ajaxStop(stop);
	
	$('#submit-button').on({
		click: validateForm,
	});
	
	$('#loading-gif').hide();
	
	$('#captcha-refresh').on('click', function() {
		$('#captcha').src = '/ext/securimage/securimage_show.php?' + Math.random(); 
		return false;
	});
})(jQuery);