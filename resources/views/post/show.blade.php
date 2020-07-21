@extends('layouts.base', ['header' => false])

@section('content')
    <x-single-post :post="$post"></x-single-post>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection
