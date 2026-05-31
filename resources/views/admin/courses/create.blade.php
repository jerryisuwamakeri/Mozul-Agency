@extends('layouts.admin')
@section('title', 'New Course')

@section('admin-content')
@include('admin.courses._form', ['course' => null, 'action' => route('admin.courses.store'), 'method' => 'POST'])
@endsection
