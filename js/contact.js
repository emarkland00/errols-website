(function($) {
    'use strict'

	var submitButton = '#submit-button';
    
	var processForm = function(json) {
		$.ajax({
			type: 'POST',
			url: '/handlers/contact.php',
			data: json,
			dataType: 'json'
		})
		.done(function(data) {
            $(submitButton).text('Sent email. Thanks!');
        })
		.fail(function (data) {
            $(submitButton).text('Problem sending email. Try again later.');
        })
        .always(function(data) {
            $(submitButton)
                .prop('disabled', true)
                .unbind();  
        });
	};
	
	var validateForm = function(e) {
		e.preventDefault();
		var email = $('#email').val();
		if (!email || !email.length) {
            console.log('Missing email address');
            return;
        }
		
		var subject = $('#subject').val();		
		if (!subject || !subject.length) {
           console.log('Missing subject');
		   return;
		}
		
		var message = $('#message').val();		
        if (!message || !message.length) {
            console.log('Missing email body');
            return;
        }
        
        var name = $('#name').val();
		var cc = $('#cc').is(':checked') ? 1 : 0;
		
        $(submitButton).text('Sending');
		processForm({
            name: name,
			email: email,
			subject: subject,
			message: message,
			cc: cc
		});
	};
	
	//TODO: Make this work with submit()
	$(submitButton).click(validateForm);	
})(jQuery);