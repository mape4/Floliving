<?php
/*
Template Name: Thanks Page

*/
 


?>
<!DOCTYPE html>
<html  xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8" />
<title>Thanks | Flo Living</title>

<!-- http://google.com/webmasters -->
<meta name="google-site-verification" content="" />

<!-- don't allow IE9 to render the site in compatibility mode. Dude. -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/landing_page/css/style.css" type="text/css" />
<!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>
<!--code for Facebook like button-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=213373938709760";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="container"> 
  <!-- Header-->
  <header id="header">
    <section class="wrapper clearfix">
      <section class="fb-like"> <fb:like href="https://www.facebook.com/FloLiving" send="false" layout="button_count" width="80" show_faces="false"></fb:like></section>
      <section class="logo"><a href="<?php bloginfo('url'); ?>/" class="png-bg">Floliving</a></section>
    </section>
  </header>
  <!-- /Header--> 
  <!-- Content-->
  <section id="content">
    <section class="wrapper">
      <section id="thanks" class="clearfix">
        <section class="title">
       
          <h1>thank you!</h1>
          <h2>you've taken the first step to get in the know and get in your FLO!</h2>
        </section>
        <section class="column">
          <h2>Here are your two free gifts:</h2>
          <ul>
            <li><a href="http://www.floliving.com/files/FLOHealthAssessment.pdf" target="_blank">FLO Health Assessment</a></li>
            <li><a href="http://www.floliving.com/files/ProductRemedies.pdf" target="_blank">FLO Fave Product Remedies</a></li>
          </ul>
          <p>We can't wait to share with you all the information, goodies, tips, videos etc., we've compiled over the past 10 years. Get ready to be inspired, get the best education about the science of your hormones, and connect with your power in purpose!</p>
          <p>If you are anything like us (and we know you are!), you need daily reminders and inspiration to keep you on track, so make sure and check us out on <a href="http://twitter.com/FLOliving" target="_blank">twitter</a>, <a href="https://www.facebook.com/FloLiving" target="_blank">facebook</a> and on our <a href="http://floliving.com/blog-2/" target="_blank">blog</a>.</p>
          <blockquote>
            <p>If you're really like us, you might be ready to start changing your life right now.</p>
            <p class="cite"><span>&nbsp;</span>we LOVE a woman who takes action</p>
          </blockquote>
        </section>
        <section class="column">
          <figure> <img src="<?php bloginfo('template_url'); ?>/landing_page/images/girls-image.png" alt="Girls Image" /> </figure>
          <a href="http://floliving.com/get-in-the-flo/" class="buy-btn"></a> <span class="arrow">&nbsp;</span> </section>
      </section>
    </section>
  </section>
  <!-- /Content--> 
  
  <!-- Footer-->
  <footer id="footer">
    <section class="wrapper clearfix">
      <ul class="clearfix">
        <li><a href="<?php bloginfo('url'); ?>/privacy-policy/">Privacy Policy</a></li>
        <li><a href="<?php bloginfo('url'); ?>/privacy-policy/">Terms of Use</a></li>
      </ul>
      <p>&copy; Flo Living 2012</p>
    </section>
    <!-- /Footer--> 
  </footer>
</div>
<script src="<?php bloginfo('template_url'); ?>/landing_page/js/jquery-1.7.1.min.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/landing_page/js/selectivizr-min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28535710-1']);
  _gaq.push(['_setDomainName', 'floliving.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>