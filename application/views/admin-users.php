
		<div class="wrapper cms">
			<h1>Admin Dashboard</h1>
				
				<div class="options">

					<nav>
						<ul>
							<li><a href="/cms/admin_ads">Ads</a></li>
							<li><a class="selected" href="/cms/admin_users">Users</a></li>
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

					<div class="user-header">
						<p>Username</p>
						<p>First</p>
						<p>Last</p>
						<p>Joined</p>
						<p>Status</p>
						<p>Block User?</p>
					</div><!-- /.user-header -->
						
						<?php foreach($userdata as $u) { ?>

							<div class="user-block">
								<p><?=$u->username?></p>
								<p><?=$u->first?></p>
								<p><?=$u->last?></p>
								<p><?=$u->joined?></p>
								<p><?=$u->userstatus?></p>
								
									<form action="/cms/block_user" method="post">

										<input name="block-user" type="checkbox" value="block" <?=$u->userblocked?>/>
										<input type="hidden" name="un" value="<?=$u->username?>"/>
										<input type="submit" value="SAVE"/>

									</form>
								
							</div><!-- /.user-block -->
						<?};?> <!-- /end foreach -->
				</div><!-- /.content-body -->
			</div><!-- /.content -->	

		</div><!-- /.wrapper cms -->
			