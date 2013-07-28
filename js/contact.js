(function ($) {
	
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
			detail: detail
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
	
	var success = function(data) {
		
	}, 
	failure = function (data) {
		
	};
	
	$('#submit-button').on('click', validateForm);
})(jQuery);