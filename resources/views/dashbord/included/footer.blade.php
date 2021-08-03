<footer class="main-footer">
    <strong>Copyright &copy; 2020-2019 <a href="https://www.facebook.com/eslam.elbadry.961">Eslam Elbadry</a>.</strong> All rights
    reserved.
</footer>
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('dashbord/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('dashbord/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->

<script src="{{asset('dashbord/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
@if(session('lang')=='ar')
    <script src="{{asset('dashbord/bower_components/datatables.net/js/jquery.dataTables_ar.min.js')}}"></script>
@else
    <script src="{{asset('dashbord/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
@endif
<script src="{{asset('dashbord/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dashbord/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('dashbord/dist/js/sweetalert.min.js')}}"></script>
<script src="{{asset('dashbord/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script src="{{asset('dashbord/dist/js/Chart.min.js')}}"></script>

<!-- Date and Time Picker -->
<!-- bootstrap datepicker -->
<script src="{{asset('dashbord/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('dashbord/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>


<script src="{{asset('dashbord/dist/js/printThis.js')}}"></script>
<script src="{{asset('dashbord/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dashbord/dist/js/toast.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
    $(function () {
        $('#example').DataTable({
            responsive: true
        });

        $('.select2').select2({
            width:'100%'
        });

        //datepicker
        //.datepicker('setDate','now')
        //Timepicker
        $('.timepicker').timepicker({
            minuteStep:1,
            rtl: true
        });
        $(".alert").fadeOut(6000);


        $(".print").click(function () {
            $('.printthis').printThis({
                importCSS: true,
                debug: false,
                // header: $('.hidden-print-header-content'),
                // footer: $('.hidden-print-header-content')
            });
        });
    });
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    };


    $('.dataTable').DataTable({
        responsive:true,
        scrollX:true,
        scroller:true,

    });
</script>

@if(session()->has('done'))
   <script>
       toastr.success('{{session('done')}}');
   </script>
   <audio autoplay>
       <source src="{{asset('upload/notysound.mp3')}}" type="audio/mpeg">
   </audio>
    {{session()->forget(['done','fail'])}}
@endif

@if(session()->has('fail'))
    <script>
        toastr.error('{{session('fail')}}');
    </script>
    <audio autoplay>
        <source src="{{asset('upload/notysound.mp3')}}" type="audio/mpeg">
    </audio>
    {{session()->forget(['done','fail'])}}
@endif
@yield('script')

<!-- Morris.js charts -->
{{--<script src="{{asset('dashbord/bower_components/raphael/raphael.min.js')}}"></script>--}}
{{--<script src="{{asset('dashbord/bower_components/morris.js/morris.min.js')}}"></script>--}}
<!-- Sparkline -->
{{--<script src="{{asset('dashbord/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>--}}

{{--script from other pages--}}


{{--<!-- jvectormap -->--}}
{{--<script src="{{asset('dashbord/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>--}}
{{--<script src="{{asset('dashbord/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>--}}
{{--<!-- jQuery Knob Chart -->--}}
{{--<script src="{{asset('dashbord/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>--}}
<!-- daterangepicker -->
{{--<script src="{{asset('dashbord/bower_components/moment/min/moment.min.js')}}"></script>--}}
{{--<script src="{{asset('dashbord/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>--}}
{{--<!-- datepicker -->--}}
{{--<script src="{{asset('dashbord/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
<!-- Bootstrap WYSIHTML5 -->
{{--<script src="{{asset('dashbord/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>--}}

<!-- DataTables -->

<!-- Slimscroll -->
{{--<script src="{{asset('dashbord/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>--}}
<!-- FastClick -->
{{--<script src="{{asset('dashbord/bower_components/fastclick/lib/fastclick.js')}}"></script>--}}
</body>
</html>
