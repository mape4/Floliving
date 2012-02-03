<?php
/*
Template Name: AboutFloLiving
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>flo living</title>
<link href="stylesheet/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixRt #sidebar1 { width: 220px; }
</style>
<![endif]-->
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixRt #sidebar1 { padding-top: 30px; }
.twoColFixRt #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="../../../stylesheet/styles.css" rel="stylesheet" type="text/css" />
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
</head>
<body class="twoColFixRt">
<div id="container-inner">
  <?php include ('header-links.php'); ?>
  <div style="height:70px; width:980px;"><img src="../../images/about-head.jpg" width="331" height="77" hspace="10" /></div>
  <?php get_sidebar(); ?>
  <? /* php include ('sidebar-innerpage.php'); */ ?>
  <div id="mainContent-inner">
    <div style="padding-left:36px; padding-right:24px;"> <strong><br />
      <img src="../../images/flobox5b.jpg" width="199" height="174" hspace="5" align="left" />Flo Living is an Evolution in Women’s Healthcare <br>founded by <a href="http://www.floliving.com/?page_id=82">Alisa Vitti HHC, AADP!</a><br />
      <br />
      Our center has worked with thousands of women in four continents, helping them regain their hormonal balance, get pregnant naturally, lose weight, clear skin, heal cystic ovaries, eliminate PMS, heal fibroids, regulate periods, and have healthy libido after menopause. <br />
      <br />
      More than that, we help women live their best and most powerful lives with health as their foundation.<br />
      <br />
      Founded nine years ago</strong>, our mission is to debunk myths around women's chronic gynecological issues and to teach women how to have better health and better sex through our five-step proprietary nutritional and lifestyle protocol. <br />
      <br />
      We believe that women deserve to know there is another optionbesides drugs, surgery or “come back in six months for another check up.”<br />
      <br />
      Flo Living is the number one, trusted destination and pathway for comprehensive, life-changing, holistic women’s healthcare.<br />
      <br />
the FLO Living Virtual Center puts YOU in the drivers seat of your hormonal self care every day.
Our Virtual Center is dedicated to providing you with Free FLO Resources to give you education and information about your body, biology, nutrition, and feminine energy in the form of our blog, newsletter, free ebooks, free audio, and free video! <br />
<br />
In order to learn HOW to use our 5 step protocol and begin your own healing journey from the comfort of your own home, we have created our FLO Products - and our first product is the distillation of 9 years of helping thousands of women just like you to recover from the conditions you are here to seek solutions for!<br />
<br />
We wanted to create a way for you to get the support you need anytime you desired it and affordably!!  FLO Support was born out of your desire for more support!!<br />
<br />
      What We Believe<br />
      <br />
      We believe that women have the right to understand how their body and biology works.<br />
      <br />
      We believe it’s a woman’s birthright to have healthy and drug-free menstruation, fertility, sexuality, and emotional lives/<br />
      <br />
      We believe food is the most powerful tool in healing hormonal and biochemical imbalances. <br />
      <br />
      We believe the path to healing and healthy living should be fun and simple. <br />
      <br />
      We believe that women deserve to live a big, juicy life!<br />
      <br />
     
      <br />
      <br class="clearfloat" />
    </div>
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <br class="clearfloat" />
  <div align="right" style="padding-right:24px; padding-bottom:10px;"><?php include ('include-footerlinks.php'); ?></div>
  <!-- end #container -->
</div>
</body>
</html>
