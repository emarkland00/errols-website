(function($) {
	var submitButton = '#submit-button',
		submitButtonText = '#submit-button-text',
		warningSpeed = 150,
		warningStyle = 'swing';
	
	var success = function(data) {
		fadeFn(submitButtonText, 'Inquiry sent. Thanks!');
		$(submitButton).unbind('click');
	}, 
	failure = function (data) {
		fadeFn(submitButtonText, 'Problem sending email...');
	};
	
	var fadeFn = function(elem, afterText, callback) {
		var fadeStyle = 'swing',
			elemFadeIn = function(callback) {
			$(elem).fadeIn({
				easing: fadeStyle,
				complete: callback || function() { }
			});
		};
		
		$(elem).fadeOut({
			easing: fadeStyle,
			complete: function() {
				$(elem).html(afterText);
				elemFadeIn(callback);
			}
		});
	};
	
	var processForm = function(json) {
		$.ajax({
			type: 'POST',
			url: '/handlers/contact',
			data: json,
			dataType: 'json'
		})
		.done(success)
		.fail(failure);
	};
	
	var validateForm = function(e) {
		e.preventDefault();
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
		
		fadeFn(submitButtonText, 'Sending', processForm({
			email: email,
			subject: subject,
			details: details,
			cc: cc
		}));
	};
	
	$(submitButton).submit(validateForm);
	$('#email-warning').hide();
	$('#subject-warning').hide();
})(jQuery);