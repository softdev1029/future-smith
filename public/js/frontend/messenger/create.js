var fn = {
	init: function() {
		this.bindEvents();
		this.render();
	},

	bindEvents: function() {
		var self = this;

        // create discussion
		$('button[data-action]').on('click', function() {
			
            var self = this;

			var type = $(this).data('type');
            var ref_id     = $(this).data('ref_id');
            
            var $form = $(this).closest('form');

            $('input[name="type"]', $form).val(type);
            $('input[name="ref_id"]', $form).val(ref_id);

            $form.submit();

            return false;
        });
	},

	render: function() {
		Global.renderMaxlength();
	},
}

$(document).ready(function() {
	fn.init();
});