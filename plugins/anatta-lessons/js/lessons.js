jQuery(function($){
	$('ul.sortable').sortable({handle: '.handle'});
	$('a.add-a-line').click(function(){
		target = "ul."+$(this).attr('id');
		newline = $(target+" li").last().clone();
		$(target).append(newline);
		$(target+' li').last().find('input').attr('value', '');
		return false;
	});
});
