/**
 * DataTables Advanced
 */

'use strict';

$(function () {
  var isRtl = $('html').attr('data-textdirection') === 'rtl';

  var dt_ajax_table = $('.datatables-ajax'),
    dt_filter_table = $('.dt-column-search'),
    dt_adv_filter_table = $('.dt-advanced-search'),
    dt_responsive_table = $('.dt-responsive'),
    assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // Advanced Search Functions Starts
  // --------------------------------------------------------------------

  // Filter column wise function
  function filterColumn(i, val) {
    if (i == 8) {
      var startDate = $('.start_date').val(),
        endDate = $('.end_date').val();

      if (startDate !== '' && endDate !== '') {
        $.fn.dataTableExt.afnFiltering.length = 0; // Reset datatable filter
        dt_adv_filter_table.dataTable().fnDraw(); // Draw table after filter
        filterByDate(i, startDate, endDate); // We call our filter function
      }

      $('.dt-advanced-search').dataTable().fnDraw();
    } else if (i == 6) {
      var startSal = $('.start_sal').val(),
        endSal = $('.end_sal').val();
      $.fn.dataTableExt.afnFiltering.length = 0; // Reset datatable filter
      dt_adv_filter_table.dataTable().fnDraw(); // Draw table after filter
      filterBySal(i, startSal, endSal);
      $('.dt-advanced-search').dataTable().fnDraw();
    } else {

      $('.dt-advanced-search').DataTable().column(i).search(val, false, true).draw();
    }
  }

  // Datepicker for advanced filter
  var separator = ' - ',
    rangePickr = $('.flatpickr-range'),
    dateFormat = 'YYYY-MM-DD';
  var options = {
    autoUpdateInput: false,
    autoApply: true,
    locale: {
      format: dateFormat,
      separator: separator
    },
    opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
  };

  //
  if (rangePickr.length) {
    rangePickr.flatpickr({
      mode: 'range',
      dateFormat: 'Y-m-d',
      onClose: function (selectedDates, dateStr, instance) {
        var startDate = '',
          endDate = new Date();
        // alert(selectedDates[0].getMonth())
        if (selectedDates[0] != undefined) {
          startDate =
            //selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
            selectedDates[0].getFullYear() + '-' + String(selectedDates[0].getMonth() + 1).padStart(2, '0') + '-' + ("0" + selectedDates[0].getDate()).slice(-2);
          $('.start_date').val(startDate);
        }
        if (selectedDates[1] != undefined) {
          endDate =
            //selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
            selectedDates[1].getFullYear() + '-' + String(selectedDates[1].getMonth() + 1).padStart(2, '0') + '-' + ("0" + selectedDates[1].getDate()).slice(-2);
          $('.end_date').val(endDate);
        }
        $(rangePickr).trigger('change').trigger('keyup');
      }
    });
  }

  // Advance filter function
  // We pass the column location, the start date, and the end date
  var filterByDate = function (column, startDate, endDate) {
    // Custom filter syntax requires pushing the new filter to the global filter array
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
      var rowDate = normalizeDate(aData[column]),
        start = normalizeDate(startDate),
        end = normalizeDate(endDate);
     
      // If our date from the row is between the start and end
      if (start <= rowDate && rowDate <= end) {
        return true;
      } else if (rowDate >= start && end === '' && start !== '') {
        return true;
      } else if (rowDate <= end && start === '' && end !== '') {
        return true;
      } else {
        return false;
      }
    });
  };

  // converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
  var normalizeDate = function (dateString) {
    var date = new Date(dateString);
    var normalized =
      date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
    //alert(dateString);
    return normalized;
  };
  // Advanced Search Functions Ends


  // If sal value changes
  $("#sal").keyup(function () {
    setSal()
  });
  // Set start and end sal

  function setSal() {
    var sal = document.getElementById('sal').value;
    var [startSal, endSal] = sal.toString().split("-").map(val => parseInt(val));
    document.getElementById('start_sal').value = startSal;
    document.getElementById('end_sal').value = endSal;
  }

  var filterBySal = function (column, startSal, endSal) {
    //alert(endSal + '')
    // Custom filter syntax requires pushing the new filter to the global filter array
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
      var rowDate1 = aData[column],
        start = startSal,
        end = endSal;

      // If our date from the row is between the start and end
      if (start <= rowDate1 && rowDate1 <= end) {
        return true;
      } else if (rowDate1 >= start && end === '' && start !== '') {
        return true;
      } else if (rowDate1 <= end && start === '' && end !== '') {
        return true;
      } else {
        return false;

      }
    });
  };
  // Ajax Sourced Server-side
  // --------------------------------------------------------------------

  if (dt_ajax_table.length) {
    var dt_ajax = dt_ajax_table.dataTable({
      processing: true,
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      ajax: assetPath + 'data/ajax.php',
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Column Search
  // --------------------------------------------------------------------

  if (dt_filter_table.length) {
    // Setup - add a text input to each footer cell
    $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
    $('.dt-column-search thead tr:eq(1) th').each(function (i) {
      var title = $(this).text();
      $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function () {
        if (dt_filter.column(i).search() !== this.value) {
          dt_filter.column(i).search(this.value).draw();
        }
      });
    });

    var dt_filter = dt_filter_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'full_name' },
        { data: 'email' },
        { data: 'post' },
        { data: 'city' },
        { data: 'start_date' },
        { data: 'salary' }
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      orderCellsTop: true,
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Advanced Search
  // --------------------------------------------------------------------

  // Advanced Filter table
  var url = window.location.origin;
  if (dt_adv_filter_table.length) {
    var dt_adv_filter = dt_adv_filter_table.DataTable({
      ajax: url + "/admin/panel/fetch",
      columns: [
        { data: 'panel_no' },
        { data: 'panel_no' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone_number' },
        { data: 'gender' },
        { data: 'age' },
        { data: 'country_name' },
        { data: 'status' },
        { data: 'created_at' },
      ],

      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Label
          targets: 1,
          render: function (data, type, full, meta) {
            var panel_no = full['panel_no'];
            var panel_id = full['user_id'];
            var panel_url = url + '/admin/panel/&id=' + panel_id;
           
            return (
              '<a href=' + panel_url + '>'+ panel_no + '</a>'
            );
          }
        },
        {
          // Label
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              0: { title: 'Inactive', class: 'badge-light-primary' },
              1: { title: 'Active', class: ' badge-light-success' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        }
      ],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      orderCellsTop: true,
      displayLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
      buttons: [{
        extend: 'collection',
        className: 'btn btn-outline-secondary dropdown-toggle mr-2',
        text: feather.icons['share'].toSvg({
          class: 'font-small-4 mr-50'
        }) + 'Export Panel',
        buttons: [{
          extend: 'print',
          text: feather.icons['printer'].toSvg({
            class: 'font-small-4 mr-50'
          }) + 'Print',
          className: 'dropdown-item',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
          }
        },
        {
          extend: 'csv',
          text: feather.icons['file-text'].toSvg({
            class: 'font-small-4 mr-50'
          }) + 'Csv',
          className: 'dropdown-item',
          exportOptions: {
             columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
          }
        },
        {
          extend: 'excel',
          text: feather.icons['file'].toSvg({
            class: 'font-small-4 mr-50'
          }) + 'Excel',
          className: 'dropdown-item',
          exportOptions: {
             columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
          }
        },
        {
          extend: 'pdf',
          text: feather.icons['clipboard'].toSvg({
            class: 'font-small-4 mr-50'
          }) + 'Pdf',
          className: 'dropdown-item',
          exportOptions: {
             columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
          }
        },
        {
          extend: 'copy',
          text: feather.icons['copy'].toSvg({
            class: 'font-small-4 mr-50'
          }) + 'Copy',
          className: 'dropdown-item',
          exportOptions: {
             columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
          }
        }
        ],
        init: function (api, node, config) {
          $(node).removeClass('btn-secondary');
          $(node).parent().removeClass('btn-group');
          setTimeout(function () {
            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
          }, 50);
        }
      }],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['panel_no'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIndex +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // on key up from input field
  $('input.dt-input').on('keyup', function () {
    filterColumn($(this).attr('data-column'), $(this).val());
  });

  // Responsive Table
  // --------------------------------------------------------------------

  // if (dt_responsive_table.length) {
  //   var dt_responsive = dt_responsive_table.DataTable({
  //     ajax: assetPath + 'data/table-datatable.json',
  //     columns: [
  //       { data: 'responsive_id' },
  //       { data: 'full_name' },
  //       { data: 'email' },
  //       { data: 'post' },
  //       { data: 'city' },
  //       { data: 'start_date' },
  //       { data: 'salary' },
  //       { data: 'age' },
  //       { data: 'experience' },
  //       { data: 'status' }
  //     ],
  //     columnDefs: [
  //       {
  //         className: 'control',
  //         orderable: false,
  //         targets: 0
  //       },
  //       {
  //         // Label
  //         targets: -1,
  //         render: function (data, type, full, meta) {
  //           var $status_number = full['status'];
  //           var $status = {
  //             1: { title: 'Current', class: 'badge-light-primary' },
  //             2: { title: 'Professional', class: ' badge-light-success' },
  //             3: { title: 'Rejected', class: ' badge-light-danger' },
  //             4: { title: 'Resigned', class: ' badge-light-warning' },
  //             5: { title: 'Applied', class: ' badge-light-info' }
  //           };
  //           if (typeof $status[$status_number] === 'undefined') {
  //             return data;
  //           }
  //           return (
  //             '<span class="badge rounded-pill ' +
  //             $status[$status_number].class +
  //             '">' +
  //             $status[$status_number].title +
  //             '</span>'
  //           );
  //         }
  //       }
  //     ],
  //     dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
  //     responsive: {
  //       details: {
  //         display: $.fn.dataTable.Responsive.display.modal({
  //           header: function (row) {
  //             var data = row.data();
  //             return 'Details of ' + data['full_name'];
  //           }
  //         }),
  //         type: 'column',
  //         renderer: function (api, rowIdx, columns) {
  //           var data = $.map(columns, function (col, i) {
  //             return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
  //               ? '<tr data-dt-row="' +
  //                   col.rowIdx +
  //                   '" data-dt-column="' +
  //                   col.columnIndex +
  //                   '">' +
  //                   '<td>' +
  //                   col.title +
  //                   ':' +
  //                   '</td> ' +
  //                   '<td>' +
  //                   col.data +
  //                   '</td>' +
  //                   '</tr>'
  //               : '';
  //           }).join('');

  //           return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
  //         }
  //       }
  //     },
  //     language: {
  //       paginate: {
  //         // remove previous & next text from pagination
  //         previous: '&nbsp;',
  //         next: '&nbsp;'
  //       }
  //     }
  //   });
  // }

  // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
});
