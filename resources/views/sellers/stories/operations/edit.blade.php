
@extends('sellers.master')
@section('title')

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{asset('css/stories/create.css')}}">

</head>
<body class="create-store">
    @section('content')
    <div class="form-wrapper">
        <div class="form-container">
            <h1>تعديل المتجر  </h1>



            <form action="{{route('seller.store.update',$Store->id)}}" method="POST" enctype="multipart/form-data">
                
            @csrf
                <label for="store-name">اسم المتجر:</label>
                <input type="text" id="store-name"
                 name="name"
                 required
                 value="{{$Store->name}}"
                 class="@error('name') is-invalid @enderror"
                 >

                 @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror 

                <label for="store-description">وصف المتجر:</label>
                <textarea id="store-description"
                 name="description"
                 required
                 
                 >{{$Store->description}}</textarea>

                 

                <button type="submit">تعديل المتجر</button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>