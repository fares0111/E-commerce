@extends('sellers.master')
@section('title')
@section('content')

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>إدارة المتاجر</title>
  <style>
    /* الحاوية الرئيسية */
    .container {
      width: 90%;
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    /* تنسيق الجدول */
    .store-table {
      width: 100%;
      border-collapse: collapse;
      background-color: #f9f9f9;
    }

    .store-table thead {
      background-color: #007bff;
      color: #fff;
    }

    .store-table th,
    .store-table td {
      text-align: center;
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    .store-table th {
      font-weight: bold;
    }

    .store-table tbody tr:hover {
      background-color: #f1f1f1;
    }

    /* الأيقونة */
    .store-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* الأزرار */
    .btn {
      padding: 8px 12px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-edit {
      background-color: #28a745;
      color: #fff;
    }

    .btn-edit:hover {
      background-color: #218838;
    }

    .btn-delete {
      background-color: #dc3545;
      color: #fff;
    }

    .btn-delete:hover {
      background-color: #c82333;
    }

    .btn-view {
      background-color: #17a2b8;
      color: #fff;
    }

    .btn-view:hover {
      background-color: #138496;
    }
  </style>
</head>
<body>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container">
    <table class="store-table">
      <thead>
        <tr>
          <th>الأيقونة</th>
          <th>اسم المتجر</th>
          <th>الوصف</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($Stories as $Store)
        <tr>
<td>
<img src="{{ asset('storage/'.$Store->images->first()->path)}}" alt="store_icon" class="store-icon">
</td>
          <td>{{ $Store->name }}</td>
          <td>{{ $Store->description }}</td>
          <td>
          <a href="{{route('seller.store.edit',$Store->id)}}"><button class="btn btn-edit">تعديل</button></a> 
          <a href="{{route('seller.store.delete',$Store->id)}}"><button class="btn btn-delete">حذف</button></a>  
            <button class="btn btn-view">دخول</button>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</body>
</html>

@endsection
