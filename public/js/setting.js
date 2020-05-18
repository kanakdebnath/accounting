var tariq = '';
var flag = true;
var DatatableButtonsHtml5 = function() {
    
    var _componentRemoteModalLoad = function() {
        $(document).on('click', '#content_managment', function(e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    _modalFormValidation();
                    if (flag) {
                        _componentAjaxStateLoad();
                        _componentAjaxCityLoad();
                        flag = false;
                    }
                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });
    };

    return {
        init: function() {

            _componentRemoteModalLoad();
            _formValidation();

        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});

  $(document).on('submit','.ajax_submit', function(e){
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        $.ajax({
            url: url,
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
                $('#submit').show();
                $('#submiting').hide();
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
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

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            width: '30%',
                            title: jsUcfirst(first_item) + ' Error!!',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        width: '30%',
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });

    