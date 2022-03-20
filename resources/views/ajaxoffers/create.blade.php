@extends('layouts.app')

@section('content')
    <div class="container">
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
            <form action="" enctype="multipart/form-data" > {{-- enctype هي التي تسمح برفغ الملفات--}}
                @csrf
                {{--                    <input name="_token" value="{{csrf_token()}}">--}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">اختر صورة للعرض</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.enter name')}}">
                    @error('name_ar')
                    <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                    @enderror
                </div>
                {{--       english   language          --}}

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.enter name')}}">
                    @error('name_en')
                    <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                    @enderror
                </div>
                {{--                    -------------------                             --}}
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer Price</label>
                    <input type="text" class="form-control" name="price" placeholder="enter price">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" placeholder="enter detailes">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                {{--          english language          --}}
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details en')}}</label>
                    <input type="text" class="form-control" name="details_en" placeholder="enter detailes">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Store Offer</button>
            </form>

        </div>
    </div>
    </div>
@stop

@section('scripts')
{{--    <script>--}}
{{--        $('body').on('submit','#save_offer',function (e){--}}
{{--            e.preventDefault();--}}
{{--            $.ajax({--}}
{{--                method: 'post',--}}
{{--                url: "{{route('ajax.offers.store')}}",--}}
{{--                data: {},--}}
{{--                success: function (data) {--}}
{{--                }, error: function (reject) {--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
{{--######################################################--}}
    <script>
        $("body").on('submit',function (e){
            e.preventDefault();

            var url = "{{route('ajax.offers.store')}}" ;
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                url:url,
                method:"POST" ,
                enctype : 'multipart/form-data',
                data:{
                '_token' : "{{csrf_token()}}",
                    'name_ar':$("input[name='name_ar']").val(),
                'name_en':$("input[name='name_en']").val(),
                'price':$("input[name='price']").val(),
                'details_ar':$("input[name='details_ar']").val(),
                'details_en':$("input[name='details_ar']").val(),
                processData : false,
                contentType : false,
                cache:false},
                success:function (data){
                },error: function (reject) {
                }
            });
        });

    </script>
@stop
