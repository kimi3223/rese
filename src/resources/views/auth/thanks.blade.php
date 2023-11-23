@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">会員登録ありがとうございます</div>

                    <div class="card-body">
                        <a href="{{ route('login') }}">ログインする</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
