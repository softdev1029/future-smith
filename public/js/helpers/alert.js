/**
 * @author KCG
 * @since July 14, 2017
 */
(function ($) {
	$.alert = {
		className: 'modal-alert',
		close: function() {
			$('.' + $.alert.className).modal('hide');
		},

		selector: function($obj) {
			var id 			= $obj.attr('id');
			var className 	= $obj.attr('class');
			var selector = $obj[0].tagName;

			if (typeof id != 'undefined') {
				selector += '#' + id;

				return selector;
			}

			if (typeof className != 'undefined') {
				var parts = className.split(' ');
				for (var i = 0; i < parts.length; i++) {
					selector += '.' + parts[i];
				}
			}

			return selector;
		},

		create: function(params, $this) {
			var options = $.extend({}, $.fn.alert.defaults, params);

			var $self = $this;
			var className = (typeof $this == 'undefined'?'modal-alone-alert':'modal-' + $.alert.selector($this).replace(/[ \.#]/g, ''));
			var html = '';

			html += '<div class="modal fade ' + className + ' ' + $.alert.className + '" tabindex="-1" role="dialog" aria-labelledby="modal_alert_title" aria-hidden="true">';
				html += '<div class="modal-dialog modal-dialog-centered" role="document">';
					html += '<div class="modal-content">'
						html += '<div class="modal-header">';
							html += '<h5 class="modal-title" id="modal_alert_title">' + options.title + '</h5>';
							html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
								html += '<span aria-hidden="true">&times;</span>';
							html += '</button>';
						html += '</div>'; // .modal-header
						html += '<div class="modal-body">';
						if (options.input) {
							html += '<div class="form-group">';
                        		html += '<textarea class="form-control maxlength-handler" id="join_request_message" name="message" placeholder="Your Message" required rows="5" maxlength="1500"></textarea>';
                    		html += '</div>';
						} else {
							html += options.message;
						}
						html += '</div>'; // .modal-body
						html += '<div class="modal-footer">';
							var button = options.cancelButton;
							html += '<button type="button" data-dismiss="modal" class="btn btn-secondary ' + button.className + ' btn-cancel">' + button.label + '</button>';

							button = options.actionButton;
							html += '<button type="button" data-dismiss="modal" class="btn btn-primary ' + button.className + ' btn-action">' + button.label + '</button>';
						html += '</div>'; // .modal-footer
					html += '</div>';// .modal-content
				html += '</div>';// .modal-dialog
			html += '</div>';// .modal

			$('.' + className).remove();
			$('body').append(html);

			var $modal = $('.' + $.alert.className + '.' + className);

			if (typeof $this != 'undefined') {
				$this.off('click');
				$this.on('click', function() {
					$modal.modal('show');
				});
			} else {
				$modal.modal('show');
			}

			$('.btn-action', $modal).off('click');
			$('.btn-action', $modal).on('click', function(e) {
				$modal.on('hidden.bs.modal', function() {
					options.actionButton.callback(e, $self);
				});
			});

			$('.btn-cancel', $modal).off('click');
			$('.btn-cancel', $modal).on('click', function(e) {
				options.cancelButton.callback(e, $self);
			});
		}
	};

	$.fn.alert = function (params) {
		var options = $.extend({}, $.fn.alert.defaults, params);

		return this.each(function() {
			$.alert.create(params, $(this));
		});
	}

	$.fn.alert.defaults = {
		message: '',
		title: '',
		cancelButton: {
			label: "Cancel",
            className: 'btn-default',
            callback: function() {

            }
		},
		actionButton: {
			label: "Okay",
            className: 'blue',
            callback: function() {
            	
            }
		}
	};

})(jQuery);