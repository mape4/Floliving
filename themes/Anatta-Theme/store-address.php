<?php
/*///////////////////////////////////////////////////////////////////////
Part of the code from the book 
Building Findable Websites: Web Standards, SEO, and Beyond
by Aarron Walter (aarron@buildingfindablewebsites.com)
http://buildingfindablewebsites.com

Distrbuted under Creative Commons license
http://creativecommons.org/licenses/by-sa/3.0/us/
///////////////////////////////////////////////////////////////////////*/


function storeAddress(){
	
	// Validation
	if(!$_REQUEST['EMAIL']){ return "No email address provided"; } 

	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_REQUEST['EMAIL'])) {
		return '<div class="error">Email address is invalid</div>'; 
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
	$mergeVars = array('ZIP'=>$_REQUEST['MMERGE8']);

	if($api->listSubscribe($list_id, $_REQUEST['EMAIL'], $mergeVars) === true) {
		// It worked!	
		 //header ('Location: http://www.philipmccluskey.com/');
	    $sval = "Success";
		return '<div class="success">Success! You are subscribed to this list now.</div>';
		
		
		//return Redirect::to('http://www.philipmccluskey.com/');
		
	}else{
		// An error ocurred, return error message	
		return '<div class="error">Error: ' . $api->errorMessage.'</div>';
	}
	
}

// If being called via ajax, autorun the function
if($_REQUEST['ajax']){ echo storeAddress(); }
?>
