/**
 * DataTables Extensions (jquery)
 */

'use strict';

$(function () {
  var dt_scrollable_table = $('.dt-scrollableTable'),
    dt_fixedheader_table = $('.dt-fixedheader'),
    dt_fixedcolumns_table = $('.dt-fixedcolumns'),
    dt_select_table = $('.dt-select-table');

  // Scrollable
  // --------------------------------------------------------------------

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: assetsPath + 'json/table-datatable.json',
      scrollY: '300px',
      autowidth: false,
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
    });
  }

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 200);
});
