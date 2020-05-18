/*
 * Form Checkbox Uniform 
 */
 $('.select').select2();
var _componentUniform = function() {
    if (!$().uniform) {
        console.warn('Warning - uniform.min.js is not loaded.');
        return;
    }
    $('.form-input-styled').uniform();
};

/*
 * Tooltip Custom Color
 */

var _componentTooltipCustomColor = function() {
    $('[data-popup=tooltip-custom]').tooltip({
        template: '<div class="tooltip"><div class="arrow border-teal"></div><div class="tooltip-inner bg-teal"></div></div>'
    });
};

/*
 * Form Datepicker Uniform 
 */

 //datepicker setting
   $('.pickadate-accessibility').pickadate({
        labelMonthNext: 'Go to the next month',
        labelMonthPrev: 'Go to the previous month',
        labelMonthSelect: 'Pick a month from the dropdown',
        labelYearSelect: 'Pick a year from the dropdown',
        selectMonths: true,
        selectYears: true,
        format: 'mm-dd-yyyy',
        formatSubmit: undefined,
        hiddenPrefix: undefined,
        hiddenSuffix: '_submit',
        hiddenName: undefined,
    });


var _componentDatePicker = function() {
    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);
    // console.log(local);
    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
};

/*
 * Form Select 2 For Modal 
 */

var _componentSelect2Modal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

/*
 * Form Select2
 */
var _componentSelect2Normal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

/*
 * For Switchery for Datatable Status 
 */

var _componentStatusSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-status-switchery'));

    if (elems.length > 0) {
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * For Switchery input field
 */

var _componentInputSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var input_elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
    if (input_elems.length > 0) {
        input_elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * Form Validation
 */

var _formValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    }
    
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
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
              if(data.status == 'danger'){
                    new PNotify({
                            title: 'Error',
                            text: data.message,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                   
                  }
            else {
                new PNotify({
                    title: 'Success',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('#submit').show();
                $('#submiting').hide();
                if (data.goto) {
                   setTimeout(function(){

                     window.location.href=data.goto;
                   },2500);
                }
            }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            title: 'Error',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

/*
 * Form Validation For Modal
 */

var _modalFormValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    }
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
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
                  if(data.status == 'danger'){
                    new PNotify({
                            title: 'Error',
                            text: data.message,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                   
                  }
              else{
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('#submit').show();
                $('#submiting').hide();
                $('#modal_remote').modal('toggle');
                 if (data.goto) {
                   setTimeout(function(){

                     window.location.href=data.goto;
                   },2500);
                }
                if (typeof(tariq) != "undefined" && tariq !== null) {
                    tariq.ajax.reload(null, false);
                }
            }
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
};


$(document).ready(function() {
    /*
     * For Logout
     */
    $(document).on('click', '#logout', function(e) {
        e.preventDefault();
        $('.preloader').show('fade');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'Post',
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
                new Noty({
                    theme: 'limitless',
                    timeout: 2000,
                    title: 'Welcome',
                    text: 'Be Patient. We are redirecting you to your destination.',
                    type: 'success',
                    modal: true,
                    layout: 'center'
                }).show();
                setTimeout(function() {
                    window.location.href = data.goto;
                }, 2000);
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors
                var i = 0;
                $.each(errors, function(key, value) {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: value,
                        type: 'error',
                        addclass: 'alert  alert-danger alert-styled-left',
                    });
                    i++;
                });
            }
        });
    });


    /*
     * For Delete Item
     */
    $(document).on('click', '#delete_item', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();
        //console.log(row, url);
        swal({
                title: "Are you sure?",
                text: "Once deleted, it will deleted all related Data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Delete',
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
                             if (data.goto) {
                                   setTimeout(function(){

                                     window.location.href=data.goto;
                                   },2500);
                                }
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Error',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
    });


    /*
     * For Status Change
     */
    $(document).on('click', '#change_status', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        var status = $(this).data('status');
        if (status == 1) {
            msg = 'Change Status Form Online To Offline';
        } else {
            msg = 'Change Status Form Offline To Online';
        }
        $('#status_' + row).hide();
        $('#status_loading_' + row).show();
        swal({
                title: "Are you sure?",
                text: msg,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Put',
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
                            if (typeof(tariq) != "undefined" && tariq !== null) {
                                tariq.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            if (errors) {
                                var i = 0;
                                $.each(errors, function(key, value) {
                                    new PNotify({
                                        title: 'Something Wrong!',
                                        text: value,
                                        type: 'error',
                                        addclass: 'alert alert-danger alert-styled-left',
                                    });
                                    i++;
                                });
                            } else {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: jsonValue.message,
                                    type: 'error',
                                    addclass: 'alert alert-styled-left',
                                });
                            }
                            $('#status_loading_' + row).hide();
                            $('#status_' + row).show();
                        }
                    });
                } else {
                    $('#status_loading_' + row).hide();
                    $('#status_' + row).show();
                }
            });
    });

    /*
     * For Datatabel Reload
     */
    $(document).on('click', '#reload', function() {
        if (typeof(tariq) != "undefined" && tariq !== null) {
            tariq.ajax.reload(null, false);
        }
    });


    /*
     * For Date Picker
     */
    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);
    // console.log(local);
    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
});


/*
 * For Uppercase Word first Letter
 */
function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


/*
 * For Card Block
 */
function cardBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');

    // Block card
    $(block).block({
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });
}


/*
 * For Unblock Card
 */
function cardUnBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');
        $(block).unblock();
}



/*
 * For Datatable Reload
 */
function dataTableReload() {
    cardBlock();
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}


/*
 * For Datatable Load
 */
function dataTableLoad() {
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}



/*
 * For Get Data Table Selected Rows Id
 */
function getDatatableSelectedRowIds(dt) {
    var ids = [];
    var rows = dt.rows('.selected').data();
    $.each(rows, function(index, value) {
        ids.push(value['id']);
    });
    return ids;
}


/*
 * For Perform Datatable Controles Button
 */
function datatableSelectedRowsAction(dt, url, action = 'delete', msg = 'Are You Sure') {
    var ids = getDatatableSelectedRowIds(dt);
    var url = Base_url_admin + url;
    swal({
            title: "Are you sure?",
            text: msg,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                cardBlock();
                $.ajax({
                    url: url,
                    method: 'Put',
                    data: {
                        action: action,
                        ids: ids
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        new PNotify({
                            title: 'Well Done!',
                            text: data.message,
                            type: 'success',
                            addclass: 'alert alert-styled-left',
                        });
                    },
                    error: function(data) {
                        //console.log(data)
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors
                        if (errors) {
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                        } else {
                            new PNotify({
                                title: 'Something Wrong!',
                                text: jsonValue.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });
                        }
                    }
                });
                dt.ajax.reload(null, false);
            }
        });
}


var _componentCountrySelect2 = function(id = '#content_form', select_id = '#country') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link add_new_customer" data-form_id="' + id + '"  id="add_new_country" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Country </button>'
                    );
                } else {
                    return 'No Country Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};

var _componentStateSelect2 = function(id = '#content_form', select_id = '#state') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link add_new_customer" data-form_id="' + id + '" id="add_new_state" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New State </button>'
                    );
                } else {
                    return 'No State Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};

var _componentCitySelect2 = function(id = '#content_form', select_id = '#city') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_city" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New City </button>'
                    );
                } else {
                    return 'No City Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_city', function() {
    var form_id = $(this).data('form_id');
    $('#country').select2('close');
    $('#state').select2('close');
    $('#city').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
    var country = $('select#country').val();
    var state = $('select#state').val();
    if (!country) {
        swal({
                title: "Opps?",
                text: 'Select A Country First To Add City',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#country > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/country/create?form_id=select_form',
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else if (!state) {
        swal({
                title: "Opps?",
                text: 'Select A State First To Add City',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#state > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/country/state/create?name=' + name + '&form_id=select_form&country=' + country,
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _componentCountrySelect2('#select_form');
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else {
        $.ajax({
                url: Base_url_admin + 'configuration/country/city/create?name=' + name + '&form_id=select_form&country=' + country + '&state=' + state,
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _componentCountrySelect2('#select_form');
                _componentStateSelect2('#select_form');
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    }
});
$(document).on('click', '#add_new_state', function() {
    var form_id = $(this).data('form_id');
    $('#country').select2('close');
    $('#state').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
    var country = $('select#country').val();
    if (!country) {
        swal({
                title: "Opps?",
                text: 'Select A Country First To Add state',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#country > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/country/create?form_id=select_form',
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else {
        $.ajax({
                url: Base_url_admin + 'configuration/country/state/create?name=' + name + '&form_id=select_form&country=' + country,
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _componentCountrySelect2('#select_form');
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    }
});
$(document).on('click', '#add_new_country', function() {
    var form_id = $(this).data('form_id');
    $(form_id + ' #country').select2('close');
    $('#content_form').hide();
    $('#select_form').remove();
    $('#modal-loader').show();
    var name = $(this).data('name');
    $.ajax({
            url: Base_url_admin + 'configuration/country/create?name=' + name + '&form_id=select_form',
            type: 'Get',
            dataType: 'html'
        })
        .done(function(data) {
            $('.modal-body').append(data).fadeIn(); // load response
            $('#modal-loader').hide();
            $('#select_form #sortname').focus();
            // _componentSelect2Modal();
            _modalSelectFormValidation();
        })
        .fail(function(data) {
            $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
            $('#modal-loader').hide();
        });
});

var _modalSelectFormValidation = function() {
    $('#select_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    $('#select_form').on('submit', function(e) {
        e.preventDefault();
        $('#select_form #submit').hide();
        $('#select_form #submiting').show();
        $("#select_form .ajax_error").remove();
        var target = $("#select_form #target").val();
        var submit_url = $('#select_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#select_form")[0]);
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
                $('select#' + target).append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                );
                $('select#' + target)
                    .val(data.model.id)
                    .trigger('change');
                $('#content_form').show();
                $('#select_form').remove();
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#select_form #' + first_item).length > 0) {
                            $('#select_form #' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#select_form #' + first_item).parsley().addError('required', {
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
                $('#select_form #submit').show();
                $('#select_form #submiting').hide();
            }
        });
    });
};

$(document).on('click', '#back_to_previous', function() {
    $('#select_form').remove();
    $('#content_form').show();
});

var _componentAjaxStateLoad = function(form_id = '#content_form', select_id = '#country', state_id = '#state') {
    $(document).on('change', select_id, function(e) {
        var content_id = form_id + ' ' + state_id;
        var country = $(this).val();
        $(content_id + '>option').remove();
        var state = $(form_id + ' select' + state_id);
        state.append(
            $('<option>', {
                value: '',
                text: 'Select Country'
            })
        );
        state.trigger('change');
        $.ajax({
                url: Base_url + '/api/select/state',
                type: 'post',
                data: {
                    country: country
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    state.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                state.trigger('change');
            })
            .fail(function(data) {
                new PNotify({
                    title: 'Something Wrong!',
                    text: 'Check Again And Try Again',
                    type: 'error',
                    addclass: 'alert alert-danger alert-styled-left',
                });
            });
    });
};

var _componentAjaxCityLoad = function(form_id = '#content_form') {
    $(document).on('change', '#state', function(e) {
        var state = $(this).val();
        var country = $(form_id + ' #country').val();
        $(form_id + ' #city>option').remove();
        var city = $(form_id + ' select#city');
        city.append(
            $('<option>', {
                value: '',
                text: 'Select State'
            })
        );
        city.trigger('change');
        $.ajax({
                url: Base_url + '/api/select/city',
                type: 'post',
                data: {
                    country: country,
                    state: state
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    city.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                city.trigger('change');
            });
    });
};

function p_notify(msg= 'Something Wrong', type='error', title="Opps!!" ){
    new PNotify({
        title: title,
        text: msg,
        type: type,
        addclass: 'alert alert-styled-left',
    });
}

function noty(msg= 'Something Wrong', type='error', title="Opps!!", layout='topRight'){
    new Noty({
        theme: 'limitless',
        timeout: 2000,
        title: title,
        text: msg,
        type: type,
        modal:true,
        layout: 'center'
    }).show();
}