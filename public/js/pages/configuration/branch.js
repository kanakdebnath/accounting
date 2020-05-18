var tariq = '';
var DatatableButtonsHtml5 = function() {
    var _componentDatatableButtonsHtml5 = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }
        $(document).on('search.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'page.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'order.dt', function(e, settings) {
            cardBlock()
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            dom: '<"dt-buttons-full"B><"datatable-header"fl><"datatable-wrap"t><"datatable-footer"ip>',
            // dom: '<"datatable-header"fBl><"datatable-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                loadingRecords: "Getting records...",
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                },
                select: {
                    rows: {
                        _: "%d rows Selected",
                        0: "Click a row to select it",
                        1: "1 row Selected"
                    }
                }
            }
        });
        // Basic initialization
        tariq = $('.content_managment_table').DataTable({
            /*footerCallback: function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                // Total over all pages
                total = api.ajax.json().gros_total;
                // Total over this page
                pageTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer
                $(api.column(4).footer()).html(
                    '$' + pageTotal + ' ( $' + total + ' total)'
                );
            },*/
            fnDrawCallback: function(oSettings) {
                dataTableReload();
            },
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            buttons: [{
                extend: 'selectAll',
                className: 'btn bg-indigo-800'
            }, {
                extend: 'selectNone',
                className: 'btn bg-blue-800',
                text: 'Unselect All'
            }, {
                extend: 'selected',
                className: 'btn btn-danger',
                text: 'Delete',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, 'configuration/branch/action', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-success',
                text: 'Online',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, 'configuration/branch/action', action = 'active', msg = 'Change Status To Online');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-secondary',
                text: 'Offline',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, 'configuration/branch/action', action = 'inactive', msg = 'Change Status To Offline');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-warning',
                text: 'Toggle Status',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, 'configuration/branch/action', action = 'toggle', msg = 'Toggle Status');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 6]
            }, {
                orderable: false,
                targets: [2, 6]
            }],
            order: [0, 'desc'],
            processing: true,
            serverSide: true,
            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'contact',
                    name: 'contact'
                }, {
                    data: 'address',
                    name: 'address'
                }, {
                    data: 'description',
                    name: 'description'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    };
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
                    $('#branch_no').focus();
                    _componentCountrySelect2();
                    _componentInputSwitchery();
                    _componentUniform();
                    _modalBranchFormValidation();
                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });
    };
    return {
        init: function() {
            _componentDatatableButtonsHtml5();
            _componentSelect2Normal();
            _componentRemoteModalLoad();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});