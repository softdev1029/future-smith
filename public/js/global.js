/**
 * @created Dejan
 * @since Sep 19, 2018
 */

 var Global = {
 	// render bootstrap maxlength handler plugin
 	renderMaxlength: function(params) {
 		var options = {
            limitReachedClass: "badge badge-danger",
            alwaysShow: true,
            // threshold: 5,
            utf8: false,
            // showOnReady: true,
            warningClass: 'badge badge-primary',
 		};

 		if (typeof params != 'undefined')
 			options = $.extend({}, options, params);

 		$('.maxlength-handler').maxlength(options);
 	},

    renderFileInput: function() {
        $('input[type="file"]').fileinput();
    },

    renderTooltip: function() {
        $('[data-toggle="tooltip"]').tooltip();
    },

    validateUploadFile: function($file) {
        if (!window.FileReader)
            return true;

        var result = true;

        var max_size = $file.data('max-size');
        var error_file_size = $file.data('error-file-size');
        var file_types = $file.data('file-types');
        var error_file_type = $file.data('error-file-type');

        var file_element = $file[0];
        var files = file_element.files;

        // Check file size
        if (typeof max_size != 'undefined' && typeof error_file_size != 'undefined') {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                if (file.size > max_size) {
                    Global.toastr('', '[' + file.name + ']: ' + error_file_size, 'error', {});
                    result = false;
                }
            }
        }

        // Check file extension
        if (typeof file_types != 'undefined' && typeof error_file_type != 'undefined') {
            file_types = file_types.split(',');
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                var valid_ext = false;
                $.each(file_types, function(index, file_type) {
                    if (file.name.toLowerCase().indexOf('.' + file_type.toLowerCase()) >= 0) {
                        valid_ext = true;
                        return false;
                    }
                });

                if (!valid_ext) {
                    Global.toastr('', '[' + file.name + ']: ' + error_file_type, 'error', {});
                    result = false;
                }
            }
        }

        return result;
    },

    updateUniform: function () {
        $.uniform.update();
    },

    showAlertMessages: function() {

    },

    renderSelect2: function() {
        require(['select2'], function() {
            $('select.select2, select.select2-ajax').each(function() {
                var defaultOptions = { minimumResultsForSearch: -1 };
                var options = {};
                
                if ($(this).data('width') != undefined)
                    options['width'] = $(this).data('width');
                
                if ($(this).data('placeholder') != undefined)
                    options['placeholder'] = $(this).data('placeholder');
                
                if ($(this).data('allow-clear') != undefined)
                    options['allowClear'] = $(this).data('allow-clear');
                
                if ($(this).data('minimumResultsForSearch') != undefined)
                    options['minimumResultsForSearch'] = $(this).data('minimumResultsForSearch');
                
                if ($(this).data('maximumSelectionLength') != undefined)
                    options['maximumSelectionLength'] = $(this).data('maximumSelectionLength');

                if ($(this).hasClass('select2-ajax')) {
                    options['minimumInputLength'] = 2;
                    options['ajax'] = {
                        url: $(this).data('url'),
                        dataType: 'json',
                        type: 'post',
                        blockUI: false,
                        processResults: function (data) {
                            // Tranforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                    };
                }

                var $options = $('option', $(this));
                if ($(this).data('minimumResultsForSearch') == undefined && $options.length > 20)
                    options['minimumResultsForSearch'] = 5;

                options = $.extend({}, defaultOptions, options);
                
                $(this).select2(options);

                // if ($(this).data('sortable') != undefined) {
                //     var $this = $(this);

                //     $(this).next().find('.select2-selection__rendered').sortable({
                //         containment: 'parent',
                //         start: function() { $this.select2("onSortStart"); },
                //         update: function() { $this.select2("onSortEnd"); }
                //     });
                // }

                if ($(this).hasClass('select2-ajax')) {
                    // Fix issue on select2 on skills
                    $('.select2-search--inline input', $(this).next()).off('keydown focus');
                    $('.select2-search--inline input', $(this).next()).on('keydown focus', function() {
                        window.setTimeout(function() {
                            $(window).trigger('scroll');
                        }, 1);
                    });
                }
            });
        });
    },

    init: function() {
    }
 };

 $(document).ready(function() {
    Global.init();
 });