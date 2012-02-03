$(document).ready(function() {
	$('div.tabs ul.tab-strips li').click(function() {
		$('div.tabs ul.tab-strips li').removeClass('active');
		$(this).addClass('active');
		$('section.community .quote').removeClass('active');
		$("div#" + $(this).attr('id') + "-quote").addClass('active');
		return false;
	});
});
