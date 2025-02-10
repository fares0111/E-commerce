
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
            <h1>إنشاء متجر جديد</h1>



            <form action="{{route('seller.store.create.submit')}}" method="POST" enctype="multipart/form-data">
                
            @csrf
                <label for="store-name">اسم المتجر:</label>
                <input type="text" id="store-name"
                 name="name"
                 placeholder="ادخل اسم المتجر"
                 required
                 class="@error('name') is-invalid @enderror"
                 >

                 @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror 

                <label for="store-description">وصف المتجر:</label>
                <textarea id="store-description" name="description" placeholder="ادخل وصفاً للمتجر" required></textarea>

                <label for="image"> صورة البروفايل </label>
                <input type="file" id="image"
                 name="images[]"
                 placeholder="أعد إدخال كلمة المرور" 
                 class="@error('images') is-invalid @enderror"
                 multiple>
                 
                 @if ($errors->has('images.*'))
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif    
                <button type="submit">إنشاء المتجر</button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>