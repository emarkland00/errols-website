(function($) {
	var submitButton = '#submit-button',
		submitButtonText = '#submit-button-text',
		warningSpeed = 150,
		warningStyle = 'swing';
	
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
		.done(function(data) {
            fadeFn(submitButtonText, 'Inquiry sent. Thanks!');
            $(submitButton).unbind('click');
        })
		.fail(function (data) {
            fadeFn(submitButtonText, 'Problem sending email...');
        });
	};
	
	var validateForm = function(e) {
        var show = function(elem) {
            $(elem).show(warningSpeed, warningStyle);
        },
        hide = function(elem) {
            $(elem).hide(warningSpeed, warningStyle);
        };

		e.preventDefault();
		var email = $('#email').val();
		if (!email || !email.length) {
            show('#email-warning');
			return;
		} else {
            hide('#email-warning');
		}
		
		var subject = $('#subject').val();		
		if (!subject || !subject.length) {
            show('#subject-warning');
			return;
		} else {
			hide('#subject-warning');
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
	
	//TODO: Make this work with submit()
	$(submitButton).submit(validateForm);
	$('#email-warning').hide();
	$('#subject-warning').hide();
})(jQuery);