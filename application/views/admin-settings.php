
		<div class="wrapper cms">
		<h1>Admin Dashboard</h1>
		<div class="options">

		<nav>
			<ul>
				<li><a href="/cms/admin_ads">Ads</a></li>
				<li><a href="/cms/admin_users">Users</a></li>
				<li><a href="/cms/admin_user_log">User Log</a></li>
				<li><a href="/cms/admin_clients">Clients</a></li>
				<li><a href="/cms/admin_client_log">Client Log</a></li>
				<li><a href="/cms/admin_activity">Activity</a></li>
			</ul>
		</nav>

			<a class="settings-icon" href="/cms/admin_settings"><img src="/assets/img/settings-icon.png" alt="settings icon"/>  Account Settings</a>
		</div> <!-- /.options-->

		<div class="content">
				<div class="content-body">
					
					<div class="signup admin-update-form">
						<h2>Account Settings</h2>

						<form action="/action_admin_update" method="post">
							<input id="newFirst" type="text" name="first" placeholder="First Name" value="<?=$user[0]->first?>"/>
							<p id="first-error-email"></p>
							<input id="newLast" type="text" name="last" placeholder="Last Name" value="<?=$user[0]->last?>"/>
							<p id="last-error-email"></p>
							<input id="newEmail" type="text" name="email" placeholder="Email" value="<?=$user[0]->email?>"/>
							<p id="signup-error-email"></p>
							<input id="newUser" type="text" name="username" placeholder="Username" value="<?=$user[0]->username?>" readonly/>
							<p id="signup-error-un"></p>
							<input id="newPassword" type="password" name="password" placeholder="Password"/>
							<input id="confirmPassword" type="password" name="password-again" placeholder="Password Again"/>
							<p id="signup-error-password"></p>
							<input id="signup-submit-button" class="submit-button" type="submit" value="UPDATE SETTINGS"/>
							
						</form>

					</div><!-- /.signup -->

					<?php //foreach($clientdata as $c) { ?>

					<?//};?><!-- /endforeach-->
				</div><!-- /.content-body -->
			</div><!-- /.content -->

				
		</div><!-- /.wrapper about -->
			