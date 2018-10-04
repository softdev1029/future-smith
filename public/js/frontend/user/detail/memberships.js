(function ($) {
	var fn = {
		init: function() {
			this.bindEvents();
			this.render();
		},

		bindEvents: function() {
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
				var input = false;

				if (action == 'CANCEL') {
					alert_title = 'Why do you cancel your subscription?';
					input = true;
				} else if (action == 'RESUME') {
					alert_message = 'Are you sure to continue your subscription?';
					input = false;
				} else
					return true;

				$.alert.create({
                    message: alert_message,
					title: alert_title,
					input: input,
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
		},

		render: function() {
		}
	};

	fn.init();
})(jQuery);