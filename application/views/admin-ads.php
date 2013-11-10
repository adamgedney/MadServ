		<div class="wrapper cms">
			<h1>Admin Dashboard</h1>
				<div class="options">

					<nav>
						<ul>
							<li><a class="selected" href="/cms/admin_ads">Ads</a></li>
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
					<div class="user-header">
						<p>Ad</p>
						<p>Views</p>
						<p>Unique</p>
						<p>Keyword</p>
						<p>Refferal Site</p>
					</div><!-- /.user-header -->
					
					<?php foreach($adlog as $d) { ?>

						<div class="user-block">
							<p><img src="/assets/img/<?=$d['kword']?>/<?=$d['picture']?>" width="100" /></p>
							<p><?=$d['hits']?></p>
							<p><?=$d['unihits']?></p>
							<p><?=$d['kword']?></p>
							<p><?=$d['comp']?></p>
							
						</div><!-- /.user-block -->
					<?};?><!-- /endforeach-->
				</div><!-- /.content-body -->
			</div><!-- /.content -->
				
		</div><!-- /.wrapper about -->
			