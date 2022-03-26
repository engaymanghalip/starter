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
                    الاطباء
                </div>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">title</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        @if(isset($doctors) && $doctors -> count() > 0)
                            @foreach($doctors as $doctor)
                        <th scope="row">{{$doctor -> id}}</th>
                        <td>{{$doctor -> name}}</td>
                        <td>{{$doctor -> title}}</td>
                    </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


