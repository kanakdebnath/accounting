/* ------------------------------------------------------------------------------
 *
 *  # Login pages
 *
 *  Demo JS code for a set of login and registration pages
 *
 *  CopyRight © TeamTRT
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var LoginRegistration = function() {

    //
    // Return objects assigned to module
    //
    var _componentValidation = function() {
        $('#content_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
        $('#content_form').on('submit', function(e) {
            e.preventDefault();
            $('#submit').attr('disabled',true);
            $('#user_icon').addClass('spinner');
            $('#submit').html('Signing In <i class="icon-spinner2 spinner ml-2"></i>');
            var submit_url = $('#content_form').attr('action');
            //Start Ajax
            var formData = new FormData($("#content_form")[0]);
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: formData,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function(data) {
                    p_notify(data.message, 'success', 'Success');
                    $('#submit').attr('disabled',false);
                    $('#user_icon').removeClass('spinner');
                    $('#submit').text('Sign in');
                    noty('Be Patient. We are redirecting you to your destination.', 'success', 'Welcome', 'center');
                    setTimeout(function(){
                        window.location.href = data.goto;
                    }, 2000);
                },
                error: function(data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors;
                    if (errors) {
                        var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if($('#' + first_item).length > 0){
                             $('#' + first_item).parsley().removeError('required', {updateClass: true});
                            $('#' + first_item).parsley().addError('required', {message: value, updateClass: true});
                        }
                        p_notify(value);
                        i++;
                    });
                    } else{
                        p_notify(jsonValue.message);
                    }
                    $('#submit').attr('disabled',false);
                    $('#user_icon').removeClass('spinner');
                    $('#submit').text('Sign in');
                }
            });
        });
    };

    return {
        initComponents: function() {
            _componentUniform();
            _componentValidation();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    LoginRegistration.initComponents();
});