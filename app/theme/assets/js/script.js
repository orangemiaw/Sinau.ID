function ajax_post_multipart( action, post_data, callback) {
	$.ajax(request.ajax_url + action, {
		data 		: post_data,
		method 		: 'post',
		dataType 	: 'json',
		mimeType 	: 'multipart/form-data',
		cache 		: false,
		contentType : false,
		processData : false
	}).always(callback);
}

function ajax_post( action, post_data, callback) {
	$.ajax(request.ajax_url + action, {
		method: 'post',
		data: post_data,
		dataType: 'json',
		cache: false
	}).always(callback);
}

function ajax_get(action, data, callback) {

	$.ajax(request.ajax_url + action, {
		method: 'get',
		data: data,
		dataType: 'json',
		cache: false
	}).always(callback);
}

function update_csrf_token(token) {
	request.csrf_hash = token;
	$('[name="csrf_token"]').val(token);
}

function init_meta(meta) {

	if( isset(meta.csrf_token) ) {
		update_csrf_token(meta.csrf_token);
	}
	

	if( isset(meta.callback) ) {

		if( isset(meta.callback.location)  ) {
			navigation(meta.callback.location);
		}

		if( isset(meta.callback.noty) ) {
			noty(meta.callback.noty.text, meta.callback.noty.type);
		}

		if( isset(meta.callback.fields) ) {

			$.each(meta.callback.fields, function(key, value) {
				var field = $('[name="' + key +'"]');
				if(field.length < 1 || !field.is(":visible")) {
					noty(value, 'error');
				}else{
					var err_msg = $('<li />', {
						class: 'error',
						text: value
					});

					var field_container = field.closest('.form-group');
					var field_msg 		= field_container.find('.fields-message');

					field_container.addClass('error');
					field_msg.html(err_msg);

					$(document).on('change summernote.change', '[name="' + key +'"]', function() {
						field_container.removeClass('error');
						field_msg.empty();
					});
				}
			});
		}
	}
}

function loading(container, action) {

	if(action === 'show') {

		var loading_elm = $('<div />', {
			class 	: 'loading',
			html 	: '<div><div class="sk-rotating-plane"></div><p>Loading...</p></div>'
		});

		if( container.find('div') ) {
			loading_elm.appendTo(container);
		}

	} else if(action === 'hide'){
		container.find('.loading').remove();
	}
}

function noty(text, type) {
	new Noty({
		theme: 'bootstrap-v4',
		type: type,
		text: text,
		timeout: 10000
	}).show();
}

function init_callback(fn_name, obj_args) {
	window['fn_name'](obj_args);
}

function navigation(url) {
	window.location = request.base_url + url;
}

function isset () {
	var a = arguments
	var l = a.length
	var i = 0
	var undef

	if (l === 0) {
		throw new Error('Empty isset')
	}

	while (i !== l) {
		if (a[i] === undef || a[i] === null) {
		  return false
		}
		i++
	}

	return true
}

function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}