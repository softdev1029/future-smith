$(document).ready(function() {
	var fn = {
		init: function() {
			this.bindEvent();
			this.render();
		},

		bindEvent: function() {
            $('button[data-action]').on('click', function() {
                var self = this;

                var action = $(this).data('action');
                var tribe_id     = $(this).data('id');
                
                var $form = $(this).closest('form');

                var alert_title = 'Confirm';
                var alert_message = null;

                if (action == 'LEAVE')
                    alert_message = 'Are you sure to leave this tribe?';

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

                            $('input[name="tribe_id"]', $form).val(tribe_id);

                            $form.submit();
                        }
                    }
                });

                return false;
            });
		},

		render: function() {
			Global.renderTooltip();
		},

	}

	fn.init();
});