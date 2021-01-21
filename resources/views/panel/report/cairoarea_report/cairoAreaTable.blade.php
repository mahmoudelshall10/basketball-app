<table class="display table table-bordered table-striped" id="dynamic-table" style="direction: rtl;width:100%">
<thead>
<tr>
  <th>الاسم</th>
  <th>الكود البنكي</th>
  <th>الدرجة</th>
  <th>عدد المباريات | ملعب</th>
  <th>عدد المباريات | طاولة</th>
  <th>بدلات التحكيم | ملعب</th>
  <th>بدلات التحكيم | طاولة</th>
  <th>الإجمالى</th>
  <th>بدلات الانتقال |عدد</th>
  <th>بدلات الانتقال |فئة أ</th>
  <th>بدلات الانتقال |عدد</th>
  <th>بدلات الانتقال |فئة ب</th>
  <th>اجمالى المستحق</th>
  <th>10% ضرائب</th>
  <th>صافي المستحق</th>
</tr>
</thead>

<tbody>
</tbody>
<tfoot>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>الإجمالي لكل صفحة : </th>
  </tr>
</tfoot>
</table>
@push('adminjs')

<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#dynamic-table tbody");
        $('#league_id').on('change',function() {
            var league_id     = $('#league_id').val(); 
            $.ajax({
                url:"{{ route('reports.CairoAreaReport') }}",
                type:"GET",
                data:{'league_id':league_id},
                success:function (data) {
                  table.empty();
                //   console.log(data);
                  for (let m = 0; m < data[0].length; m++)
                  {     
                   var arr = [];
                    for(let n = 0; n < data.length; n++)
                    {
                      arr.push('<td>'+data[n][m]+'</td>');
                    }
                      table.append('<tr>'+arr+'</tr>');
                    }

                  $('#dynamic-table').DataTable({
                            dom: 'lBfrtip',
                            bRetrieve:true,
                            buttons: [
                                { extend: 'print', footer: true},
                                { extend: 'excel', footer: true},
                            ],
                            "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\EGP,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                
                            // Total over all pages
                            total = api
                                .column( 14 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Total over this page
                            pageTotal = api
                                .column( 14, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Update footer
                            console.log(api.column( 14 ).footer());
                            $( api.column( 14 ).footer() ).html(
                                pageTotal +' ( الإجمالي لكل صفحة : EGP '+ total +')'
                            );
                        }
                    });
                    
                    $('.dt-buttons').css({"left": "5px", "top": "14px"});
                }

                
            });
                
            // end of ajax call
        });

    });
</script>
@endpush
