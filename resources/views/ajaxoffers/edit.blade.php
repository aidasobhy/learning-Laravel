@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
             <div class="alert alert-success" role="alert" id="alert" style="display: none">
               Offer Updated Successfully
             </div>
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add your Offer')}}
                </div>
                <br>
                <form method="post" action="" enctype="multipart/form-data" id="OfferFormUpdate">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    <input type="hidden" class="form-control" name="id" id="id"
                           value="{{$offer->id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" id="name_ar"
                               value="{{$offer->name_ar}}"
                               placeholder="{{__('messages.Offer Name ar')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{$offer->name_en}}"
                               placeholder="{{__('messages.Offer Name en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.photo Name')}}</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        <img src="{{asset('images/offers/'.$offer->photo)}}">
                        @error('photo')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price" id="price"
                               value="{{$offer->price}}"
                               placeholder="{{__('messages.Offer Price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" id="details_ar"
                               value="{{$offer->details_ar}}"
                               placeholder="{{__('messages.Offer Details ar')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details en')}}</label>
                        <input type="text" class="form-control" name="details_en" id="details_en"
                               value="{{$offer->details_en}}"
                               placeholder="{{__('messages.Offer Details en')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button id="UpdateOffer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(function () {
            $('#UpdateOffer').click(function (e) {
                e.preventDefault();
                var data=new FormData($('#OfferFormUpdate')[0]);
                $.ajax({
                    type: 'post',
                    enctype:"multipart/form-data",
                    url: "{{route('ajax.offers.update')}}",
                    data:data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (data) {
                         if(data.status==true){
                             $('#alert').show();
                         }
                    },
                    error: function (reject) {

                    }
                });
            });


        });
    </script>
@stop

