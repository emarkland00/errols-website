<?php
    session_start();

    $token = md5(uniqid(rand(), TRUE));
    $tokenTime = time();
    $expirationTimeInSec = $tokenTime + 10; // 30 secs from now
    $cookieVal = md5($token ^ $tokenTime);

    $serverName = $_SERVER['SERVER_NAME'];
    $secureCookie = true;
    $httpOnlyCookie = true;
    if (in_array($serverName, array("localhost", "127.0.0.1", "::1"))) {
	     $secureCookie = false;
       $httpOnlyCookie = false;
    }

    if (setcookie('sc', $cookieVal, $expirationTimeInSec, "/", $_SERVER['SERVER_NAME'], $secureCookie, $httpOnlyCookie)) {
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = $tokenTime;
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Errol G. Markland Jr.</title>
        <meta name="description" content="The central hub for all things about Errol G. Markland Jr." />
        <meta name="keywords" content="Errol, Markland, Jr, Software, Developer, Computer, Engineer, CCNY, City College" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!--[if lte IE 8]><script src="/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="style/main.css" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="author" href="humans.txt" />
        <!--[if lte IE 8]><link rel="stylesheet" href="/style/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="/style/ie9.css" /><![endif]-->
    </head>
    <body>
        <nav id="nav">
            <ul class="container">
                <li><a href="#top">Top</a></li>
                <li><a href="#articles">Articles</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="errol_resume.pdf">Resume</a></li>
            </ul>
        </nav>

        <!-- Home -->
        <div class="wrapper style1 first">
            <article class="container" id="top">
                <div class="row">
                    <div class="4u 12u(mobile)">
                        <span class="image fit">
                            <img src="images/me_jan_2017.jpg" alt="My picture" />
                        </span>
                    </div>
                    <div class="8u 12u(mobile)">
                        <header>
                            <h1>Hi. I&#39;m
                            <strong>Errol G. Markland Jr.</strong>.</h1>
                        </header>
                        <p>A developer who likes to explore the various venues of technology.</p>
                        <a href="#contact" class="button big scrolly">Get in touch</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Articles -->
        <div class="wrapper style2">
            <article id="articles">
                <header>
                    <h2>Here are some articles I've read lately.</h2>
                </header>
                <div class="container" id="latest-articles">
                    <div class="row" id="latest-entry-content"></div>
                </div>
                <footer>
                    Powered by the <a href="https://getpocket.com/" target="_blank">Pocket API</a>.
                </footer>
            </article>
        </div>

        <!-- Projects -->
        <div class="wrapper style3">
            <article id="projects">
                <header>
                  <h2>Projects</h2>
                  <p>
      			      Some of the projects I've worked on can be found at my
                      <a href="https://github.com/emarkland00" target="_blank">Github</a>.
      			  </p>
      			  <p>In the future, I'll make life a bit easier by actually listing the projects I've done here.</p>
                </header>
            </article>
        </div>

        <!-- Contact -->
        <div class="wrapper style4">
            <article id="contact" class="container 75%">
                <header>
                    <h2>Let's chat!</h2>
                    <p>Feel free to reach out to me. Whether if its to network, to do some business, or even just to say hey.</p>
                </header>
                <div>
                    <div class="row">
                        <div class="12u">
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/emark00" target="_blank" class="icon fa-facebook">
                                        <span class="label">Facebook</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://twitter.com/mr_markland" target="_blank" class="icon fa-twitter">
                                        <span class="label">Twitter</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.instagram.com/mr_markland/" target="_blank" class="icon fa-instagram">
                                        <span class="label">Instagram</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.linkedin.com/in/errol-markland-80967431" target="_blank" class="icon fa-linkedin">
                                        <span class="label">LinkedIn</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://github.com/emarkland00" target="_blank" class="icon fa-github">
                                        <span class="label">Github</span>
                                    </a>
                                </li>
                            </ul>
                            <hr />
                        </div>
                    </div>
                </div>
                <footer>
                    <ul id="copyright">
                    	&copy; 2018 Errol Markland. All rights reserved.
                        <!-- Show fun fact based on today's date. Use number's api? -->
                    </ul>
                    <a href="humans.txt"><img src="images/humanstxt.png"></a>
                </footer>
            </article>
        </div>

        <!-- Scripts -->
        <script src="js/libs/jquery-2.1.1.min.js"></script>
        <script src="js/jquery.scrolly.min.js"></script>
        <script src="js/libs/handlebars-v4.0.5.js"></script>
        <script src="js/libs/moment.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.scrolly.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-viewport.min.js"></script>
        <script src="js/util.js"></script>
        <script src="js/main.js"></script>
        <!--[if lte IE 8]><script src="/js/ie/respond.min.js"></script><![endif]-->

        <script src="js/article-template.js"></script>
        <script src="js/latest-entry.js"></script>

        <!-- Google Analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-60762662-1', 'auto');
        ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->
    </body>
</html>

<!--
    Miniport by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
