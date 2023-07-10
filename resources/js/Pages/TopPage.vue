<!-- @extends('front.layouts.master')

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

@include('front.partials.footer') -->

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const newTitle = ref('');
const newContent = ref('');
</script>

<template>
  トップページのテストです。<br>
  <a href="/">aタグ経由です</a><br>
  <Link href="/">
  Linkタグ経由です。
  </Link><br>
  <Link :href="route('topPage.index')">
  名前付きルートです。
  </Link><br>
  <Link :href="route('topPage.show', { id: 50 })">
  ルート付きパラメーターです。
  </Link>

  <div class="mb-8"></div>
  <input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
  <input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
  <Link as="button" method="post" :href="route('topPage.store')" :data="{
    title: newTitle,
    content: newContent
  }">
  DB保存テスト
  </Link>
</template>