@extends('external.layout.main')

@section('page-css')
    <link rel="stylesheet" href="{{asset('/external/home/css/home.css').'?v='.config('app.version')}}">
@endsection

@section('header')
    @include('external/layout/header')
@endsection

@section('footer')
    @include('external/layout/footer')
@endsection