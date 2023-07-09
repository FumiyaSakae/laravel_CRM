@extends('front.layouts.master')

@section('title')
    トップページ
@endsection

@include('front.partials.header')

@section('description')
    <meta name="description" content="トップページのdescriptionです">
@endsection

@section('mainTitle', 'トップページです。')
@section('subTitle', '一覧ページ')
@section('content')
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @endguest

    <ul>
        <li>
            <a href="http://localhost/users" class="nav_link">
                ユーザー
            </a>
        </li>
        <li>
            <a href="http://localhost/books" class="nav_link">
                著書
            </a>
        </li>
    </ul>
@endsection

@include('front.partials.footer')
