function wpm_insertHTML(html,field){
	var o=document.getElementById(field);
	try{
		if(o.selectionStart || o.selectionStart===0){
			o.focus();
			var os=o.selectionStart;
			var oe=o.selectionEnd;
			var np=os+html.length;
			o.value=o.value.substring(0,os)+html+o.value.substring(oe,o.value.length);
			o.setSelectionRange(np,np);
		}else if(document.selection){
			o.focus();
			sel=document.selection.createRange();
			sel.text=html;
		}else{
			o.value+=html;
		}
	}catch(e){}
}

function wpm_selectAll(chk,table,className){
	if(!className)className='check-column';
	table=document.getElementById(table);
	var th=table.getElementsByTagName('th');
	for(var i=0;i<th.length;i++){
		if(th[i].className==className && th[i].scope=='row'){
			try{
				th[i].getElementsByTagName('input')[0].checked=chk.checked;
			}catch(e){}
		}
	}
}

function wpm_clone_level(f){
	var srcid=f.clonefrom.value;
	var dstid=f.doclone.value;
	if(f.doclone.checked){
		f['wpm_levels['+dstid+'][isfree]'].checked=f['wpm_levels['+srcid+'][isfree]'].checked;
		f['wpm_levels['+dstid+'][role]'].selectedIndex=f['wpm_levels['+srcid+'][role]'].selectedIndex;
		f['wpm_levels['+dstid+'][loginredirect]'].selectedIndex=f['wpm_levels['+srcid+'][loginredirect]'].selectedIndex;
		f['wpm_levels['+dstid+'][afterregredirect]'].selectedIndex=f['wpm_levels['+srcid+'][afterregredirect]'].selectedIndex;
		f['wpm_levels['+dstid+'][allpages]'].checked=f['wpm_levels['+srcid+'][allpages]'].checked;
		f['wpm_levels['+dstid+'][allcategories]'].checked=f['wpm_levels['+srcid+'][allcategories]'].checked;
		f['wpm_levels['+dstid+'][allposts]'].checked=f['wpm_levels['+srcid+'][allposts]'].checked;
		f['wpm_levels['+dstid+'][allcomments]'].checked=f['wpm_levels['+srcid+'][allcomments]'].checked;
		f['wpm_levels['+dstid+'][expire]'].value=f['wpm_levels['+srcid+'][expire]'].value;
		f['wpm_levels['+dstid+'][calendar]'].selectedIndex=f['wpm_levels['+srcid+'][calendar]'].selectedIndex;
		f['wpm_levels['+dstid+'][expire]'].disabled=f['wpm_levels['+srcid+'][expire]'].disabled;
		f['wpm_levels['+dstid+'][calendar]'].disabled=f['wpm_levels['+srcid+'][calendar]'].disabled;
		f['wpm_levels['+dstid+'][noexpire]'].checked=f['wpm_levels['+srcid+'][noexpire]'].checked;
		f['wpm_levels['+dstid+'][disableexistinglink]'].checked=f['wpm_levels['+srcid+'][disableexistinglink]'].checked;
		f['wpm_levels['+dstid+'][registrationdatereset]'].checked=f['wpm_levels['+srcid+'][registrationdatereset]'].checked;
		f['wpm_levels['+dstid+'][uncancelonregistration]'].checked=f['wpm_levels['+srcid+'][uncancelonregistration]'].checked;
		f['wpm_levels['+dstid+'][requirecaptcha]'].checked=f['wpm_levels['+srcid+'][requirecaptcha]'].checked;
		f['wpm_levels['+dstid+'][requireemailconfirmation]'].checked=f['wpm_levels['+srcid+'][requireemailconfirmation]'].checked;
		f['wpm_levels['+dstid+'][requireadminapproval]'].checked=f['wpm_levels['+srcid+'][requireadminapproval]'].checked;
		f['wpm_levels['+dstid+'][levelOrder]'].value=f['wpm_levels['+srcid+'][levelOrder]'].value;
	}else{
		f['wpm_levels['+dstid+'][isfree]'].checked=false;
		f['wpm_levels['+dstid+'][role]'].selectedIndex=0;
		f['wpm_levels['+dstid+'][loginredirect]'].selectedIndex=0;
		f['wpm_levels['+dstid+'][afterregredirect]'].selectedIndex=0;
		f['wpm_levels['+dstid+'][allpages]'].checked=false;
		f['wpm_levels['+dstid+'][allcategories]'].checked=false;
		f['wpm_levels['+dstid+'][allposts]'].checked=false;
		f['wpm_levels['+dstid+'][allcomments]'].checked=false;
		f['wpm_levels['+dstid+'][expire]'].value='';
		f['wpm_levels['+dstid+'][calendar]'].selectedIndex=0;
		f['wpm_levels['+dstid+'][expire]'].disabled=false
		f['wpm_levels['+dstid+'][calendar]'].disabled=false;
		f['wpm_levels['+dstid+'][noexpire]'].checked=false;
		f['wpm_levels['+dstid+'][disableexistinglink]'].checked=false;
		f['wpm_levels['+dstid+'][registrationdatereset]'].checked=false;
		f['wpm_levels['+dstid+'][uncancelonregistration]'].checked=false;
		f['wpm_levels['+dstid+'][requirecaptcha]'].checked=false;
		f['wpm_levels['+dstid+'][requireemailconfirmation]'].checked=false;
		f['wpm_levels['+dstid+'][requireadminapproval]'].checked=false;
		f['wpm_levels['+dstid+'][levelOrder]'].value='';
	}
}

function wpm_category_form(){
	var f=document.getElementById('editcat');
	if(!f)f=document.getElementById('addcat');
	if(!f)return;

	var wlm=jQuery('div#wishlist_member_cat_protect');
	var labelText=wlm.children('p')[0].innerHTML;
	var htmlcode=wlm.children('span')[0].innerHTML;

	if(f.id=='addcat'){
		var d=document.createElement('div');
		d.className='form-field';
		d.innerHTML=labelText+'<br />'+htmlcode;
		var p=jQuery(f).children('p.submit');
		f.insertBefore(d,p[0]);
	}else{
		var t=f.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0];
		var tr=document.createElement('tr');
		tr.className='form-field';

		var th=document.createElement('th');
		th.scope='row';
		th.vAlign='top';
		th.innerHTML=labelText;
		tr.appendChild(th);

		var td=document.createElement('td');
		td.vAlign='top';
		td.innerHTML=htmlcode;
		tr.appendChild(td);
		t.appendChild(tr);
	}

	wlm.remove();
}

function wpm_showHideLevels(o){
	var l=o.options.length-1;
	var s=o.selectedIndex;
	var d=document.getElementById('levels');
	var c=document.getElementById('cancel_date');

	if(o.options[o.selectedIndex].text.substring(0,1)=='-'){
		o.selectedIndex=0;
		d.style.display='none';
		o.form.wpm_membership_to.selectedIndex=0;
		return;
	}

	if(s<l-4){
		d.style.display='';
		if(s==5){
			c.style.display='';
		}else{
			c.style.display='none';
		}
	}else{
		d.style.display='none';
		c.style.display='none';
		o.form.wpm_membership_to.selectedIndex=0;
	}
}

function wpm_doConfirm(f){
	var a=f.wpm_action.options[f.wpm_action.selectedIndex].text;
	var l=f.wpm_membership_to.options[f.wpm_membership_to.selectedIndex].text;
	if(f.wpm_membership_to.value!='-'){
		a+=' '+l;
	}
	a="Action: \""+a+"\"";
	var c1="Are you sure you want to execute the\nfollowing action for the selected users?\n\n"+a;
	var c2="Are you sure REALLY you want to execute the\nfollowing action for the selected users?\n\n"+a;
	if(confirm(c1) && confirm(c2)){
		f.submit();
	}
}
function wlm_user_search(url,instructions,fxn){
	var search = jQuery.trim(jQuery('#user_search_input').val());
	var outdiv = jQuery('#wlm_user_search_ajax_output');
	if(search==''){
		outdiv.html('<p>No search entry specified</p>');
		return;
	}
	var data = {
		action : 'wlm_user_search',
		url : url,
		search : search
	}
	jQuery.post(ajaxurl,data,function(response){
		response = jQuery.trim(response);
		if(response==''){
			outdiv.html('<p>No users found</p>');
		}else{
			outdiv.html('<p>'+instructions+'</p>'+response);
			fxn();
		}
	});
}
