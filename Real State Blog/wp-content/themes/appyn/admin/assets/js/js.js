'use strict';

if(window.location.hash) {
	var section = document.getElementById('panel_theme_tpx');
	var sections = section.getElementsByClassName('section');
	for(var i=0;i<sections.length;i++){
		if( sections[i].dataset.section == location.hash.replace('#', '') ) {
			sections[i].classList.add("active");
		} else {
			sections[i].classList.remove("active");
		}
	}
	document.querySelectorAll("a[href='"+location.hash+"']")[0].parentElement.classList.add("active");		
} else {
	if( document.querySelectorAll("a[href='#general']")[0] )
		document.querySelectorAll("a[href='#general']")[0].parentElement.classList.add("active");	
}
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
var jq_bx = jQuery.noConflict();
jq_bx(function($) {
	
	$(document).on('click', '#add-boxes', function(e){
		e.preventDefault();
		let nipx = 'anczZUhGK0I5cm5LRE9oRkJzMHBCUT09';
		var My_New_Global_Settings;
		if( tinyMCEPreInit.mceInit.novedades ) {
			My_New_Global_Settings =  tinyMCEPreInit.mceInit.novedades;
		} else {
			My_New_Global_Settings =  tinyMCEPreInit.mceInit.content;
		}
		var boxes_count = $('#boxes-content .boxes-a').size();
		var request = $.ajax({
			url: ajaxurl,
			type:"POST",
			data : {
				action : 'boxes_add',
				keycount : boxes_count,
			},
			success: function(data){
				$('#boxes-content').append(data);
				tinymce.init(My_New_Global_Settings); 
				tinyMCE.execCommand('mceAddEditor', false, "custom_boxes-"+boxes_count); 
				quicktags({id : "custom_boxes-"+boxes_count});
			}
		});
		request.fail(function(jqXHR, textStatus) {
			console.log( "Request failed: " + textStatus );
		});
	});
	$(document).on('click', '#add-permanent-boxes', function(e){
		e.preventDefault();
		var My_New_Global_Settings;
		if( tinyMCEPreInit.mceInit.novedades ) {
			My_New_Global_Settings =  tinyMCEPreInit.mceInit.novedades;
		} else {
			My_New_Global_Settings =  tinyMCEPreInit.mceInit.content;
		}
		var permanent_boxes_count = $('#permanent-boxes-content .boxes-a').size();
		var request = $.ajax({
			url: ajaxurl,
			type:"POST",
			data : {
				action : 'permanent_boxes_add',
				keycount : permanent_boxes_count,
			},
			success: function(data){
				$('#permanent-boxes-content').append(data);
				tinymce.init(My_New_Global_Settings); 
				tinyMCE.execCommand('mceAddEditor', true, "permanent_custom_boxes-"+permanent_boxes_count); 
				quicktags({id : "permanent_custom_boxes-"+permanent_boxes_count});
			}
		});
		request.fail(function(jqXHR, textStatus) {
			console.log( "Request failed: " + textStatus );
		});				
	});
	$(document).on('click', '.delete-boxes', function(){
		tinymce.remove('#'+$(this).parents('.boxes-a').find('.wp-editor-area').attr('id'));
		$(this).parents('.boxes-a').remove();
	});

	var data_size;
	
	var interval___;
	async function jojoupload_percentage(step3) {
		var oo = 1;
		interval___ = setInterval(function(){
		$.post( ajaxurl, { action: "action_get_filesize" } )
			.done(function(data) {
				data_size = data;
				$('.percentage').text(data);
				if( data == "100.00%" ) {
					if( !$('.apk-result .step3').length ) {
						$('#extract-result .apk-result ul').append('<li class="step3">'+step3+'</li>');
					}
					clearInterval(interval___);
					for (var y = 1; y < 100; y++)
						window.clearInterval(y);

					if( $('.apk-result .result-error').length ) {
						$('.apk-result .step3').remove();
					}
					return;
				}
			})
			.error(function() {
				$('#extract-result .apk-result ul').html('<li class="result-error"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+ajax_var.error_text+'</li>');
				for (var y = 1; y < 100; y++)
					window.clearInterval(y);
			})
		}, 1000);
	}

	$(document).on('click', '#wp-admin-bar-appyn_actualizar_informacion', function(e){
		e.preventDefault();
		var confirm = window.confirm( text_confirm_update );
		if( confirm === false ) {
			return;
		}
		$('#extract-result').remove();
		$(this).addClass('wait');
		var post_id = $('#post_ID').val();
		var url_app = $('#consiguelo').val();
		var request = $.ajax({
 			url: ajaxurl,
			type : 'POST',
			data: {
				action: 'action_eps',
				post_id: post_id,
				url_app: url_app,
				nonce: importgp_nonce.nonce,
				type: 'update',
			}
		});
		$(window).bind('beforeunload', function(){
			return 'Are you sure you want to leave?';
		});
		var exists_apk = false;
		request.done(function (data, textStatus, jqXHR){
			var data = JSON.parse(data);
			if( data.post_id ) {
				$('.wrap, .interface-interface-skeleton__editor').prepend('<div id="box-info-import">'+
					'<ul id="extract-result">'+
						'<li style="color:#10ac10;">'+data.info_text+'</li>'+
					'</ul>'+
				'</div>');

				if( data.apk_info ) {
					exists_apk = true;
					$('#extract-result').append('<li class="apk-result">'+data.apk_info.text.step1+'<ul></ul></li>');
					$('#extract-result .apk-result ul').append('<li>'+data.apk_info.text.step2+'</li>');
					var step3 = data.apk_info.text.step3;

					var limit = parseInt(md.px_limit_filesize);
					
					var total_size = data.apk_info.total_size;
					var total_parts = Math.ceil( total_size / limit);
					var size_offset = 0, part = 0, size_init = 0;
						
					var fff = function(index) {

						if( size_offset >= total_size ) {
							return;
						}

						part++;
						
						size_offset += limit;
						size_init = size_offset - limit + 1;

						if( size_init == 1 ) {
							size_init = 0;
						}

						if( size_offset > total_size ) {
							size_offset = total_size;
						} 
						
						var request_ajax = $.ajax({
							url: ajaxurl,
							type: "POST",
							data: {
								action: "action_upload_apk",
								apk: data.apk_info.url,
								post_id: data.apk_info.post_id,
								idps: data.apk_info.idps,
								date: data.apk_info.date,
								nonce: importgp_nonce.nonce,
								total_size: total_size,
								size_init: size_init,
								size_offset: size_offset,
								total_parts: total_parts,
								part: part,
							}
						});
						
						request_ajax.done(function (data_apk, textStatus, jqXHR){
							
							if( data_apk ) {
								var data_apk = JSON.parse(data_apk);
								if( data_apk.error ) {
									clearInterval(interval___);
									clearInterval(fff);
									$('.apk-result ul li').last().html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+data.error).addClass('result-error');
									request_ajax.abort();
									return;
								}

								if( data_apk.info ){
									$('.apk-result').html('<li class="apk-result" style="color:#10ac10;">'+data_apk.info+'</li>');
									clearInterval(interval___);
									clearInterval(fff);
								
									$(window).unbind('beforeunload');
									setTimeout(() => {
										alert(data.info);
										location.reload();
									}, 1000);
									return;
								}
							}

							fff(++index);
						});

						request_ajax.fail(function (jqXHR, textStatus, errorThrown){
							console.error(
								"The following error occurred: "+
								textStatus, errorThrown
							);
						});
						request_ajax.always(function () {						
							$('#wp-admin-bar-appyn_actualizar_informacion').removeClass('wait');
						});
					}

					fff(0);
					jojoupload_percentage(step3);
				}
			} else {
				if( data.info ){
					$('.wrap, .interface-interface-skeleton__editor').prepend('<div id="box-info-import">'+
						'<ul id="extract-result">'+
							'<li style="color:red;">'+data.info+'</li>'+
						'</ul>'+
					'</div>');
				}
				$('#wp-admin-bar-appyn_actualizar_informacion').removeClass('wait');
			}

			if( data.error_field ) {
				var of = $('#'+data.error_field).offset();
				$('html, body').animate({scrollTop: of.top - 100}, 500);
				$('#'+data.error_field).focus();
				$('#'+data.error_field).css('border-color', 'red');
				$('#'+data.error_field).on('click', function(){
					$(this).removeAttr('style');
				});
			}
			if( !exists_apk ) {
				$('#wp-admin-bar-appyn_actualizar_informacion').removeClass('wait');
				$(window).unbind('beforeunload');
				alert(data.info);
				location.reload();
			}
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});
	});

	$(document).on("submit", "#form-import", function(event){
		event.preventDefault();
		$('#extract-result').remove();
		var $this = $(this);
		$this.find(".spinner").addClass("active");
		var url_app = $("#url_googleplay").val();

		var request = $.ajax({
			url: ajaxurl,
			type:"POST",
			data: {
				action: 'action_eps',
				url_app:url_app,
				nonce: importgp_nonce.nonce,
				type: 'create',
			},
		});
		$('#form-import input').prop('disabled', true);
		var exists_apk = false;
		
		request.done(function (data, textStatus, jqXHR){

			if( !IsJsonString(data) ) {
				alert("Error");
				$this.find(".spinner").removeClass("active");
				return;
			}
			var data = JSON.parse(data);
			if( data.post_id ) {
				$('.extract-box').after('<div style="font-weight:500;">'+
					'<ul id="extract-result">'+
						'<li class="result-true">'+data.info_text+'</li>'+
					'</ul>'+
				'</div>');

				if( data.apk_info ) {
					exists_apk = true;
					$('#extract-result').append('<li class="apk-result">'+data.apk_info.text.step1+'<ul></ul></li>');
					$('#extract-result .apk-result ul').append('<li>'+data.apk_info.text.step2+'</li>');
					var step3 = data.apk_info.text.step3;

					var limit = parseInt(md.px_limit_filesize);

					var total_size = data.apk_info.total_size;
					var total_parts = Math.ceil( total_size / limit);
					var size_offset = 0, part = 0, size_init = 0;

					var fff = function(index) {

						if( size_offset >= total_size ) {
							return;
						}

						part++;
						
						size_offset += limit;
						size_init = size_offset - limit + 1;

						if( size_init == 1 ) {
							size_init = 0;
						}

						if( size_offset > total_size ) {
							size_offset = total_size;
						} 
						
						var request_ajax = $.ajax({
							url: ajaxurl,
							type: "POST",
							data: {
								action: "action_upload_apk",
								apk: data.apk_info.url,
								post_id: data.apk_info.post_id,
								idps: data.apk_info.idps,
								date: data.apk_info.date,
								nonce: importgp_nonce.nonce,
								total_size: total_size,
								size_init: size_init,
								size_offset: size_offset,
								total_parts: total_parts,
								part: part,
							}
						});

						request_ajax.done(function (data, textStatus, jqXHR){

							if( data ) {
								
								if( !IsJsonString(data) ) {
									alert("Error");
									$this.find(".spinner").removeClass("active");
									return;
								} else {
									var data_apk = JSON.parse(data);
									if( data_apk.error ) {
										clearInterval(interval___);
										clearInterval(fff);
										$('.apk-result ul li').last().html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+data_apk.error).addClass('result-error');
										request_ajax.abort();
										return;
									}
								}
										
								if( data_apk.info ){
									$('.apk-result').html('<li class="apk-result" style="color:#10ac10;">'+data_apk.info+'</li>');
									clearInterval(interval___);
									clearInterval(fff);
									$this.find(".spinner").removeClass("active");
									$('#url_googleplay').val('');
									$('#form-import input').prop('disabled', false);
									return;
								}
							}
							fff(++index);

						});

						request_ajax.fail(function (jqXHR, textStatus, errorThrown){
							$('.apk-result ul li').last().html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Error').addClass('result-error');
							$('.apk-result .step3').remove();
							console.error(
								"action_upload_apk ERROR The following error occurred: "+
								textStatus, errorThrown
							);
						});
					};

					fff(0);
					jojoupload_percentage(step3);

				}
			} else {
				if( data.info ){
					$('.extract-box').after('<div style="font-weight:500;">'+
						'<ul id="extract-result">'+
							'<li style="color:red;">'+data.info+'</li>'+
						'</ul>'+
					'</div>');
				}
				$this.find(".spinner").removeClass("active");
				$('#url_googleplay').val('');
				$('#form-import input').prop('disabled', false);
			}
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error(
				"action_eps ERROR The following error occurred: "+
				textStatus, errorThrown
			);
		});
		request.always(function () {
			if( !exists_apk ) {
				$this.find(".spinner").removeClass("active");
				$('#url_googleplay').val('');
				$('#form-import input').prop('disabled', false);
			}
		});
	}); 

	
	$( "ul.px-orden-cajas" ).sortable();
	$( "ul.px-orden-cajas" ).disableSelection();

	$('#panel_theme_tpx #menu ul li a').on('click', function(e){
		$('#panel_theme_tpx .section').removeClass('active');
		
		if(!$(''+$(this).attr('href')+'').hasClass('active')){
			var url = $(this).attr('href').replace('#', '');
			$('.section[data-section='+url+']').addClass('active');
		}

		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');
		$(window).on('popstate',function(event) {
			$('#panel_theme_tpx .section').removeClass('active');
			$('.section[data-section='+location.hash.replace('#','')+']').addClass('active');
		});
	});

	$('.switch-show').each(function(index, element){
		var el = $(this).data('sshow');

		if( $(this).find('input').is(':checked') )
			$("."+el).show();
		else
			$("."+el).hide();
	});

	$(document).on('change', '.switch-show input', function(){
		var el = $(this).parent().data('sshow');

		if( $(this).is(':checked') )
			$("."+el).show();
		else
			$("."+el).hide();
	});

	$(document).on('click', '#button_google_drive_connect', function(e){
		if( !$('#gdrive_client_id').val().length || !$('#gdrive_client_secret').val().length ) {
			$('#gdrive_client_id').css('border-color', 'red');
			$('#gdrive_client_secret').css('border-color', 'red');
			e.preventDefault();
		}
	});

	$(document).on('click', '#gdrive_client_id, #gdrive_client_secret', function(){
		$(this).removeAttr('style');
	});

	$(document).on('click', '.autocomplete_info_download_apk_zip', function(e){
		e.preventDefault();

		tinyMCE.get('apps_info_download_apk').setContent($('#default_apps_info_download_apk').html());
		
		tinyMCE.get('apps_info_download_zip').setContent($('#default_apps_info_download_zip').html());

	});

	var request;
	$(document).on('submit', '#form-panel', function(e){
		e.preventDefault();
		if (request) {
			request.abort();
		}
		$(this).addClass('wait');
		$(this).find('.submit').prepend('<span class="spinner active"></span>');
		var form = $(this);
		var inputs = form.find("input, select, button, textarea");
		var serializedData = form.serialize();
		inputs.prop("disabled", true);
		request = $.ajax({
			url: ajaxurl,
			type: "POST",
			data: {
				action: ajax_var.action,
				nonce: ajax_var.nonce,
				serializedData: serializedData,
			}
		});
		request.done(function (data, textStatus, jqXHR){
			
			$(form).find('.spinner').remove();
			$(form).find('.submit').prepend('<span class="panel-check"><i class="fa fa-check"></i></span>');
			$(form).removeClass('wait');
			$('#alert_test_ftp').hide();
				
			setTimeout(() => {
				$(form).find('.submit .panel-check').fadeOut(500, function(){
					$(this).remove();
				});
			}, 1000);
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});
		request.always(function () {
			inputs.prop("disabled", false);
		});
	});

	$(document).on('keyup', '#ftp_name_ip, #ftp_port, #ftp_username, #ftp_password, #ftp_directory, #ftp_url', function(){
		$('#alert_test_ftp').show();
	});

	$(document).on('keyup', '#gdrive_client_id, #gdrive_client_secret, #gdrive_folder', function(){
		$('#alert_test_gdrive').show();
	});

	$(document).on('keyup', '#dropbox_app_key, #dropbox_app_secret', function(){
		$('#alert_test_dropbox').show();
	});

	$(document).on('keyup', '#onedrive_client_id, #onedrive_client_secret, #onedrive_folder', function(){
		$('#alert_test_onedrive').show();
	});

	$(document).on('click', '#doaction', function(){
		var sn = $('select[name="action"]').val();

		if( sn == 'update' ) {
			$('input[type=checkbox][name="apps_to_update[]"]').each(function () {
				if( this.checked ) {
					$(this).parent().parent().find('.atul_update_app a').click();
				}
			});
		}
	});

	var list_wait = [];

	var i = 0;

	async function atu_process(au, ptr, list_wait, importgp_nonce) {
		
		var sac = $('select[name="action"], select[name="action2"], #doaction, #doaction2');
		$(sac).prop('disabled', true);

		var $au = au;
		var $ptr = ptr;

		$ptr.find('#box-info-import').remove();

		var post_id = list_wait[0];

		var request = $.ajax({
			url: ajaxurl,
			type : 'POST',
			data: {
				action: 'action_eps',
				post_id: post_id,
				nonce: importgp_nonce.nonce,
				type: 'update',
			}
		});
		$(window).bind('beforeunload', function(){
			return 'Are you sure you want to leave?';
		});
		var exists_apk = false;
		request.done(function (data, textStatus, jqXHR){
			var data = JSON.parse(data);
			if( data.post_id ) {
				$au.find('.spinner').hide();
				$au.after('<div id="box-info-import">'+
					'<ul id="extract-result">'+
						'<li style="color:#10ac10;">'+data.info_text+'</li>'+
					'</ul>'+
				'</div>');

				if( data.apk_info ) {
					exists_apk = true;
					$ptr.find('#extract-result').append('<li class="apk-result">'+data.apk_info.text.step1+'<ul></ul></li>');
					$ptr.find('#extract-result .apk-result ul').append('<li>'+data.apk_info.text.step2+'</li>');
					var step3 = data.apk_info.text.step3;

					var limit = parseInt(md.px_limit_filesize);
					
					var total_size = data.apk_info.total_size;
					var total_parts = Math.ceil( total_size / limit);
					var size_offset = 0, part = 0, size_init = 0;
						
					var fff = function(index) {

						if( size_offset >= total_size ) {
							return;
						}

						part++;
						
						size_offset += limit;
						size_init = size_offset - limit + 1;

						if( size_init == 1 ) {
							size_init = 0;
						}

						if( size_offset > total_size ) {
							size_offset = total_size;
						} 
						
						var request_ajax = $.ajax({
							url: ajaxurl,
							type: "POST",
							data: {
								action: "action_upload_apk",
								apk: data.apk_info.url,
								post_id: data.apk_info.post_id,
								idps: data.apk_info.idps,
								date: data.apk_info.date,
								nonce: importgp_nonce.nonce,
								total_size: total_size,
								size_init: size_init,
								size_offset: size_offset,
								total_parts: total_parts,
								part: part,
							}
						});
						
						request_ajax.done(function (data, textStatus, jqXHR){
							
							if( data ) {
								var data_apk = JSON.parse(data);
								if( data_apk.error ) {
									clearInterval(interval___);
									clearInterval(fff);
									$('.apk-result ul li').last().html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+data_apk.error).addClass('result-error');
									request_ajax.abort();
									i--;
									return;
								}
								if( data_apk.info ){
									$('.apk-result').html('<li class="apk-result" style="color:#10ac10;">'+data_apk.info+'</li>');

									for (var y = 1; y < 100; y++)
										window.clearInterval(y);

									$(window).unbind('beforeunload');
									
								}
								$(window).unbind('beforeunload');
								$(au).remove();
								i--;

								list_wait.shift();

								if( list_wait[0] === undefined ) {
									i = 0;
									list_wait = [];
									$(window).unbind('beforeunload');
									$(sac).prop('disabled', false);
						
									return;
								} else {
									var au = $('.atul_update_app a[data-id='+list_wait[0]+']').parent();
									var ptr = $('.atul_update_app a[data-id='+list_wait[0]+']').parent().parent().parent();
									atu_process(au, ptr, list_wait, importgp_nonce);
								}
							}
							
							fff(++index);
						});

						request_ajax.fail(function (jqXHR, textStatus, errorThrown){
							console.error(
								"The following error occurred: "+
								textStatus, errorThrown
							);
							var au = $('.atul_update_app a[data-id='+list_wait[0]+']').parent();
							var ptr = $('.atul_update_app a[data-id='+list_wait[0]+']').parent().parent().parent();
							atu_process(au, ptr, list_wait, importgp_nonce);
						});
						request_ajax.always(function () {						
							$('#wp-admin-bar-appyn_actualizar_informacion').removeClass('wait');
						});
					}

					fff(0);

					jojoupload_percentage(step3);
				}
			} else {
				if( data.info ){
					$(au).after('<div id="box-info-import">'+
						'<ul id="extract-result">'+
							'<li style="color:red;">'+data.info+'</li>'+
						'</ul>'+
					'</div>');
				}
				i = 0;
			}

			if( !exists_apk ) {
				$(au).remove();
				$(window).unbind('beforeunload');
				i--;

				list_wait.shift();
				var au = $('.atul_update_app a[data-id='+list_wait[0]+']').parent();
				var ptr = $('.atul_update_app a[data-id='+list_wait[0]+']').parent().parent().parent();

				atu_process(au, ptr, list_wait, importgp_nonce);
			}

		});
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});
	}
	var confirm = false;
	$(document).on('click', '.atul_update_app a', function(e){
		e.preventDefault();

		if( confirm === false ) {
			confirm = window.confirm( text_confirm_update );
			if( confirm === false ) {
				return;
			}
		}
		var au = $(this).parent();

		var ptr = $(this).parent().parent().parent();
		var post_id = $(this).data('id');

		list_wait.push(post_id);
		
		if( i >= 1 ) {
			$(this).after('<span class="spinner" style="visibility:visible"></span>');
			$(this).hide();
			i++;
			return;
		} 

		$(this).after('<span class="spinner" style="visibility:visible"></span>');
		$(this).hide();

		i++;

		var startTime = performance.now();

		atu_process(au, ptr, list_wait, importgp_nonce);
		
		var endTime = performance.now();

	});
		

	function sleep(ms) {
		return new Promise(resolve => setTimeout(resolve, ms));
	}
	
});