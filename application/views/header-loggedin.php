<!DOCTYPE html>
<html lang="en">
<head>
	<title>MadServ | User Authentication & Ad Serving API</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link type="text/plain" rel="author" href="/humans.txt" />
	<link rel="shortcut icon" href="http://adamshields.com/favicon.ico" />
	<link rel="stylesheet" href="/assets/css/responsive-gs-12col.css" /><!-- resopnsive.gs grid system -->
	<link rel="stylesheet" href="/assets/css/ie.css" /><!-- resopnsive.gs grid system -->
	<link rel="stylesheet" href="/assets/css/main.css" />

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>
	<body>
		<header class="logged-in">
			<div class="header-inner">
				<a href="/"><img class="logo-small" src="/assets/img/logo-small.png" alt="header logo" /></a>
					
					<nav>
						<ul>
							<li><a href="/api">API</a></li>
							<li><a href="<?php
							
								if($this->session->userdata('permission') == "admin"){
									echo "/cms/admin";
								}else if($this->session->userdata('permission') == "user"){
									echo "/cms/user_settings";
								}else if($this->session->userdata('permission') == "client"){
									echo "/cms/client";
								}
							
							?>">ADMIN</a></li>
						</ul>
					</nav>

					
					<div class="login-form">
						<form action="/action_logout" method="post">
							<input id="login-submit-button" class="submit-button" type="submit" value="logout" />
						</form>
					</div><!-- /.login-form -->

					<p class="header-greeting" ><span class="light-blue">Welcome,</span> <?=$this->session->userdata('username')?></p>
			</div><!-- /.header-inner-->
		</header>