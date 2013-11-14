		<div class="wrapper about">
		
			<div class="signup client-signup">
				<h2>Sign up <span class="small-text">for an API key</span></h2>

					<form action="action_client_registration" id="client-signup-form" method="post">
						<input id="new-client-name" type="text" name="name" placeholder="Full Name or Company"/>
						<p id="signup-error-name" class="error"></p>
						
						<select id="new-client-adtype" name="keyword" value="">
							<option value="" readonly required>Company Services</option>
							<option value="Food">Food</option>
							<option value="Clothes">Clothing</option>
						</select>
						
						<input id="new-client-url" type="text" name="url" placeholder="http://yourwebsite.com"/>
						<p id="signup-error-url" class="error"></p>
						
						<input id="new-client-email" type="text" name="email" placeholder="Contact Email"/>
						<p id="signup-error-email" class="error"></p>
						
						<input id="new-client-password" type="password" name="password" placeholder="Password"/>
						
						<input id="confirm-client-password" type="password" name="password-again" placeholder="Password Again"/>
						<p id="signup-error-password" class="error"></p>

						<input id="signup-submit-button" class="submit-button" type="submit"/>
					</form>
			</div><!-- /.signup -->

			<div class="instructions">
				<h2>API Documentation</h2>
				<p>If you'd like to add the "Sign in with MadServ" button to your web app, you've come to the right place.</p>
				
				<p><b>Our API is extremely easy to use.</b> We've done all the hard work for you. Just <a href="/assets/downloads/madserv1.1.zip">download this zip file,</a> and install its request.php file into your models folder. Make a few tweaks, and you're in business!</p>

				<a class="api-dl-link" href="/assets/downloads/madserv1.1.zip">Download MadServ 1.1</a>

				<h3>Let's get started</h3>
				<p>There is very little you have to do to implement the MadServ API. All of the tough authentication and callback programming has been done for you.
				In the zip file you downloaded, you'll see a button file named login.jpg. You can use that image on your page, or feel free to make your own "log in with" button.</p>
				

				<a class="button-demo" href=""><img src="/assets/img/login.jpg" alt="Login with MadServ Button"/></a>

				<p>Here is how you would typically use an image as a button. (If you didn't already know ;)</p>
				<xmp><a href="?controller=request"><img src="/assets/img/login.jpg" alt="Login with MadServ Button"/></a></xmp>
				<p>In your case, the href="" in the anchor element is going to target your controller file to include or load the request.php model file we provided.</p>

				<p>You only need to edit lines 17, 18, & 22 in the request.php model file. You need to replace the placeholder $key and $app_id values with the Key and App ID we sent you when you signed up using the form on this page, and you need to tell MadServ where you'd like to return your user to after authentication.
				That's all you have to do with that file!</p>

				<h3>Here's what happens...</h3>
				<img src="/assets/img/Auth_Diagram.png" alt="Authentication Process Diagram"/>

				<p>When a user comes to your website and clicks the "Login With MadServ" button or link, your href will target your controller as I mentioned above. You will then load the request.php model file from the controller. Once the model has been loaded, it will automatically make a call to the MadServ API, passing along your $app_id so we can authenticate your web app (Client) that's trying to access the API. Once your app has been authenticated, we will return a "$secret" token back to your app. Your app then checks the secret to validate that the callback originated from the API and not from some evil hacker named Mike somewhere.</p> 
				<p><span class="bold">Once your app authenticates the API,</span> it will redirect your user to a login page on our servers. Your user will log in to the account he has previously made with our service. When the user has been authenticated by our service, we will return the user to the redirect address you provided. Attached to this redirect is some basic encrypted data about the user. You will be receiving the user's first name, username, and email address. The user has agreed to allow affiliated client web apps like yours to use these identifications on their website as the site sees fit. These data variables are located in the user_data function inside the decryption-controller.php file you download with the .zip.</p>
				
				<p>All that magic happens behind the scenes though. You may have been sweating a bit, but don't worry, I just thought it would be good to explain what is happening when your user clicks that "Login with" button.</p>
				<p><span class="bold">Next up is that scary api.php file.</span> Api.ph is a controller file. In it, you will find an example of how to handle the API callbacks. In our tests, we used simple $_GET[] variables to catch the incoming data. Line 34 (if(isset($_GET['en'])){) is required to catch and decode the encrypted response from the API. When we call back to your web app after authenticating the user, this script will run. The section was written primarily to decrypt the encrypted data coming back to your web app, and provide you will a few variables containing basic user data. At the start of the script, you will have to replace the placeholder $app_id value with your App ID. You will not be able to decrypt data without this. The encryption/decryption key is unique to you and you alone.</p>
				
				<h3>Advertisement Delivery</h3>
				<p>When you become an affiliate, you too can earn money through your website with our easy advertisement delivery system. It is lightweight targetted ads that require no plugins or bandwidth from your site. All you do is add your application id to the end of the source command like so:</p>
				<p><code>&lt;img src='http://madserv.us/adserv/postpic/123exampleId' /&gt;</code></p>
				<p>Just slide that piece of code where you want your ads delivered to on your site and you're done!</p>

				<xmp>
				
				</xmp>
			</div><!-- /.instructions -->
				
		</div><!-- /.wrapper about -->
			