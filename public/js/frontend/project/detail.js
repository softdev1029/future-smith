$(document).ready(function() {
	var fn = {
		init: function() {
			this.bindEvent();
			this.render();

			if (typeof fn[project_page] == 'undefined')
				return;

			fn[project_page].init();
		},

		bindEvent: function() {

		},

		render: function() {
			Global.renderTooltip();
		},

		join_requests: {
			init: function() {
				this.bindEvent();
				this.render();
			},

			bindEvent: function() {
				$('table button[data-action]').on('click', function() {
					var self = this;

					var action = $(this).data('action');
					var id     = $(this).data('id');
					
					var $form = $(this).closest('form');

					var alert_title = 'Confirm';
					var alert_message = null;

					if (action == 'ACCEPT')
						alert_message = 'Are you sure to accept this request?';
					else if (action == 'DECLINE')
						alert_message = 'Are you sure to decline this request?';

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
								$('input[name="member_id"]', $form).val(id);

								$form.submit();
                            }
                        }
                    });

                    return false;
				});
			},

			render: function() {
			}
		}
	}

	fn.init();
});