(function ($) {
	var fn = {
		init: function() {
			this.bindEvents();
			this.render();
		},

		bindEvents: function() {
			var self = this;

			var $modal = $('#model_join_stripe_plan');

			$modal.on('shown.bs.modal', function (e) {
				StripeForm.init();

				var $button = $(e.relatedTarget);
				var action  = $button.data('action');
				var plan_id = $button.data('plan-id');

				$('[name="_action"]', $modal).val(action);
				$('[name="plan_id"]', $modal).val(plan_id);
			});
			
			$('button[data-plan-id]').on('click', function() {
				var $form = $(this).closest('form');

				var action  = $(this).data('action');
				var plan_id = $(this).data('plan-id');

				var alert_title = 'Confirm';
				var alert_message = null;

				if (action == 'CANCEL')
					alert_message = 'Are you sure to cancel your subscription?';
				else if (action == 'RESUME')
					alert_message = 'Are you sure to continue your subscription?';
				else
					return true;

				$.alert.create({
					message: alert_message,
					title: alert_title,
					cancelButton: {
						label: "No",
						className: '',
						callback: function() {
						}
					},
					actionButton: {
						label: "Yes",
						className: '',
						callback: function() {

							$('input[name="_action"]', $form).val(action);
							$('input[name="plan_id"]', $form).val(plan_id);

							$form.submit();
						}
					}
				});

				return false;
			});

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

	fn.init();
})(jQuery);