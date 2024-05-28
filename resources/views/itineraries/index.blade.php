@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')
<div class="container mx-auto p-4 px-8"> <!-- Added px-8 for side margins -->
    @if(isset($itineraries))
</div>
@endsection