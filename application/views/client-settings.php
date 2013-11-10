
		<div class="wrapper cms">
		<h1>Client Dashboard</h1>
		<div class="options">

			<a class="settings-icon" href="/cms/client_settings"><img src="/assets/img/settings-icon.png" alt="settings icon"/>  Account Settings</a>
		</div> <!-- /.options-->

		<div class="content">
				<div class="content-body">
					
					<div class="signup admin-update-form">
						<h2>Account Settings</h2>

						<form action="/action_client_update" method="post">
						<input id="new-client-name" type="text" name="name" placeholder="Full Name or Company" value="<?=$client[0]->appId?>" readonly/>
						<p id="name-error-email"></p>
						
						<input id="new-client-url" type="text" name="url" placeholder="Website URL" value="<?=$client[0]->url?>"/>
						<p id="url-error-email"></p>

						<input id="new-client-redirect-url" type="text" name="redirect-url" placeholder="Redirect URL (Get this right)" value="<?=$client[0]->redirect?>"/>
						<p id="redirect-url-error-email"></p>
						
						<input id="new-client-email" type="text" name="email" placeholder="Contact Email" value="<?=$client[0]->email?>"/>
						<p id="signup-error-email"></p>
						
						<input id="new-client-password" type="password" name="password" placeholder="Password"/>
						
						<input id="confirm-client-password" type="password" name="password-again" placeholder="Password Again"/>
						<p id="signup-error-password"></p>

						<input id="signup-submit-button" class="submit-button" type="submit" value="UPDATE SETTINGS"/>

							
						</form>

					</div><!-- /.signup -->

					<div class="signup user-delete">

						<h3 class="red"><img src="/assets/img/trash-icon.png" alt="trash icon"/> Delete Your Account?</h3>

						<form action="/action_client_delete" method="post">
							<input id="newPassword" type="password" name="password" placeholder="Password"/>
							<input id="confirmPassword" type="password" name="password-again" placeholder="Password Again"/>
							<p id="delete-error-password"></p>
							<input class="submit-button" type="submit" value="DELETE ACCOUNT"/>
						</form>
					</div><!-- /.user-delete-->
				</div><!-- /.content-body -->
			</div><!-- /.content -->

				
		</div><!-- /.wrapper about -->
			