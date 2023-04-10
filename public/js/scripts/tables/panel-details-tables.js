/**
 * DataTables Advanced
 */

'use strict';

$(function () {
  var dt_responsive_table_tx = $('.dt-responsive-tx');

  if (dt_responsive_table_tx.length) {

    var dt_responsive = dt_responsive_table_tx.DataTable({
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
  /** JS code for redemptions table */
  var dt_responsive_table_red = $('.dt-responsive-red');

  if (dt_responsive_table_red.length) {

    var dt_responsive = dt_responsive_table_red.DataTable({
  
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');

  var dt_responsive_table_ref = $('.dt-responsive-ref');

  if (dt_responsive_table_ref.length) {

    var dt_responsive = dt_responsive_table_ref.DataTable({
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
});
