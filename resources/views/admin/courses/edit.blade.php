@extends('layouts.admin')
@section('title', 'Edit Course')

@section('admin-content')
@include('admin.courses._form', ['action' => route('admin.courses.update', $course), 'method' => 'PUT'])
@endsection
