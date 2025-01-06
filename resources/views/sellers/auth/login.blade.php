<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sellers/auth/register.css') }}">

</head>
<body>
<div class="form-container">
        <h2> سجل دخول كبائع </h2>
        <form action="{{route('auth.seller.login.submit')}}" method="POST">

        @csrf
          

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" 
                name="email" 
                placeholder="example@email.com"  
                class="@error('title') is-invalid @enderror"
                required>
            </div>

            @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror


            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password"
                 name="password" 
                 placeholder="أدخل كلمة المرور"
                 class="@error('title') is-invalid @enderror"
                 required>
            </div>

            @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

            <div class="form-group">
                <button type="submit">انشاء الحساب </button>
            </div>


        </form>
    </div>
</body>
</html>