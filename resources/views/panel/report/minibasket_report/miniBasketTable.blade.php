{{-- @push('admincss')
<style>
  @media print {
  .header-print {
    display: table-header-group;
  }
}
</style>
@endpush --}}
<table class="display table table-bordered table-striped stripe" id="dynamic-table" style="direction: rtl;width:100%">
<thead id="head">
  <tr>
      <th rowspan="3">الاسم</th>
      <th rowspan="3">رقم كارت البنك الأهلى</th>
      <th rowspan="3">فئة الفترة</th>
      <th rowspan="3" id="feeding">فئة بدل التغذية</th>
      <th rowspan="3">اجمالى عدد الفترات</th>
      <th rowspan="3">اجمالى قيمة الفترات</th>
      <th rowspan="3">اجمالى بدل الانتقال</th>
      <th rowspan="3">اجمالى ايام التغذية</th>
      <th rowspan="3">اجمالى بدل التغذية</th>
      <th rowspan="3">اجمالى المستحق</th>
      <th rowspan="3">10% ضرائب</th>
      <th rowspan="3">صافي المستحق</th>
  </tr>
</thead>
<tbody>

</tbody>
<tfoot>
  <tr>
    <th id="total">الإجمالي لكل صفحة : </th>
  </tr>
</tfoot>
</table>
@push('adminjs')
{{-- <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script> --}}
<script>
$(document).ready(function () {
  $('#search').on('click',function(e){
  var feeding           = $('#feeding'); 
  var table             = $("#dynamic-table tbody");
  var league_start_date = $('#league_start_date').val();
  var league_end_date   = $('#league_end_date').val();
    e.preventDefault();
    $.ajax({
      url:"{{ route('reports.MiniBasketReport') }}",
      type:"GET",
      data:{
        'league_start_date':league_start_date,
        'league_end_date':league_end_date,
        },
        success:function(response){
          table.empty();
          for (let m = 0; m < response.length; m++){  
          var arr  = [];
          var arr1 = [];
          var arr2 = [];
            arr1.push(`<tr>`)
            arr2.push(`<tr>`)
            for(let n = 0; n < response[0].length; n++)
              {
               arr.push(`<th colspan="2">${response[0][n]}</th>`);
               arr1.push(`<th colspan="2">${response[1][n]}</th>`);
               arr2.push(`<th>عدد الفترات</th><th>قيمة بدل الأنتقال</th>`);
              }
            arr1.push(`</tr>`)
            arr2.push(`</tr>`)
          }
          $(arr.join("")).insertAfter('#feeding');
          $('#head').append(arr1.join(""));
          $('#head').append(arr2.join(""));

          for (let m = 0; m < response[2].length; m++){
              var arr3 = [];
              for(let n = 0; n < response.length; n++)
              {
              if (n>1) {
                if (n == 6) {
                  for (let i = 0; i < response[6].length; i++)
                  {
                      arr3.push('<td>'+response[n][i][m]+'</td>');   
                  }
                }else{
                  arr3.push('<td>'+response[n][m]+'</td>');
                }
                }
              }
                table.append('<tr>'+arr3+'</tr>');
            }


                  $('#dynamic-table').DataTable({
                  dom: 'lBfrtip',
                  bRetrieve:true,
                  "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                            var num_of_column = this.api().columns().count();
                            for (let index = 1; index < num_of_column; index++) 
                            {
                                $('<th rowspan="1" colspan="1"></th>').insertBefore('#total');  
                            }
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\EGP,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                
                            // Total over all pages
                            total = api
                                .column(num_of_column-1)
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                                console.log(total);
                
                            // Total over this page
                            pageTotal = api
                                .column( num_of_column-1, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                                console.log(pageTotal);
                
                            // Update footer
                            // console.log(api.column(num_of_column-2).footer());
                            $( '#total' ).html(
                                pageTotal +' ( الإجمالي لكل صفحة : EGP '+ total +')'
                            );
                        }, 
                  buttons: [
                      { extend: 'print', footer: true,orientation: 'landscape'},
                      { extend: 'excel', footer: true},
                  ]
                  
          });
          
          $('.dt-buttons').css({"left": "5px", "top": "14px"}); 
        }
      });
  });
});
</script>
{{-- <script src="{{url('js/datatable/buttons.js')}}"></script> --}}
@endpush