var fn = {
	init: function() {
		this.bindEvents();
		this.render();
	},

	bindEvents: function() {
		var self = this;

		// Handler when uploading tribe image
		$('#image').off('change');
	    $('#image').on('change', function () {
	    	var $form = $(this).closest('form');
	    	var url 	= $form.attr('action');

	    	if ($(this).val() == '')
				return true;

			// if (!Global.validateUploadFile($(this)))
			// 	return false;

	    	$form.attr('action', config_file_uploads['url']);

	        $form.ajaxSubmit({
	        	success: function(json) {
		          	if (!json.success) {
                		Global.showAlertMessages(json.alerts);
		              	return true;
		            }

		            var files = $('[name="file_ids"]', $form).val();
					$.each(json.files, function(i, file) {
			            //show message detail result
			            var src = '<img src="' + file.url + '" class="temp-image rounded" />';
			            $('#temp_image').html(src);
			            fn.imageInfo = file.info;

			            $('.temp-image').Jcrop({
			              	bgFade:     true,
			              	bgOpacity: .2,
			              	setSelect: [ 130, 80, 130 + IMAGE_WIDTH, 80 + IMAGE_HEIGHT],
			              	aspectRatio: IMAGE_WIDTH / IMAGE_HEIGHT,
			              	onchange:   self.setCoords,
			              	onSelect:   self.setCoords,
			              	onRelease:  self.clearCoords,
			            }, function() {
			            	fn.jcropCont = this;
			            });

			            files += '[' + file.id +']';
					});
					$('[name="file_ids"]', $form).val(files);

					$('.btn-upload-cancel').removeClass('hide');
	          	},

	          	error: function(xhr) {
		            console.log(xhr);
		        },

	          	dataType: 'json',
	    	});

	    	$form.attr('action', url);
	    });
	},

	render: function() {
		Global.renderMaxlength();
	},

	setCoords: function (c) {
      	var xRatio = fn.imageInfo['width'] / $('.temp-image').width();
      	var yRatio = fn.imageInfo['height'] / $('.temp-image').height();

      	$('.x1').val(Math.round(c.x * xRatio));
      	$('.y1').val(Math.round(c.y * yRatio));
      	$('.w').val( Math.round(c.w * xRatio));
      	$('.h').val( Math.round(c.h * yRatio));
    },

    clearCoords: function (c) {
	    $('.x1').val('');
	    $('.y1').val('');
	    $('.w').val('');
	    $('.h').val('');
    },
}

$(document).ready(function() {
	fn.init();
});