@extends('layouts.app')
@section('content')
    <div class="alert alert-success" role="alert"  id="alert_msg"  style="display:none;">
        Offer Deleted Successfully
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.photo')}}</th>
            <th scope="col">{{__('messages.Offer Details')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offerRow{{$offer -> id}}">
                <th scope="row">{{$offer['id']}}</th>
                <td>{{$offer['name']}}</td>
                <td>{{$offer['price']}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>{{$offer['details']}}</td>
                <td>
                    <a href="" class="delete_btn btn btn-danger" offer_id="{{$offer->id}}">Ajax Delete</a>
                    <a href="{{route('ajax.offer.edit',$offer->id)}}" class="btn btn-success">Ajax Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('scripts')
    <script>
        $(function () {
            $('.delete_btn').click(function (e) {
                e.preventDefault();
               var offer_id= $(this).attr('offer_id');
                $.ajax({
                    type: 'post',
                    url: "{{route('ajax.offers.delete')}}",
                    data:{
                        '_token':"{{csrf_token()}}",
                         'id':offer_id,
                    },
                    success: function (data) {
                        if(data.status==true){
                         $('#alert_msg').show();
                        }
                        $('.offerRow'+data.id).remove();
                    },
                    error: function (reject) {

                    }
                });
            });


        });
    </script>
@stop
