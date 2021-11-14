$(document).ready(function() {
  paginationProduct();
}); 

function paginationProduct(){
  let productModel =  $('#product_model').val();
  let productCategory =  $('#product_category').val();
  var session_length = 10;
  var table = $('#data_table_list').DataTable({
      paging: true,
      pageLength: 10,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'pdf',
          title: 'Product List',
          filename: 'customized_pdf_product_list'
      }, {
          extend: 'excel',
          title: 'Product List EXCEL',
          filename: 'customized_excel_product_list'
      }, {
          extend: 'csv',
          filename: 'customized_csv_product_list'
      }],
      "searching": true,
      "ordering": false,
      "info": true,
      "lengthChange": true,
      "bProcessing": true,
      "bServerSide": true,
      "destroy":true,
      "sAjaxSource": "product_list_pagination",
      "fnServerData": function (sSource, aoData, fnCallback) {
          aoData.push({ "name": "product_model", "value": productModel },{ "name": "product_category", "value": productCategory });
          $.getJSON(sSource, aoData, function (json) {
              fnCallback(json)
          });
      },
      // "sAjaxSource": "product_list_pagination?product_model=".$('#product_model').val()."&product_category=".$('#product_category').val()."",
      columns: [
          { data: "id" },
          { data: "product_name" },
          { data: "product_category" },
          { data: "product_model" },
      ]
  });
}