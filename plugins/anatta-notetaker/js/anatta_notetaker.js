jQuery(function($){
	$.note_taker = {
		init: function(){
			$('#save_note').click(function(){
				//Update status message
				save_contents = $(this).html();
				$('#save_note').addClass('gray').removeClass('blue').html(floliving_notetaker.texts.saving);

				//Serialize form data
				var form_data = $('#anatta_notetaker_form input').serializeArray();
				form_data = $.param(form_data);									 
				//Submit ajax request
				$.post( floliving_notetaker.Ajax_url, { 
					action: floliving_notetaker.action, 
					ajax_form_data: form_data, 
					_ajax_nonce: $('#_notetaker_nonce').val(), 
					message: $('#anatta_textfield_input').val(),
					post_id: floliving_notetaker.post_id,
					user_id: floliving_notetaker.user
					},
					function(data){
						var res = wpAjax.parseAjaxResponse(data, 'ajax-response');
						//form errors
						if (res.errors) {
							var html = '';
							$.each(res.responses, function() {
								$.each(this.errors, function() {
									$("#" + this.code).addClass('error');
									html = html + this.message + '<br />';
								});
							});
						} else {
							//no errors	
							$('#'+floliving_notetaker.empty_list).remove();
							$.each(res.responses, function() {
								$('#anatta_notetaker_list').find('#'+this.supplemental.widget_id).fadeOut('fast').remove();
								$('#anatta_notetaker_list').prepend(this.supplemental.html).fadeIn('slow');
							});
							$('#anatta_textfield_input').val(''); // reset the text field to empty
						}	
					});
				//re-enable submit button
				$('#save_note').removeClass('gray').addClass('blue').html(save_contents);
				return false;
			});
			$('#erase_note').click(function(e){
				e.preventDefault();
		
				// example of calling the confirm function
				// you must use a callback function to perform the "yes" action
				confirm(floliving_notetaker.texts.confirm, function (e) {

					save_contents = $('#erase_note').html();
					$('#erase_note').addClass('gray').removeClass('red').html(floliving_notetaker.texts.erasing);
					//Serialize form data
					var form_data = $('#anatta_notetaker_form input').serializeArray();
					form_data = $.param(form_data);									 
					//Submit ajax request
					$.post( floliving_notetaker.Ajax_url, { 
						action: floliving_notetaker.erase_action, 
						ajax_form_data: form_data, 
						_ajax_nonce: $('#_notetaker_nonce').val(), 
						post_id: floliving_notetaker.post_id,
						user_id: floliving_notetaker.user
						},
						function(data){
							var res = wpAjax.parseAjaxResponse(data, 'ajax-response');
							//form errors
							if (res.errors) {
								var html = '';
								$.each(res.responses, function() {
									$.each(this.errors, function() {
										$("#" + this.code).addClass('error');
										html = html + this.message + '<br />';
									});
								});
							} else {
								//no errors	
								$.each(res.responses, function() {
									$('#anatta_notetaker_list').find('#'+this.supplemental.widget_id).fadeOut('fast').remove();
								});
								if( $('#anatta_notetaker_list li').size() == 0 ) $('#anatta_notetaker_list').prepend('<li id="'+floliving_notetaker.empty_list+'">'+floliving_notetaker.texts.no_notes+'</li>')
								$('#anatta_textfield_input').val('');
							}	
						});
					//re-enable submit button
					$('#erase_note').removeClass('gray').addClass('red').html(save_contents);
					return false;
				});
			});
			$('li.show-tip').live('mouseenter', function() {
				var $this = $(this);
				if (!$this.data('poshytip'))
					$this.poshytip({
						alignX: 'left',
						alignTo: 'target'
					}).poshytip('mouseenter');
				});
    	}
	}; //END note_taker
	$.note_taker.init();
	function confirm(message, callback) {
		$('#confirm').modal({
			closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
			position: ["20%",],
			overlayId: 'confirm-overlay',
			containerId: 'confirm-container', 
			onShow: function (dialog) {
				var modal = this;
	
				$('.message', dialog.data[0]).append(message);
	
				// if the user clicks "yes"
				$('.yes', dialog.data[0]).click(function () {
					// call the callback
					if ($.isFunction(callback)) {
						callback.apply();
					}
					// close the dialog
					modal.close(); // or $.modal.close();
				});
			}
		});
	}
});
