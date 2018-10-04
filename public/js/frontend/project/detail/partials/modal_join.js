var fn = {
	init: function() {
		this.bindEvents();
		this.render();
	},

	bindEvents: function() {
	},

	render: function() {
		Global.renderMaxlength();
	}
}

$(document).ready(function() {
	fn.init();
});