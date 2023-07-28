@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
             <div class="alert alert-success" role="alert" id="alert" style="display: none">
               Offer Added Successfully
             </div>
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add your Offer')}}
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <br>
                <form method="post" action="" enctype="multipart/form-data" id="OfferForm">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" id="name_ar"
                               placeholder="{{__('messages.Offer Name ar')}}">
                        <small class="form-text text-danger" id="name_ar_error"></small>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               placeholder="{{__('messages.Offer Name en')}}">
                        <small class="form-text text-danger" id="name_en_error"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.photo Name')}}</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        <small class="form-text text-danger" id="photo_error"></small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price" id="price"
                               placeholder="{{__('messages.Offer Price')}}">
                        <small class="form-text text-danger" id="price_error"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" id="details_ar"
                               placeholder="{{__('messages.Offer Details ar')}}">
                        <small class="form-text text-danger" id="details_ar_error"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Details en')}}</label>
                        <input type="text" class="form-control" name="details_en" id="details_en"
                               placeholder="{{__('messages.Offer Details en')}}">
                        <small class="form-text text-danger" id="details_en_error"></small>
                    </div>

                    <button id="SaveOffer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(function () {
            $('#SaveOffer').click(function (e) {
                e.preventDefault();
                $('#name_ar_error').text('');
                $('#name_en_error').text('');
                $('#photo_error').text('');
                $('#price_error').text('');
                $('#details_ar_error').text('');
                $('#details_en_error').text('');
                var data=new FormData($('#OfferForm')[0]);
                $.ajax({
                    type: 'post',
                    enctype:"multipart/form-data",
                    url: "{{route('ajax.offers.store')}}",
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
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                });
            });


        });
    </script>
@stop

