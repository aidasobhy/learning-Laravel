<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


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

        .error {
            color: #ae1c17;
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
<br>
<caption class="container"><h1 style="text-align: center">خدمات الدكتور</h1></caption>
<table class="table container" >
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($services) && $services->count() >0)
            @foreach($services as $service)
        <tr>
            <th scope="row">{{$service->id}}</th>
            <td>{{$service->name}}</td>
        </tr>
            @endforeach
        @endif
    </tbody>
</table>
<br>
@if(Session::has('success'))
    <div class="container alert alert-success" role="alert">
        {{Session::get('success')}}
    </div>
@endif
<form method="post" action="{{route('save.doctor.service')}}" class="container">
    @csrf
    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
    <div class="form-group">
        <label for="exampleInputEmail1">اختر الطبيب</label>
        <select class="form-control" name="doctor_id">
            @if(isset($doctors) && $doctors->count()>0)
                @foreach($doctors as $doctor)
            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">اختر الخدمات</label>
        <select class="form-control" multiple name="service_id[]">
            @if(isset($allServices) && $allServices->count()>0)
                @foreach($allServices as $allService)
                    <option value="{{$allService->id}}">{{$allService->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <button id="SaveService" class="btn btn-primary">Save</button>
</form>
</body>
</html>
