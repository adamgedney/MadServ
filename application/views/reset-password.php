		<div class="wrapper">
				<div class="landing-content-wrapper">
					<div class="landing-copy forgot-copy">
						<h2>Reset Your Password</h2>
						
						<p>You will not be able to log in to MadServ until you reset your password. Enter your new password below.</p> 
					</div><!-- /.landing-copy -->
				
					<div class="login-form forgot-form reset-form">
						<form action="/action_forgot_password/update_pass" method="post">
							<input name="password" type="password" placeholder="Password" autofocus="autofocus"/>
							<input name="password-again" type="password" placeholder="Password Again"/>
							<input type="hidden" name="user" value="<?=$un?>"/>
							<input id="login-submit-button" class="submit-button" type="submit" value="submit"/>
						</form>

						<p id="login-error-message"></p>
						<a id="forgot-pass" href="">forgot password?</a>
					</div><!-- /.login-form -->
				</div><!-- /.landing-content-wrapper -->				
		</div><!-- /.wrapper -->