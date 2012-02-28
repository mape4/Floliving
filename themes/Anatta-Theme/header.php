<!DOCTYPE html>
<!--[if lte IE 7]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 7)|!(IE)]><! -->
<html <?php language_attributes(); ?>>
<!-- <![endif]-->
<head>
<meta charset="utf-8" />
<title>
<?php wp_title(''); ?>
</title>
<?php wp_head(); ?>
<!-- http://google.com/webmasters -->
<meta name="google-site-verification" content="" />
<!-- don't allow IE9 to render the site in compatibility mode. Dude. -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/anatta.jpg" type="image/x-icon" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
<!--[if lt IE 9]>
		<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie.css"/>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>: Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php //if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>
<body>
<!-- Container -->
<!-- Header -->
<?php 
		$request_uri = explode('/',$_SERVER['REQUEST_URI']);
		$request_uris = $request_uri[1];
		?>
<?php if ( is_page('logged-out') || is_page('registration') || is_page(login) || ($request_uris == 'wishlist-member')) 
	    { ?>
<header id="header">
  <div class="wrapper clearfix">
    <div class="logo">
      <h1><a href="<?php bloginfo('url'); ?>" rel="home" title="Go to homepage">Flo Livings</a></h1>
    </div>
  </div>
</header>
<? } 
	    else 
	    {
	       // This is a paginated page.
	    
	  
	    ?>
<header id="header">
  <div class="wrapper clearfix">
    <section class="clearfix">
      <ul class="top-navigation">
        <li><a href="mailto:support@floliving.zendesk.com">Need Help/Support?</a></li>
        <?php if(is_user_logged_in()) { 
				 $user = wp_get_current_user();
				 ?>
        <li><a href="<?php bloginfo('url');?>/my-account/">My Account</a></li>
        <li>
          <?php wp_loginout(); ?>
        </li>
        <?php } ?>
      </ul>
    </section>
    <h2 class="tagline">Hormonal Sync System&#x2122;</h2>
    <div class="logo">
      <h1><a href="<?php bloginfo('url'); ?>" rel="home" title="Go to homepage">Flo Livings</a></h1>
    </div>
  </div>
</header>
<!-- /Header -->
<!-- Navigation -->
<nav id="menu">
  <div class="menu-content">
    <?php 
			 if(is_user_logged_in()) { 
            	$user = wp_get_current_user();
    			 $levels = WLMAPI::GetUserLevels($user->ID);
            	$key=array_keys($levels);
				//echo "<pre>";print_r($key);echo "</pre>";
				$module=array();
				foreach($key as $val)
				{
					$module[]=$val;
				}
     		}
			?>
    <span>The 7 Healing Sessions:</span>
    
    <div class="menu-top-menu-container">
      <ul class="menu" id="menu-top-menu">
      <?php if(in_array('1318527158',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-167" id="menu-item-167"><a href="<?php bloginfo('url'); ?>/course/the-sweet-spot-2/">1. The Sweet Spot</a></li>
        <?php } if(in_array('1325103268',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-164" id="menu-item-164"><a href="<?php bloginfo('url'); ?>/course/eating-in-the-flow/">2. Eating in the FLO</a></li>
        <?php } if(in_array('1326486687',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-166" id="menu-item-166"><a href="<?php bloginfo('url'); ?>/course/the-big-three-2/">3. Stress</a></li>
        <?php } if(in_array('1326486715',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-168" id="menu-item-168"><a href="<?php bloginfo('url'); ?>/course/this-is-personal-2/">4. This Is Personal</a></li>
        <?php } if(in_array('1326486742',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-171" id="menu-item-171"><a href="<?php bloginfo('url'); ?>/course/harnessing-the-power-in-your-panties/">5. Harnessing the Power in Your Panties!</a></li>
        <?php } if(in_array('1326486784',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-170" id="menu-item-170"><a href="<?php bloginfo('url'); ?>/course/free-yourself-2/">6. Free Yourself!</a></li>
        <?php } if(in_array('1326486833',$module)) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-course menu-item-169" id="menu-item-169"><a href="<?php bloginfo('url'); ?>/course/flo-living-2/">7. FLO Living</a></li>
  		<?php } ?>
      </ul>
    </div>
    <?php //wp_nav_menu(); ?>
  </div>
</nav>
<!-- /Navigation -->
<? } ?>
