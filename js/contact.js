(function($) {
	var submitButton = '#submit-button';
	
	var success = function(data) {
		$(submitButton).val("Sent!")
	}, 
	failure = function (data) {
		$(submitButton).val("Problem\nsending email!")
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
		$(submitButton).val("Sending...");
		$('#loading-gif').show();
	}, stop = function() {
		// $('#submit-button').val("Sent!");
		// $('#loading-gif').hide();
	};
	
	$(document).ajaxStart(start);
	$(document).ajaxStop(stop);
	
	$(submitButton).on({
		click: validateForm,
	});
	
	$('#loading-gif').hide();
	
	$('#captcha-refresh').on('click', function() {
		$('#captcha').src = '/ext/securimage/securimage_show.php?' + Math.random(); 
		return false;
	});
})(jQuery);