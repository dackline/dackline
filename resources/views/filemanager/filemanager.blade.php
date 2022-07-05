@extends('layouts/contentLayoutMaster')

@section('title', __('File Manager'))

@section('content')
<iframe src="/laravel-filemanager" style="width: 100%; height: 100vh; overflow: hidden; border: none;"></iframe>
@endsection
