<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                    </li>
                    @endforeach



                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>

    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
    @endif

    <table class="table caption-top">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer photo')}}</th>
            <th scope="col">{{__('messages.Offer Details')}}</th>
            <th scope="col">{{__('messages.operations')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer-> details}}</td>
                <td><img  style="width: 110px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                    <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-primary">{{__('messages.update')}}</a>
                    <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">{{__('messages.delete')}}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>
