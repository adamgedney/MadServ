		<div class="wrapper cms">
			<h1>Admin Dashboard</h1>
				<div class="options">

					<nav>
						<ul>
							<li><a href="/cms/admin_ads">Ads</a></li>
							<li><a href="/cms/admin_users">Users</a></li>
							<li><a href="/cms/admin_user_log">User Log</a></li>
							<li><a class="selected" href="/cms/admin_clients">Clients</a></li>
							<li><a href="/cms/admin_client_log">Client Log</a></li>
							<li><a href="/cms/admin_activity">Activity</a></li>
						</ul>
					</nav>

						<a class="settings-icon" href="/cms/admin_settings"><img src="/assets/img/settings-icon.png" alt="settings icon"/>  Account Settings</a>
				
				</div> <!-- /.options-->
				
			<div class="content">
				<div class="content-body">
					<div class="user-header">
						<p>Company</p>
						<p>Joined</p>
						<p>App Id</p>
						<p>URL</p>
						<p>Status</p>
						<p>Block Client?</p>
					</div><!-- /.user-header -->
					
					<?php foreach($clientdata as $c) { ?>

						<div class="user-block">
							<p><?=$c->company?></p>
							<p><?=$c->joined?></p>
							<p><?=$c->appId?></p>
							<p><?=$c->url?></p>
							<p><?=$c->status?></p>
							
								<form action="/cms/block_client" method="post">

									<input name="block-client" type="checkbox" value="block" <?=$c->blocked?>/>
									<input type="hidden" name="appid" value="<?=$c->appId?>"/>
									<input type="submit" value="SAVE"/>

								</form>
							
						</div><!-- /.user-block -->
					<?};?><!-- /endforeach-->
				</div><!-- /.content-body -->
			</div><!-- /.content -->	

		</div><!-- /.wrapper cms -->
			