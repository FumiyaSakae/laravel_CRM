<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="expires" content="604800">
  <meta name="format-detection" content="email=no,telephone=no,address=no">
  <title>@yield('title') | Laravel</title>
  @yield('description')
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>

<body>
  @yield('header')
  <div id="container">
    <main>
      <div class="main">
        @hasSection('mainTitle')
        <h1 class="page-name">@yield('mainTitle')</h1>
        @else
        <h1>メインタイトル未設定</h1>
        @endif
        <div class="contentsWrap">
          <h2>@yield('subTitle')</h2>
          @yield('content')
        </div>
      </div>
    </main>
  </div>
  @yield('footer')
</body>

</html>