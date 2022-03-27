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
                    الخدمات
                </div>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>



                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        @if(isset($services) && $services -> count() > 0)
                            @foreach($services as $service)
                                <th scope="row">{{$service -> id}}</th>
                                <td>{{$service -> name}}</td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

                <br><br>

                <form method="POST" action="{{route('save.doctors.services')}}"   > {{-- enctype هي التي تسمح برفغ الملفات--}}
                    @csrf
                    {{--                    <input name="_token" value="{{csrf_token()}}">--}}


                    <div class="mb-3">
                        <label for="exampleInputEmail1">اختر طبيب</label>
{{--                        <input type="text" class="form-control" name="name_ar" placeholder="اختر طبيب">--}}
                       <select class="form-control" name="doctor_id">
                          @foreach($doctors as $doctor)
                           <option value="{{$doctor -> id}}">
                               {{$doctor -> name}}
                           </option>
                           @endforeach
                       </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">اختر الخدمات</label>
{{--                        <input type="text" class="form-control" name="name_ar" placeholder="اختر الخدمات">--}}
                        <select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allservices as $allservice)
                                <option value="{{$allservice -> id}}">
                                    {{$allservice -> name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Store Offer</button>
                </form>
            </div>
        </div>
    </div>
@stop


