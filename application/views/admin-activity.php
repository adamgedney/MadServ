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
							<li><a class="selected" href="/cms/admin_activity">Activity</a></li>
						</ul>
					</nav>

						<a class="settings-icon" href="/cms/admin_settings"><img src="/assets/img/settings-icon.png" alt="settings icon"/>  Account Settings</a>
				</div> <!-- /.options-->

				<div class="content">
				<div class="content-body">
					<div class="user-header">
						<p>App ID Used</p>
						<p>Requester</p>
						<p>IP</p>
						<p>Request Time</p>
					</div><!-- /.user-header -->
					
					<?php foreach($activitydata as $a) { ?>

						<div class="user-block">
							<p><?=$a->app_id?></p>
							<p><?=$a->requester?></p>
							<p><?=$a->ip?></p>
							<p><?=$a->request_time?></p>	
						</div><!-- /.user-block -->
					<?};?><!-- /endforeach-->
				</div><!-- /.content-body -->
			</div><!-- /.content -->
				
		</div><!-- /.wrapper about -->
			