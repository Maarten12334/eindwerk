@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')
@php
//dd($images);
@endphp
<img src={{ $images->getContent() }} alt="">
@endsection