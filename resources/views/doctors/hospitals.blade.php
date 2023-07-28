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
   @if(Session::has('success'))
  <div class="container alert alert-success" role="alert">
      {{Session::get('success')}}
  </div>
   @endif

@if(Session::has('error'))
    <div class="container alert alert-danger" role="alert">
        {{Session::get('error')}}
    </div>
@endif
<caption class="container"><h1 style="text-align: center">المستشفيات</h1></caption>
<table class="table container" >
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Operations</th>

    </tr>
    </thead>
    <tbody>
        @if(isset($hospitals) && $hospitals->count() >0)
            @foreach($hospitals as $hospital)
        <tr>
            <th scope="row">{{$hospital->id}}</th>
            <td>{{$hospital->name}}</td>
            <td>{{$hospital->address}}</td>
            <td>
                <a href="{{route('doctors.hospitals',$hospital->id)}}" class="btn btn-primary">عرض الاطباء</a>
                <a href="{{route('hospitals.delete',$hospital->id)}}" class="btn btn-danger">حذف</a>
            </td>
        </tr>
            @endforeach
        @endif
    </tbody>
</table>

</body>
</html>
