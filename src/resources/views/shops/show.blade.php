@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

<h1>{{ $shop->name }}</h1>
<p>ID: {{ $shop->id }}</p>
<p>地域: {{ $shop->region }}</p>
<p>ジャンル: {{ $shop->genre }}</p>
<p>説明: {{ $shop->description }}</p>
<img src="{{ $shop->image_url }}" alt="{{ $shop->name }}の画像">