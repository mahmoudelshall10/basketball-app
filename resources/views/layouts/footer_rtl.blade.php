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

<!-- js placed at the end of the document so the pages load faster -->

<script src="{{url('design_rtl')}}/js/jquery.js"></script>
<script src="{{url('design_rtl')}}/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="{{url('design_rtl')}}/js/jquery-migrate-1.2.1.min.js"></script>
<script src="{{url('design_rtl')}}/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="{{url('design_rtl')}}/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('design_rtl')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{url('design_rtl')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="{{url('design_rtl')}}/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{url('design_rtl')}}/assets/data-tables/DT_bootstrap.js"></script>
<script src="{{url('design_rtl')}}/js/respond.min.js" ></script>
<!--right slidebar-->
<script src="{{url('design_rtl')}}/js/slidebars.min.js"></script>

@if(Request::segment(2) == 'mini-basket-report')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endif 

<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>    



<!--common script for all pages-->
<script src="{{url('design_rtl')}}/js/common-scripts.js"></script>

  @stack('adminjs')
</body>
</html>
