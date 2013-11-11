		<div class="wrapper">
			<div class="landing-content-wrapper">
				<div class="landing-copy forgot-copy">
					<h2>Sign in with MadServ</h2>
					
					<p>Enter your username and password, then click submit. Your info is always secure with MadServ.</p> 
				</div><!-- /.landing-copy -->
			
				<div class="login-form forgot-form">
					<form action="/api_request/user_login_auth/<?=$data?>" method="post">
						<input name="username" type="text" placeholder="Username" autofocus="autofocus"/>
						<input name="password" type="password" placeholder="Password"/>
						<input id="login-submit-button" class="submit-button" type="submit" value="submit"/>
					
					</form>
					<p id="login-error-message"></p>
					<a id="forgot-pass" href="">forgot password?</a>
				</div><!-- /.login-form -->
			</div><!-- /.landing-content-wrapper -->				
		</div><!-- /.wrapper -->