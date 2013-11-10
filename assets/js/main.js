(function(){

$('#user-signup-form').submit(function(e){
	
	console.log('user reg submit clicked');

	var first = $('#newFirst').val();
	var last = $('#newLast').val();
	var email = $('#newEmail').val();
	var username = $('#newUser').val();
	var pass = $('#newPassword').val();
	var passagain = $('#confirmPassword').val();

	console.log(first + last + email + username +pass + passagain);
	//regex patterns
	var namePat = /^[A-Za-z0-9]+$/; //disallow commas
	var emailPat = /\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}/; // standard email validation
	var passPat = /[a-zA-Z]\w{3,14}/; //4-15 char abcd aBcd ac3D

	//clears the previous errors, if there were any
	$('.error').html('');

	//checks that passwords match
	if(pass === passagain){

		console.log('passwords match');

			//reg form validation conditions
			if( !emailPat.test(email) ){// EMAIL
				console.log('email not valid');
				e.preventDefault();
				$('#signup-email-error').css('opacity', '1').html("Email Invalid");

			}else if( !passPat.test(pass) ){// PASSWORD
				console.log('pass not valid');
				e.preventDefault();
				$('#signup-pass-error').css('opacity', '1').html("Password Invalid");

			}else if( !namePat.test(first) ){// FIRST NAME
				console.log('first not valid');
				e.preventDefault();
				$('#signup-first-error').css('opacity', '1').html("First name invalid. No special characters.");

			}else if( !namePat.test(last) ){// LAST NAME
				console.log('last not valid');
				e.preventDefault();
				$('#signup-last-error').css('opacity', '1').html("Last name invalid. No special characters.");

			}else if( !namePat.test(username) ){// USERNAME
				console.log('username not valid');
				e.preventDefault();
				$('#signup-un-error').css('opacity', '1').html("Username invalid. No special characters.");

			}else{

				console.log('validation passed in JS?');
				return "true";
			};//validation

	}else{
		console.log('passwords DONT match');
		e.preventDefault();
		$('#signup-pass-error').css('opacity', '1').html("Passwords Don't Match");

	};// passwords dont match
});// /user-signup-form






$('#client-signup-form').submit(function(e){
	
	console.log('client reg submit clicked');

	var name = $('#new-client-name').val();
	var url = $('#new-client-url').val();
	var email = $('#new-client-email').val();
	var pass = $('#new-client-password').val();
	var passagain = $('#confirm-client-password').val();


	//regex patterns
	var namePat = /^[A-Za-z0-9]+$/; //disallow commas
	var emailPat = /\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}/; // standard email validation
	var urlPat = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	var passPat = /[a-zA-Z]\w{3,14}/; //4-15 char abcd aBcd ac3D

	//clears the previous errors, if there were any
	$('.error').html('');

	//checks that passwords match
	if(pass === passagain){

		console.log('passwords match');

			//reg form validation conditions
			if( !emailPat.test(email) ){// EMAIL
				console.log('email not valid');
				e.preventDefault();
				$('#signup-error-email').css('opacity', '1').html("Email Invalid");

			}else if( !passPat.test(pass) ){// PASSWORD
				console.log('pass not valid');
				e.preventDefault();
				$('#signup-error-password').css('opacity', '1').html("Password Invalid");

			}else if( !namePat.test(name) ){// NAME
				console.log('first not valid');
				e.preventDefault();
				$('#signup-error-name').css('opacity', '1').html("Name invalid. No special characters");

			}else if( !urlPat.test(url) ){// URL
				console.log('url not valid');
				e.preventDefault();
				$('#signup-error-url').css('opacity', '1').html("URL invalid");

			}else{

				console.log('validation passed in JS?');
				return "true";

			};//validation

	}else{
		console.log('passwords DONT match');
		e.preventDefault();
		$('#signup-error-password').css('opacity', '1').html("Passwords Don't Match");

	};// passwords dont match
});// /client-signup-form




$('#login-form').submit(function(e){
	
	console.log('login submit clicked');

	var username = $('#username-login-field').val();
	var pass = $('#password-login-field').val();

	//regex patterns
	var namePat = /^[A-Za-z0-9]+$/; //disallow commas
	var passPat = /[a-zA-Z]\w{3,14}/; //4-15 char abcd aBcd ac3D

	//clears the previous errors, if there were any
	$('.error').html('');


			//reg form validation conditions
			if( !namePat.test(username) ){// EMAIL
				console.log('username not valid');
				e.preventDefault();
				$('#login-error').css('opacity', '1').html("Email or Password Invalid");

			}else if( !passPat.test(pass) ){// PASSWORD
				console.log('pass not valid');
				e.preventDefault();
				$('#login-error').css('opacity', '1').html("Email or Password Invalid");

			}else{

				console.log('validation passed in JS?');
				return "true";

			};//validation
});// /client-signup-form

})();


