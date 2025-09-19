@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thông tin cá nhân giảng viên</h2>
    <table class="table">
        <tr>
            <th>Họ tên</th>
            <td>{{ $teacher->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $teacher->email }}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{ $teacher->phone }}</td>
        </tr>
        <tr>
            <th>Khoa</th>
            <td>{{ $teacher->department->name ?? '' }}</td>
        </tr>
    </table>
</div>
@endsection
