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
<script src="../../ScriptLibrary/advLayerPopup.js" type="text/javascript"></script>
<link href="../../Styles/dmxpopup.css" rel="stylesheet" type="text/css" />
<link href="../../Styles/BorderlessWithClose/BorderlessWithClose.css" rel="stylesheet" type="text/css" />
<div style="height:97px; width:440px; background-image:url(../../images/header_bg.jpg); padding-left:540px;">
    <div style="width:100px; float:left; padding-top:24px; padding-left:10px;">
      <a href="http://www.floliving.com/" class="navlink">home</a><br />
      <a href="http://www.floliving.com/?page_id=87" class="navlink">about flo living</a>
      <!--<a href="http://flo.openi.com.php5-12.dfw1-1.websitetestlink.com/?page_id=25" class="navlink">flo home study kit</a>--></div>
    <div style="width:80px; float:left; padding-top:24px; padding-left:10px;">
      <!--<a href="http://www.floliving.com/?page_id=67" class="navlink">press & buzz</a><br />-->
      <a href="http://www.floliving.com/?page_id=97" class="navlink">events</a><br />
      <a href="http://www.floliving.com/?page_id=99" class="navlink">resources</a></div>
    <div style="width:80px; float:left; padding-top:24px; padding-left:10px;">
      <a href="http://www.floliving.com/?page_id=58" class="navlink">blog</a><br />
      <a href="http://www.floliving.com/?page_id=92" class="navlink">products</a></div>
      <!--<a href="#" class="navlink">events</a><br />-->
     <div style="width:140px; float:left; padding-top:16px;">
     <a href="javascript:;"  onclick="dmxAdvLayerPopup('','http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=87B5F2B7-52FD-468A-A724-8DCAFBB273B9&pid=a124e0b17a454eda937341a26656f4ff','poststory','','BorderlessWithClose','center','center',740,700,0,true,false,true,80,'','Linear',1,true,'','Linear',1,true,'',1,5,true,false,'#FFFFFF');return document.MM_returnValue"><img src="images/icon_home_buynow.jpg" width="60" height="54" hspace="5" border="0" /></a><img src="images/icon_home_connect.jpg" width="60" height="54" hspace="5" border="0" />
<!--<a href="http://flo.openi.com.php5-12.dfw1-1.websitetestlink.com/?page_id=80" class="navlink">testimonials</a><br />
      <a href="#" class="navlink">1 item</a><br /><br />
      <a href="#" class="navlink"><u>LOGIN</u></a>--></div>
  </div>