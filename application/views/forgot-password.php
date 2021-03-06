		<div class="wrapper">
				<div class="landing-content-wrapper">
					<div class="landing-copy forgot-copy">
						<h2>Forgot your password?</h2>
						
						<p>Enter your username and click submit. We will send an email to the email address you signed up with. You will then be directed to click a link in the email that will take you to reset your password.</p> 
					</div><!-- /.landing-copy -->
				
					<div class="login-form forgot-form">
						<form action="/action_forgot_password/request_reset" method="post">
							<input name="username" type="text" placeholder="Username" autofocus="autofocus"/>
							<input id="login-submit-button" class="submit-button" type="submit" value="submit"/>
						</form>

						<p id="login-error-message"></p>
						<a id="forgot-pass" href="">forgot password?</a>
					</div><!-- /.login-form -->
				</div><!-- /.landing-content-wrapper -->				
		</div><!-- /.wrapper -->