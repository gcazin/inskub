@extends('layouts.base')

@isset($head)
@section('head')
    {{ $head }}
@endsection
@endisset

@isset($title)
@section('title')
    {{ $title }}
@endsection
@endisset

@section('content')
    {{ $slot }}
@endsection

@isset($script)
@section('script')
    {{ $script }}
@endsection
@endisset
