(function ($) {
	$.fileinput = {
	};

	$.fn.fileinput = function (params) {
		var options = $.extend({}, $.fn.fileinput.defaults, params);

		return this.each(function() {
			if ($(this).attr('type').toLowerCase() != 'file')
				return;

			var file_type = $(this).data('file-type');
			var $form = $(this).closest('form');
			var $self = $(this);

			$('body').off('click', '.file-upload-container .attachments .file a.link-delete');
			$('body').on('click', '.file-upload-container .attachments .file a.link-delete', function() {
				var $self = $(this);
				var $form = $(this).closest('form');
				var $container = $(this).closest('.file-upload-container');
				
				$(document).data('block-ui-custom', $('.loading', $container));

				$.ajax({
					'url': $(this).attr('href'),
					'dataType': 'json',
					'type': 'DELETE',
					'success': function() {
						$self.closest('.file').slideUp(400, function() {
							$('body').trigger('fileinput.delete.file');
						});

						var files 	= $('[name="file_ids"]', $form).val();
						var file_id = $self.data('id');

						files = files.replace('[' + file_id + ']', '');
						$('[name="file_ids"]', $form).val(files);
					}
				});

				return false;
			});

			$(this).off('change');
			$(this).on('change', function(e) {
				var $form 	= $(this).closest('form');
				var url 	= $form.attr('action');
				var $container = $(this).closest('.file-upload-container');

				if ($(this).val() == '')
					return true;

				if (!Global.validateUploadFile($(this)))
					return false;

				$(document).data('block-ui-custom', $('.loading', $container));

				$form.attr('action', config_file_uploads['url']);
				$form.ajaxSubmit({
					success: function(json) {
						$form.attr('action', url);

						Global.showAlertMessages(json.alerts);

						if ( !json.success ) {
							return false;
						}

						var files = $('[name="file_ids"]', $container).val();
						$.each(json.files, function(i, file) {
							$('.attachments', $container).append('\
									<div class="file unused">\
										<a class="link-delete" href="' + file.delete_url + '" data-id="' + file.id + '"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;&nbsp;<a href="' + file.download_url + '" class="link-file" target="_blank">' + file.name + '</a>\
									</div>');

							files += '[' + file.id +']';
						});
						$('[name="file_ids"]', $container).val(files);

						$('body').trigger('fileinput.add.file');

						$self.val('');
					},

					error: function(xhr) {
						$form.attr('action', url);
					},

					dataType: 'json',
				});

				$form.attr('action', url);
			});

			$('[data-toggle="tooltip"]').tooltip();
		});
	}

	$.fn.fileinput.defaults = { };

})(jQuery);