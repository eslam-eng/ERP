{{--@section('script')--}}
    {{--@if(session()->has('done'))--}}
        {{--<script>--}}
            {{--toastr.success('{{session('done')}}');--}}
        {{--</script>--}}
    {{--@endif--}}


    {{--@if(session()->has('fail'))--}}
        {{--<script>--}}
            {{--toastr.error('{{session('fail')}}');--}}
        {{--</script>--}}
    {{--@endif--}}

{{--@endsection--}}



{{--@if(session()->has('done'))--}}
{{--<div class="alert alert-success alert-dismissible col-md-8" id="alert">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
    {{--{{session('done')}}--}}
{{--</div>--}}
{{--@endif--}}
{{--Fail if data Already exsist--}}

{{--@if(session()->has('fail'))--}}
{{--<div class="alert alert-danger alert-dismissible col-md-8" id="alert">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
    {{--{{session('fail')}}--}}
{{--</div>--}}
{{--@endif--}}