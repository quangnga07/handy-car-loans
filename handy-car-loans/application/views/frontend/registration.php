<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registration Form</title>

	<style type="text/css">
		* { font-size: 12px; color: 000; }
		input { 
			border: 1px solid #ccc;
			padding: 4px;
			border-radius: 4px;
		}
		input[type="submit"] { cursor: pointer; }
		form { width: 300px; }
		.error { 
			border: 1px solid red;
			padding: 6px;
			color: red;
			text-align: center;
		}
		.check { 
			border: 1px solid green;
			padding: 6px;
			color: #009900;
			text-align: center;
		}
		.hidden { display: none; }
	</style>
</head>
<body>
	<form method='POST' id='apply-form'>
		<p class='message hidden'></p>

		<span><label><input type='radio' name='title' value='Mr'/> Mr</label></span>
		<span><label><input type='radio' name='title' value='Mrs'/> Mrs</label></span>
		<span><label><input type='radio' name='title' value='Ms'/> Ms</label></span>
		<span><label><input type='radio' name='title' value='Other'/> Other</label></span>
		<br/><br/>

		<input type='text' name='fname' id='fn' />
		<input type='text' name='lname' id='ln' />
		<br/><p></p>
		<input type='text' name='phone' id='phone' />
		<input type='text' name='email' id='eml' />

		<br/><br/>
		<span><label><input type='checkbox' name='agree' value='yes'/> I have read and agree to Terms of Use</label></span>
		<br/><br/>
		<input type='submit' value='Apply Now' name='submit' />
	</form>

<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.watermark.min.js"></script>
<script type='text/javascript'>
	jQuery(function($){
	//---------
		//--------- init
		var applyForm  = $('#apply-form');
		var waterFn    = $('#fn');
		var waterLn    = $('#ln');
		var waterPhone = $('#phone');
		var waterEmail = $('#eml');

		//---------
		waterFn.watermark('First Name');
		waterLn.watermark('Last Name');
		waterPhone.watermark('Phone');
		waterEmail.watermark('Email');
		
		//---------
		applyForm.live('submit', function(e){
			var hasValue = true;
			var input    = $('#apply-form input[type=text]');
			var message  = $('.message');
			var email    = $('#eml');

			//--------- checks if email is valid
			var eml      = email.val();
			var atPos    = eml.indexOf("@");
			var stopPos  = eml.lastIndexOf(".");  

			if( atPos == -1 || stopPos == -1) {
				hasValue = false;
				message
				.removeClass('hidden')
				.removeClass('check')
				.text('Email address is not valid.')
				.addClass('error');
			}

			//--------- checks for empty fields on the registration form
			input.each(function(){
				var _this  = $(this);
				var radio  = $('input[name="title"]:checked');
				var chkbox = $('input[name="agree"]:checked');

				if( _this.val() == '' || !radio.val() || !chkbox.val() ) {
					hasValue = false;
					message
					.removeClass('hidden')
					.removeClass('check')
					.text('Please fill-up all the fields.')
					.addClass('error');
				}
			});

			if( hasValue ) {
				$.ajax({
					url        : '<?php echo site_url("registration/apply");?>',
					type       : 'POST',
					data       : $(this).serialize(),
					beforeSend : function() {
						message
						.removeClass('error')
						.removeClass('hidden')
						.text('Processing... Please wait.')
						.addClass('check');
					},
					success    : function( response ) {
						message
						.removeClass('error')
						.removeClass('check')
						.addClass('hidden');

						if( response == '' ) {
							// existing user and finished with the steps
						}
						else if( response == '' ) {
							// existing user but not yet finish with the steps
						} else {
							// new user
						}
					}
				});
			}

			e.preventDefault();
			return false;
		});
	//---------
	});
</script>
</body>
</html>