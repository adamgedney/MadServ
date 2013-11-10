<!DOCTYPE html>
<html lang="en">
<head>
	<title>MadServ | User Authentication & Ad Serving API</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link type="text/plain" rel="author" href="/humans.txt" />
	<link rel="shortcut icon" href="http://adamshields.com/favicon.ico" />

	<!--Google Fonts Roboto Slab & Roboto -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab|Roboto:400,100,300,500' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/assets/css/responsive-gs-12col.css" /><!-- resopnsive.gs grid system -->
	<link rel="stylesheet" href="/assets/css/ie.css" /><!-- resopnsive.gs grid system -->
	<link rel="stylesheet" href="/assets/css/main.css" />

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>
	<body>
		<header>
			<div class="header-inner">
				<a href="/"><img class="logo-small" src="/assets/img/logo-small.png" alt="header logo" /></a>
					
					<nav>
						<ul>
							<li><a href="/api">API</a></li>
						</ul>
					</nav>

					<div class="login-form">
						<form action="action_login" id="login-form" method="post">
						
						<div class="keep-me">
							<p>Keep me logged in?</p>
							<input type="checkbox" name="keep-me" checked="checked">
						</div><!-- /.keep-me-->

								<input id="username-login-field" name="username" type="text" placeholder="Username or ID" autofocus="autofocus"/>

								<input id="password-login-field" name="password" type="password" placeholder="Password"/>

								<input id="login-submit-button" class="submit-button" type="submit" value="submit" />
								<p id="login-error" class="error"></p>
						</form>
						
						<a id="forgot-pass" href="action_forgot_password">forgot password?</a>
					</div><!-- /.login-form -->
			</div><!-- /.header-inner-->
		</header>