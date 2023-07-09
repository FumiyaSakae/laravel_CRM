@section('header')
    <header>
        <div class="header">
            <div class="logo">
                <img class="logo_img" src="{{ asset('logo.png') }}" alt="ロゴ">
            </div>
            <nav>
                <ul class="header-nav">
                    <li class="nav_list">
                        <a href="{{ route('home') }}" class="header_nav_link">
                            ホーム
                        </a>
                    </li>
                    <li class="nav_list">
                        <a href="{{ route('myPage') }}" class="header_nav_link">
                            マイページ
                        </a>
                    </li>
                    <li class="nav_list">
                        <a href="{{ route('acount') }}" class="header_nav_link">
                            アカウント
                        </a>
                    </li>
                    <li class="nav_list">
                        <a href="#" class="header_nav_link">
                            設定
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>
@endsection
