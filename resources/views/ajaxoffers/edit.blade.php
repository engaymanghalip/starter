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

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                {{--                <form method="POST" action="{{url('offers\store')}}">--}}
                <form action="" id="offerFormUpdate"  enctype="multipart/form-data" > {{-- enctype هي التي تسمح برفغ الملفات--}}
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
                        <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.enter name')}}">
                        @error('name_ar')
                        <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                        @enderror
                    </div>
                    {{--       english   language          --}}

                    <input type="text" class="form-control" name="offer_id"
                          ">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}" placeholder="{{__('messages.enter name')}}">
                        @error('name_en')
                        <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                        @enderror
                    </div>
                    {{--                    -------------------                             --}}
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Offer Price</label>
                        <input type="text" class="form-control" name="price" value="{{$offer -> price}}" placeholder="enter price">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}" placeholder="enter detailes">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    {{--          english language          --}}
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details en')}}</label>
                        <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}"  placeholder="enter detailes">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button type="submit" id="update_offer" class="btn btn-primary">Store Offer</button>
                </form>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click','#update_offer',function (e){
            e.preventDefault();

            var url = "{{route('ajax.offers.update')}}" ;

            var formData = new FormData($(#offerFormUpdate)[0]);

            $.ajax({
                url:url,
                method:"POST" ,
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,

                success:function (data){
                    if(data.status == true){
                        $('#success_msg').show();
                    }

                },

                error: function (reject) {
                }
            });
        });

    </script>
@stop
