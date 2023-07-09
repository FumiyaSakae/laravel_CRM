@extends('front.layouts.master')

@section('title')
    トップページ
@endsection

@include('front.partials.header')

@section('description')
    <meta name="description" content="マイページのdescriptionです">
@endsection

@section('mainTitle', 'マイページです。')
@section('subTitle', '情報一覧')
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
    @else
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        </li>
    @endguest

    </ul>
@endsection

@include('front.partials.footer')
