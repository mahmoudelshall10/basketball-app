@include('layouts.header_rtl')
<!--header end-->
<!--sidebar start-->
@include('layouts.sidebar') 
<!--main content start-->

<section id="main-content">
    <section class="wrapper">
        @yield('content')
    </section>
</section>

<!--main content end-->
<!--footer start-->
@include('layouts.footer_rtl')