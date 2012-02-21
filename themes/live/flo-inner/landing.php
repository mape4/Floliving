<?php
/*
Template Name: Landing Page
*/
require_once('store-address.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8" />
<title>Home | Flo Living</title>

<!-- http://google.com/webmasters -->
<meta name="google-site-verification" content="" />

<!-- don't allow IE9 to render the site in compatibility mode. Dude. -->
<link rel="stylesheet" href="http://www.floliving.com/wp-content/themes/flo-inner/landing_page/css/style.css" type="text/css" />
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

  <!-- Content-->
  <section id="content">
    <section class="wrapper">
      <section class="title">
        <h1>this is your health-changing moment</h1>
        <h2>your irresistible invitation to get in the FLO!</h2>
      </section>
      <section class="video"> <script type="text/javascript" src="http://content.bitsontherun.com/players/jo8cY9YD-YefH2EvN.js"></script> </section>
      <section class="newsletter">
        <h2><span>Sign up for our newsletter and immediately receive your gift of:</span></h2>
        <section class="benfits clearfix">
          <section class="column">
            <h2>The Flo Health Assessment</h2>
            <p>Find out in minutes if you are in the FLO, or how you're out of the FLO of your hormones.</p>
          </section>
          <section class="column">
            <h2>The FLO Fave Product + Remedies for <br />
              women's top 7 body complaints</h2>
            <p>If you want to do something  NOW about managing your symptoms</p>
          </section>
        </section>
      </section>
    </section>
  </section>
  <!-- /Content-->
  
  <section id="newsletter-form">
    <section class="wrapper"> 
      <section class="form">
        <section class="inner">
          <h2>We will never sell your e-mail address. We guarantee your confidentiality.</h2>
          <p>We hate spam as much as you do <span class="smile"></span></p>
          <!-- Begin MailChimp Signup Form -->
          
        <div id="mc_embed_signup">
        <form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" >
            
        <div class="mc-field-group">
           
            <input type="email" name="EMAIL" class="required email textbox" id="mce-EMAIL"  onBlur="if(this.value=='') this.value='Email';" onFocus="if(this.value=='Email') this.value='';" value="Email">
        </div>
        <input type="submit" value="&nbsp;" name="subscribe" id="mc-embedded-subscribe" class="submit">
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>
        </form>
        <?php if(isset($_POST) && $_POST['subscribe'] != '')
               	{  
        			//echo "<pre>";print_r($_REQUEST);echo "</pre>";
               		// Validation
        				if(!$_REQUEST['EMAIL']){ echo "No email address provided"; } 
        			
        				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_REQUEST['EMAIL'])) {
        					echo '<div class="error">Email address is invalid</div>'; 
        				}
        			
        				require_once('MCAPI.class.php');
        				// grab an API Key from http://admin.mailchimp.com/account/api/
        				$api = new MCAPI('68eda1d03d5a8a5176d40ebb20c666c9-us4');
        				
        				// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
        				// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
        				$list_id = "1ab4db6407";
        			
        				// Merge variables are the names of all of the fields your mailing list accepts
        				// Ex: first name is by default FNAME
        				// You can define the names of each merge variable in Lists > click the desired list > list settings > Merge tags for personalization
        				// Pass merge values to the API in an array as follows
        				$mergeVars = array();
        			
        				if($api->listSubscribe($list_id, $_REQUEST['EMAIL'], $mergeVars) === true) {
        					// It worked!	
        					 
        					//echo '<div class="success">Success! You are subscribed to this list now.</div>';
        					//header('Location: http://floliving.wordpressprojects.com/thanks/');
        					?>
                           <script type="text/javascript">
        						<!--
        						window.location = "http://www.floliving.com/thankyou/";
        						//-->
        						</script>
        					<?php //return Redirect::to('http://www.philipmccluskey.com/');
        					
        				}else{
        					// An error ocurred, return error message	
        					echo '<div class="error">Error: ' . $api->errorMessage.'</div>';
        				}
        					
               	} ?> 
        
        </div>

<!--End mc_embed_signup-->
        
          <span class="waiting-for">&nbsp;</span> </section>
      </section>
      <h2>This is the invitation you've been waiting for - Your invitation to:</h2>
      <ul>
        <li>
          <p>Know and nourish yourself as a woman</p>
        </li>
        <li>
          <p>To leverage your body as a tool to live your life to the fullest</p>
        </li>
        <li>
          <p>To rid your gorgeous female body of chronic gynecological issues</p>
        </li>
      </ul>
      <p>When you absolutely cannot settle for your symptoms anymore, Flo Living<br />
        provides the natural proven solution for the 3 conditions unique to women's <br />
        bodies: <strong>menstrual</strong>, <strong>fertility</strong> and <strong>energy/libido problems</strong>.</p>
    </section>
  </section>
  <!-- Footer-->
  <footer id="footer">
    <section class="wrapper clearfix">
      <ul class="clearfix">
        <li><a href="http://www.floliving.com/privacy-policy/">Privacy Policy</a></li>
        <li><a href="http://www.floliving.com/privacy-policy/">Terms of Use</a></li>
      </ul>
      <p>&copy; Flo Living 2012</p>
    </section>
  </footer>
</div>
<!-- /Footer--> 
<script src="<http://www.floliving.com/wp-content/themes/flo-inner/landing_page/js/jquery-1.7.1.min.js"></script> 
<script src="<http://www.floliving.com/wp-content/themes/flo-inner/landing_page/js/selectivizr-min.js"></script>
</body>
</html>