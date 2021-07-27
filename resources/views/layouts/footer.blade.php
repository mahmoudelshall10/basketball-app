<footer class="site-footer">
          <div class="text-center">
            {{date('Y')}} &copy; <a href="#" target="_blank" style="color: #fff;">Hash Code.</a>
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
     <!--footer end-->
    </section>




    <script src="{{url('js')}}/bootstrap.bundle.min.js"></script>
    <script class="include" type="text/javascript" src="{{url('js')}}/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{url('js')}}/jquery.scrollTo.min.js"></script>
    <script src="{{url('js')}}/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{url('js')}}/jquery.sparkline.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="{{url('js')}}/owl.carousel.js" ></script>
    <script src="{{url('js')}}/jquery.customSelect.min.js" ></script>
    <script src="{{url('js')}}/respond.min.js" ></script>
    <script src="{{url('js')}}/firebase.js"></script>
    <!--right slidebar-->
    <script src="{{url('js')}}/slidebars.min.js"></script>

    <script src="{{url('js')}}/form-component.js"></script>
    <!--common script for all pages-->
    <script src="{{url('js')}}/common-scripts.js"></script>
    <!--script for this page-->
    <script src="{{url('js')}}/sparkline-chart.js"></script>
    <script src="{{url('js')}}/easy-pie-chart.js"></script>
    <script src="{{url('js')}}/count.js"></script>
     <script class="include" type="text/javascript" src="{{url('js')}}/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{url('js')}}/jquery.scrollTo.min.js"></script>
    <script src="{{url('js')}}/jquery.nicescroll.js" type="text/javascript"></script>
     <script type="text/javascript" language="javascript" src="{{url('assets')}}/advanced-datatable/media/js/jquery.dataTables.js"></script>
 <script type="text/javascript" src="{{url('assets')}}/data-tables/DT_bootstrap.js"></script>
  
 @if (Request::segment(1) == 'live-search' || Request::segment(1) == 'decline-search')
 {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
 @else
   <script src="{{url('js')}}/dynamic_table_init.js"></script>
 @endif



    <script type="text/javascript" src="{{url('js')}}/jquery.validate.min.js"></script>
    <script src="{{url('js')}}/gritter.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{url('assets')}}/bootstrap-fileupload/bootstrap-fileupload.js"></script>
 
    <script src="{{url('assets')}}/fancybox/source/jquery.fancybox.js"></script>
     <script src="{{url('js')}}/modernizr.custom.js"></script>
    <script src="{{url('js')}}/toucheffects.js"></script>


  <script type="text/javascript" src="{{url('assets')}}/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="{{url('assets')}}/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script src="{{url('js')}}/pickers/init-date-picker.js"></script>
  <script src="{{url('js')}}/pickers/init-datetime-picker.js"></script>
  <script type="text/javascript" src="{{url('assets')}}/ckeditor/ckeditor.js"></script>

  <script src="{{url('assets')}}/jquery-knob/js/jquery.knob.js"></script>
  <script type="text/javascript" src="{{url('assets')}}/select2/js/select2.min.js"></script>
  
    <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>
    
      <script type="text/javascript">
     $(document).ready(function(){
    $('#question_type').change(function(){
            
      if($(this).val() !== '')
      {
        var value     = $(this).val();
          
           var url ="{{route('getView')}}";
             
        $.ajax({
          url:"{{route('getView')}}",
          method:"GET",
          data:{value:value},
          success:function(result){
            
            $('#1').html(result);
          }
        });
       
      }
    });
 });
</script>
    
  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              autoPlay:true

          });
      });

    
  </script>
  <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>
 
<script>

      //knob
      $(".knob").knob();

  </script>
<script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
    <script type="text/javascript">

      $(document).ready(function () {

          $(".js-example-basic-multiple").select2();
      });
  </script>

 

  {{-- <script type="text/javascript">
    $(document).ready(function () {
      $('#dynamic-table').DataTable({
                  dom: 'lBfrtip',
                  bRetrieve:true,
                  buttons: [
                      { extend: 'print', footer: true},
                  ],
              });
    });
  </script>    --}}
  <script type="text/javascript">
    $(document).ready(function () {
    $('.dt-buttons').css({"left": "5px", "top": "14px"});
    });
  </script>
  @stack('adminjs')
  </body>
</html>
