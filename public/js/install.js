/* ------------------------------------------------------------------------------
 *
 *  # Steps wizard
 *
 *  Demo JS code for form_wizard.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var FormWizard = function() {

    //
    // Setup module components
    //

    // Wizard
    var _installFormValidation = function() {
        $('#install_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
        $('#install_form').on('submit', function(e) {
            e.preventDefault();
            $('#submit').attr('disabled', true);
            $('#submit').html('Checking <i class="icon-spinner2 spinner"></i>');
            var submit_url = $('#install_form').attr('action');
            var next_url = $('#install_form #submit').data('url');
            //Start Ajax
            var formData = new FormData($("#install_form")[0]);
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: formData,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function(data) {
                    new PNotify({
                        title: 'Well Done!',
                        text: data.message,
                        type: 'success',
                        addclass: 'alert alert-styled-left',
                    });
                    if (next_url) {
                        // leave it blank before ajax call
                        $('#content').html('');
                        $.ajax({
                                url: next_url,
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('#content').html(data).fadeIn(); // load response
                                _installFormValidation();
                            })
                            .fail(function(data) {
                                $('#content').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                            });
                    } else if(data.goto){
                        setTimeout(function(){
                            window.location.href = data.goto;
                        }, 2000);
                    }else {
                        $('#submit').attr('disabled', false);
                        $('#submit').text('Submit');
                    }
                },
                error: function(data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors;
                    if (errors) {
                        var i = 0;
                        $.each(errors, function(key, value) {
                            const first_item = Object.keys(errors)[i];
                            const message = errors[first_item][0];
                            if ($('#' + first_item).length > 0) {
                                $('#' + first_item).parsley().removeError('required', {
                                    updateClass: true
                                });
                                $('#' + first_item).parsley().addError('required', {
                                    message: value,
                                    updateClass: true
                                });
                            }
                            p_notify(value);
                            i++;
                        });
                    } else {
                        p_notify(jsonValue.message);
                    }
                    $('#submit').attr('disabled', false);
                    $('#submit').text('Submit');
                }
            });
        });
    };

    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _installFormValidation();
            _componentUniform();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FormWizard.init();
});