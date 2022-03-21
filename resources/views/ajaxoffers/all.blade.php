@extends('layouts.app')

@section('content')


    <div class="alert alert-success" id="success_msg" style="display: none";>
        تم الحذف بنجاح
    </div>

<table class="table caption-top">
    <caption>List of users</caption>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('messages.Offer Name')}}</th>
        <th scope="col">{{__('messages.Offer Price')}}</th>
        <th scope="col">{{__('messages.Offer Details')}}</th>
        <th scope="col">{{__('messages.operations')}}</th>

    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr class="offerRow{{$offer -> id}}">
            <th scope="row">{{$offer -> id}}</th>
            <td>{{$offer -> name}}</td>
            <td>{{$offer -> price}}</td>
            <td>{{$offer-> details}}</td>
            <td><img  style="width: 110px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
            <td>
                <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-primary">{{__('messages.update')}}</a>
                <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">{{__('messages.delete')}}</a>

                <a href="" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger">{{__('messages.delete ajax  ')}}</a>
                <a href="{{route('ajax.offers.edit',$offer -> id)}}" class="delete_btn btn btn-danger">{{__('messages.edit ajax  ')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>




</table>
@stop

@section('scripts')
    <script>
        $(document).on('click','#update_offer',function (e){
            e.preventDefault();

            var url = "{{route('ajax.offers.delete')}}" ;
            var offer_id = $(this).attr('offer_id');

            $.ajax({
                url:url,
                method:"POST" ,
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id
                },

                success:function (data){
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                },

                error: function (reject) {
                }
            });
        });

    </script>
@stop
