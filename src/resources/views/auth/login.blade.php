@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-nZXQr84+dP0q5CEV8/jLb6sw54ufmM4hvMmYwWLAg0GO9W38UZJZEl82W7L3dNThGdEWKuAe+oX4vDdPYsGrFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<fieldset>
<div class="login__content">
  <div class="login-form__heading">
    <h2>Login</h2>
  </div>
  <form class="form" action="/login" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">Email</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">Password</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password" placeholder="Password" required  />
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
</fieldset>
</div>
@endsection