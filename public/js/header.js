/**
 * @created Dejan
 * @since Sep 26, 2018
 */

 (function ($) {
 	var fn = {
 		init: function() {
 			this.bindEvents();
 			this.render();
 		},

 		bindEvents: function() {
      $('#navbarNotificationDropdown').on('click', function() {
        var a=$(this).attr('href');
        console.log('a='+a);
        $.ajax({
					'url': $(this).attr('href'),
					'dataType': 'json',
					'type': 'GET',
					'success': function() {
            $('#navbarNotificationDropdown').html('');
          }
        });
      });
 		},

 		render: function() {
 		}
 	};

 	fn.init();
 })(jQuery);
