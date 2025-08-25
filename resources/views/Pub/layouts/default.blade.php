@extends('Pub::layouts.site')

@section('header')
    @include('Pub::layouts.header')
@endsection

@section('content')
       {!! $content !!}
@endsection

@section('footer')
    @include('Pub::layouts.footer')
@endsection
