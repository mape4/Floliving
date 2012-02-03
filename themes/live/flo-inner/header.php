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
<link rel="stylesheet" href="<?php bloginfo('url'); ?>/stylesheet/styles.css" />
<link href="<?php bloginfo('url'); ?>/Styles/dmxpopup.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('url'); ?>/Styles/BorderlessWithClose/BorderlessWithClose.css" rel="stylesheet" type="text/css" />
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
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>: Feed" href="<?php bloginfo('rss2_url'); ?>" />
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
<script type="text/javascript">
	function dmxAdvLayerPopup(sTitle,sURL,sPopupName,sContent,sClass,nPositionLeft,nPositionRight,nWidth,nHeight,nAutoCloseTime,bDragable,bResizable,bOverlay,nOverlayOpacity,sIncomingEffect,sIncomingEffectEasing,nIncomingEffectDuration,bFadeIn,sOutgoingEffect,sOutgoingEffectEasing,nOutgoingEffectDuration,bFadeOut,sSlideEffect,nEffectTime,nSlideTime,bClosable,bWireframe,bgContentColor) { // v1.05
	  var aURL, aSlides = sURL.split('|');
	  if (aSlides && aSlides.length > 1) {
		aURL = [];
		for (var si=0;si<aSlides.length;si++) {
		  var cf=aSlides[si],nW='',nH='',nS='';
		  if (cf.substr(cf.length-1,1)==']') {
			var bd=cf.lastIndexOf('[');
			if(bd>0){
			  var di=cf.substring(bd+1,cf.length-1);
			  var da=di.split('x');
			  nW=da[0];nH=da[1];
			  if (da.length==3) nS=da[2];
			  cf=cf.substring(0,bd)
			}   
		  }      
		  aURL[si] = new Object();
		  aURL[si].src = cf;
		  aURL[si].nWidth = (nW!=''?nW:nWidth);
		  aURL[si].nHeight = (nH!=''?nH:nHeight);
		  aURL[si].nDelay = (nS!=''?nS:nSlideTime);
		}  
	  } else aURL = sURL;
	  if (!cDMXPopupWindow) {
		alert('The Advanced Layer Popup script is missing on your website!\nPlease upload the file ScriptLibrary/advLayerPopup.js to your live server.');
	  } else {
		if (sClass == 'OS_Look') sClass = (navigator.userAgent.toLowerCase().indexOf('mac')!=-1?'dmxOSX':'dmxXP');  
		cDMXPopupWindow.buildWindow({sTitle: sTitle, sURL: aURL, sPopupName: sPopupName, sContent: sContent, sClass: sClass, aPosition: [nPositionLeft,nPositionRight], aSize: [nWidth,nHeight], nCloseDelay: nAutoCloseTime, bDragable: bDragable, bResizable: bResizable, bOverlay: bOverlay, nOverlayOpacity: nOverlayOpacity, sStartPosition: sIncomingEffect, sStartShowEffect: sIncomingEffectEasing, nIncomingEffectDuration: nIncomingEffectDuration, bFadeIn: bFadeIn, sEndPosition: sOutgoingEffect, sEndShowEffect: sOutgoingEffectEasing, nOutgoingEffectDuration: nOutgoingEffectDuration, bFadeOut: bFadeOut, sSlideEffect: sSlideEffect, nEffectTime: nEffectTime, nSlideTime: nSlideTime, bClosable: bClosable, bWireframe: bWireframe, sContentBgColor: bgContentColor });
	  }  
	  document.MM_returnValue = false;
	}
	</script>
<script src="<?php bloginfo('url'); ?>/ScriptLibrary/advLayerPopup.js" type="text/javascript"></script>
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>
<body class="twoColFixRt">
<!-- Container -->
<div id="container-inner">
<div style="height:97px; width:440px; background-image:url(http://www.floliving.com/images/header_bg_white.jpg); padding-left:540px;">
  <div style="width:100px; float:left; padding-top:24px; padding-left:10px;"> <a href="<?php bloginfo('url'); ?>" class="navlink">home</a><br />
    <a href="<?php bloginfo('url'); ?>/about-floliving/" class="navlink">about flo living</a></div>
  <div style="width:80px; float:left; padding-top:24px; padding-left:10px;"> <a href="<?php bloginfo('url'); ?>/events/" class="navlink">events</a><br />
    <a href="<?php bloginfo('url'); ?>/resources/" class="navlink">resources</a></div>
  <div style="width:80px; float:left; padding-top:24px; padding-left:10px;"> <a href="<?php bloginfo('url'); ?>/blog-2/" class="navlink">blog</a><br />
    <a href="<?php bloginfo('url'); ?>/get-in-the-flo/" class="navlink">products</a></div>
  <div style="width:140px; float:left; padding-top:16px;"> <a href="javascript:;"  onclick="dmxAdvLayerPopup('','http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=87B5F2B7-52FD-468A-A724-8DCAFBB273B9&pid=a124e0b17a454eda937341a26656f4ff','poststory','','BorderlessWithClose','center','center',740,700,0,true,false,true,80,'','Linear',1,true,'','Linear',1,true,'',1,5,true,false,'#FFFFFF');return document.MM_returnValue"><img src="<?php bloginfo('url'); ?>/images/icon_home_buynow.jpg" width="60" height="54" hspace="5" border="0" /></a><img src="<?php bloginfo('url'); ?>/images/icon_home_connect.jpg" width="60" height="54" hspace="5" /></div>
</div>
