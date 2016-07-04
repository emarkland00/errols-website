<?php
    session_start();

    $token = md5(uniqid(rand(), TRUE));
    $tokenTime = time();
    $expirationTimeInSec = $tokenTime + 10; // 30 secs from now
    $cookieVal = md5($token ^ $tokenTime);

    // sc == secure cookie
    if (setcookie('sc', $cookieVal, $expirationTimeInSec, "/", "localhost", true, true)) {
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = $tokenTime;
    }
?>

<!DOCTYPE HTML>
<!--
    Miniport by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Errol G. Markland Jr.</title>
        <meta name="description" content="The central hub for all things about Errol G. Markland Jr." />
        <meta name="keywords" content="Errol, Markland, Jr, Software, Developer, Computer, Engineer, CCNY, City College" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!--[if lte IE 8]><script src="/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="/style/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="/style/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="/style/ie9.css" /><![endif]-->
    </head>
    <body>

    <nav id="nav">
        <ul class="container">
            <li><a href="#top">Top</a></li>
            <li><a href="#articles">Articles</a></li>
            <!--
            <li><a href="#work">Work</a></li>
            <li><a href="#projects">Projects</a></li>
            -->
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <!-- Home -->
    <div class="wrapper style1 first">
        <article class="container" id="top">
            <div class="row">
                <div class="4u 12u(mobile)">
                    <span class="image fit">
                        <img src="/images/me.jpg" alt="My picture" />
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
                <div class="row" id="latest-entry-content">
                    <!--
                    <div class="4u 12u(mobile)">
                        <section class="box style1">
                            <h3>Lorem dolor tempus</h3>
                            <p>Ornare nulla proin odio consequat sapien vestibulum ipsum primis sed amet consequat lorem
                            dolore.</p>
                        </section>
                    </div>
                    -->
                </div>
            </div>
            <footer>
                <a href="#projects" class="button big scrolly">See some of my recent work</a>
            </footer>
        </article>
    </div>

    <!-- Projects -->
    <div class="wrapper style3">
        <article id="projects">
            <header>
                <h2>The re-construction is under way</h2>
            </header>

            <!--
            <div class="container">
                <div class="row">
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic01.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Magna feugiat</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic02.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Veroeros primis</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic03.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Lorem ipsum</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                </div>
                <div class="row">
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic04.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Tempus dolore</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic05.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Feugiat aliquam</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                    <div class="4u 12u(mobile)">
                        <article class="box style2">
                            <a href="#" class="image featured">
                                <img src="images/pic06.jpg" alt="" />
                            </a>
                            <h3>
                                <a href="#">Sed amet ornare</a>
                            </h3>
                            <p>Ornare nulla proin odio consequat.</p>
                        </article>
                    </div>
                </div>
            </div>

          <footer>
                <p>Thanks for your patience.</p>
                <a href="#contact" class="button big scrolly">Get in touch</a>
            </footer>
            -->
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
                        <form id='contact-form'>
                            <div>
                                <div class="row">
                                    <div class="6u 12u(mobile)">
                                        <input type="text" name="name" id="name" placeholder="Name" />
                                    </div>
                                    <div class="6u 12u(mobile)">
                                        <input type="text" name="email" id="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="12u">
                                        <input type="text" name="subject" id="subject" placeholder="Subject" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="12u">
                                        <textarea name="message" id="message" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="row 200%">
                                    <div class="12u">
                                        <ul class="actions">
                                            <li>
                                                <button type="submit" id='submit-button'>Send Message</button>
                                            </li>
                                            <li>
                                                <button type="reset" class="alt">Clear Form</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="12u">
                        <hr />
                        <h3>Find me on ...</h3>
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
                                <a href="https://github.com/emarkland" target="_blank" class="icon fa-github">
                                    <span class="label">Github</span>
                                </a>
                            </li>

                            <!--
                            <li>
                                <a href="#" class="icon fa-dribbble">
                                    <span class="label">Dribbble</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="icon fa-tumblr">
                                    <span class="label">Tumblr</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="icon fa-google-plus">
                                    <span class="label">Google+</span>
                                </a>
                            </li>

                            <li><a href="#" class="icon fa-rss"><span>RSS</span></a></li>

                            <li><a href="#" class="icon fa-foursquare"><span>Foursquare</span></a></li>
                            <li><a href="#" class="icon fa-skype"><span>Skype</span></a></li>
                            <li><a href="#" class="icon fa-soundcloud"><span>Soundcloud</span></a></li>
                            <li><a href="#" class="icon fa-youtube"><span>YouTube</span></a></li>
                            <li><a href="#" class="icon fa-blogger"><span>Blogger</span></a></li>
                            <li><a href="#" class="icon fa-flickr"><span>Flickr</span></a></li>
                            <li><a href="#" class="icon fa-vimeo"><span>Vimeo</span></a></li>
                            -->
                        </ul>
                        <hr />
                    </div>
                </div>
            </div>
            <footer>
                <ul id="copyright">
                    <!-- Show fun fact based on today's date. Use number's api? -->
                </ul>
            </footer>
        </article>
    </div>


    <!-- Scripts -->
    <script src="/js/libs/jquery-2.1.1.min.js"></script>
    <script src="/js/jquery.scrolly.min.js"></script>
    <script src="/js/libs/handlebars-v1.2.0.js"></script>
    <script src="/js/libs/moment.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.scrolly.min.js"></script>
    <script src="/js/skel.min.js"></script>
    <script src="/js/skel-viewport.min.js"></script>
    <script src="/js/util.js"></script>
    <!--[if lte IE 8]><script src="/js/ie/respond.min.js"></script><![endif]-->

    <script src="/js/main.js"></script></body>

    <script src="/js/latest-entry.js"></script>
    <script src="/js/contact.js"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-60762662-1', 'auto');
        ga('send', 'pageview');

    </script>
</html>
