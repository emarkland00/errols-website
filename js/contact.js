(function($) {
	var submitButton = '#submit-button',
		warningSpeed = 150,
		warningStyle = 'swing';
	
	var success = function(data) {
		$(submitButton).val("Sent!")
	}, 
	failure = function (data) {
		$(submitButton).val("Problem\nsending email!")
	};
	
	var validateForm = function() {
		var email = $('#email').val();
		if (!email || !email.length) {
			$("#email-warning").show(warningSpeed, warningStyle);
			return;
		} else {
			$("#email-warning").hide(warningSpeed, warningStyle);
		}
		
		var subject = $('#subject').val();		
		if (!subject || !subject.length) {
			$("#subject-warning").show(warningSpeed, warningStyle);
			return;
		} else {
			$("#subject-warning").hide(warningSpeed, warningStyle);
		}
		
		var details = $('#details').val();		
		var cc = $('#cc').is(':checked') ? 1 : 0;
		
		var json = {
			email: email,
			subject: subject,
			details: details,
			cc: cc
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
	
	$(document).ajaxStart(function() {
		$(submitButton).val("Sending...");
	});
	
	$(submitButton).on('click', validateForm);
	$('#email-warning').hide();
	$('#subject-warning').hide();
})(jQuery);