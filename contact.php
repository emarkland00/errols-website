<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Errol G. Markland Jr.</title>
		<meta name="description" content="The central hub for all things about Errol G. Markland Jr." />
		<meta name="keywords" content="Errol, Markland, Jr, Software, Developer, Computer, Engineer, CCNY, City College, NSBE, ACM, New York" />
		<link href='/style/style.css' type='text/css' rel='stylesheet' media="screen" />
		<link href="/style/mobile.css" type="text/css" rel="stylesheet" media="screen and (max-width: 480px)" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	</head>
	<body>
		<div id="page">
			<div id="header">
				Errol G. Markland Jr.
			</div>	
			<div class="separator"> </div>

			<div id="navigation">
				<ul>
					<li class='nav-item'><a href="/">Home</a></li>
					<li class='nav-item'><a href="/resume.php" title="About me!">Resume</a></li>
					<li class='nav-item'><a href="/projects.php" title="Check out some of my projects!">Projects</a></li>
					<li class='nav-item' id="active-nav-item" title="Currently on this page"><a href="/contact.php">Contact</a></li>
				</ul>
			</div>
			<div class="separator"> </div>
			<div class="content">
				<div id="contact-form">
					<p>Got questions? Contact me!</p>
					
					<div class="form-item">
						<input type="text" placeholder="Your Email Address" id="email" />
						<div id="email-warning">Email can't be empty.</div>
					</div>
					
					<div class="form-item">
						<input type="text" placeholder="Message Subject" id="subject" />
						<div id="subject-warning">Subject can't be empty</div>
					</div>
					
					<div class="form-item">
						<textarea placeholder="Details on subject matter" id="details"></textarea>
					</div>
					
					<div class="form-item">
					    <span id="copy">
    					    <input type="checkbox" id="cc" checked /> Send a copy to my inbox
    					</span>
					</div>
					
					<div class="form-item">
					    <div id="submit-button">
					        <div id="submit-button-text">Send</div>
					    </div>
					</div>
				</div>
				
				<div id="social-links">
					<p>Find me on these networks</p>
					<div id="social-icon-container">
						<a href="https://www.facebook.com/emark00" target="_blank">
							<div class="social-icon">
								<br /><img src="/images/fb_logo.png" alt="Facebook" />
						 	</div>
					 	</a>
					 	
					 	<a href="https://plus.google.com/100925522890315697168/about/p/pub" target="_blank">
						 	<div class="social-icon">
						 		<br /><img src="/images/gplus_logo1.png" alt="Google+" />
						 	</div>
					 	</a>
					 	
					 	<a href="http://www.linkedin.com/pub/errol-markland/31/674/809" target="_blank">
						 	<div class="social-icon"><br />
						 		<img src="/images/linkedin_logo1.png" alt="LinkedIn" />
						 	</div>
					 	</a>
					 	
					 	<a href="https://twitter.com/mr_markland" target="_blank">
						 	<div class="social-icon"><br />
						 		<img src="/images/twitter_logo1.png" alt="Twitter" />
						 	</div>
					 	</a>
					 	<div class="clearer"></div>
				 	</div>
				 </div>
				 <div class="clearer"></div>
			</div>
		</div>
		
		<script type="text/javascript" src="/js/libs/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="/js/contact.js"></script>
	</body>	
</html>