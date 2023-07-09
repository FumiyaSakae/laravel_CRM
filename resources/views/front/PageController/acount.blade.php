@extends('front.layouts.master')

@section('title')
    トップページ
@endsection

@include('front.partials.header')

@section('description')
    <meta name="description" content="アカウントページのdescriptionです">
@endsection

@section('mainTitle', 'アカウントページです。')
@section('subTitle', '機能一覧')
@section('content')
    @guest
    @else
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">新規登録</a>
                @endauth
            </div>
        @endif


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
