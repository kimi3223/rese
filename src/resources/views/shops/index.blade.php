@extends('layouts.app')

@section('content')
    <div>

        <ul>
            @foreach($shops as $shop)
                <li>{{ $shop->name }} - {{ $shop->region }} - {{ $shop->genre }}</li>
                <!-- 適切なデータベースのカラムを表示 -->
            @endforeach
        </ul>

    </div>
@endsection