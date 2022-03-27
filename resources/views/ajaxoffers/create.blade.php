@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none";>
            تم الحذف بنجاح
        </div>

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.add your offer')}}
            </div>

            {{--      *****************************************************************************          --}}
            {{--                @if(Session::has('success'))--}}
            {{--                <div class="alert alert-primary" role="alert">--}}
            {{--                    A simple primary alert—check it out!--}}
            {{--                </div>--}}
            {{--                @endif--}}
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            {{--                <form method="POST" action="{{url('offers\store')}}">--}}
            <form action="" id="offerForm"  enctype="multipart/form-data" > {{-- enctype هي التي تسمح برفغ الملفات--}}
                @csrf
                {{--                    <input name="_token" value="{{csrf_token()}}">--}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">اختر صورة للعرض</label>
                    <input type="file" id="file" class="form-control" name="photo">
                    <small id="photo_error" class="form-text text-danger"></small>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.enter name')}}">
                    <small id="name_ar_error" class="form-text text-danger"></small>
                </div>
                {{--       english   language          --}}

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.enter name')}}">
                    <small id="name_en_error" class="form-text text-danger"></small>
                </div>
                {{--                    -------------------                             --}}
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer Price</label>
                    <input type="text" class="form-control" name="price" placeholder="enter price">
                    <small id="price_error" class="form-text text-danger"></small>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" placeholder="enter detailes">
                    <small id="details_ar_error" class="form-text text-danger"></small>
                </div>
                {{--          english language          --}}
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details en')}}</label>
                    <input type="text" class="form-control" name="details_en" placeholder="enter detailes">
                    <small id="details_en _error" class="form-text text-danger"></small>
                </div>

                <button type="submit" class="btn btn-primary">Store Offer</button>
            </form>

        </div>
    </div>
    </div>
@stop

@section('scripts')
    <script>
        $("body").on('submit',function (e){
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');

            var url = "{{route('ajax.offers.store')}}" ;
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                url:url,
                method:"POST" ,
                enctype : 'multipart/form-data',
                data: formData,
                processData : false,
                contentType : false,
                cache:false,
                success:function (data){
                    if(data.status == true){
                        alert(data.msg)
                    }
                },error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val){
                        $("#" + key + "_error").text(val[0]);


                    });
                }
            });
        });

    </script>
@stop
