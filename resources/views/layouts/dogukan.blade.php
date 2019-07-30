<!doctype html>
<html lang="tr">
<head>
    <!--
        .___                   __                          __
      __| _/____   ____  __ __|  | _______    ____   ____ |  | __  ________ __________
     / __ |/  _ \ / ___\|  |  \  |/ /\__  \  /    \ /  _ \|  |/ / /  ___/  |  \___   /
    / /_/ (  <_> ) /_/  >  |  /    <  / __ \|   |  (  <_> )    <  \___ \|  |  //    /
    \____ |\____/\___  /|____/|__|_ \(____  /___|  /\____/|__|_ \/____  >____//_____ \
         \/     /_____/            \/     \/     \/            \/     \/            \/

                                 by dogukanoksuz
                                  dogukan.dev
                       github.com/dogukanoksuz/laravel-blog-5.8
     -->
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>@yield('pageTitle', config('setting.Title'))</title>
    <meta name="description" content="@yield('pageDesc', config('setting.Description'))">
    <meta name="keywords" content="@yield('pageKeyword', config('setting.Keywords'))">
    <meta content="{{ App\User::find(1)->name }}" name="author">
    <meta name="description" content="@yield('pageDesc', config('setting.Description'))">
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="@yield('pageTitle', config('setting.Title'))"/>
    <link rel="canonical" href="{{ Request::url() }}">
    <meta name="twitter:description" property="og:description"
          content="@yield('pageDesc', config('setting.Description'))"/>
    <meta name="apple-mobile-web-app-title" content="{{ config('setting.Title') }}">
    <meta name="application-name" content="{{ config('setting.Title') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dist/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('dist/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('dist/favicon/safari-pinned-tab.svg') }}" color="#f44">
    <link rel="shortcut icon" href="{{ asset('dist/favicon/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#ff4444">
    <meta name="msapplication-config" content="{{ asset('dist/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144190555-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-144190555-1');
    </script>
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/featherlight.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    @if(Auth::guest())
        <script src='https://www.google.com/recaptcha/api.js' type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css"
              rel="stylesheet">
    @endif
</head>
<body>
<header id="Header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="brand">
                    <a href="{{route('index')}}">
                        <div class="logo">

                        </div>
                    </a>
                </section>
                <nav class="headerNav">
                    <ul>
                        <li><a href="{{ route('index') }}"><i class="fas fa-home"></i></a></li>
                        @foreach( App\Admin\Page::all() as $page )
                            <li class="d-lg-block d-none"><a
                                    href="{{ route('pages', $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach
                        @if(Auth::guest())
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a></li>
                        @else
                            <li class="d-md-block">
                                <a href="{{ route('admin') }}">Yönetim</a>
                            </li>
                            <li class="d-md-block">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('do-logout').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </li>
                            <form id="do-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf

                            </form>
                        @endif
                        <li class="mobile-menu d-lg-none d-md-block"><a href="#"><i class="fas fa-ellipsis-h"></i></a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="drawer">
        <div class="drawerHeader clearfix">
            <a href="{{ route('index') }}" class="drawerHeader__logo">
                <div class="logo" style="float:left;">

                </div>
            </a>
            <div class="drawerClose"><i class="fas fa-chevron-left"></i></div>
        </div>
        <ul class="drawerMenu">
            <li><a href="{{ route('index') }}"><i class="fas fa-home"></i> Ana Sayfa</a></li>
            @foreach( App\Admin\Page::all() as $page )
                <li><a
                        href="{{ route('pages', $page->slug) }}">{{ $page->title }}</a></li>
            @endforeach
            <br>
            @foreach( App\Admin\Category::all() as $category )
                <li><a
                        href="{{ route('category', $category->slug) }}">{{ $category->title }}</a></li>
            @endforeach
        </ul>
    </div>

</header>

@yield('content')

<footer id="Footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                Copyright &copy; 2019 <b>Doğukan Öksüz</b>
            </div>
            <div class="col-sm-4 text-center" style="font-size: 20px">
                <a href="{{ App\Helper\TemplateHelper::fetchSocialLink('facebook') }}"><i class="fab fa-facebook-f"></i></a>&nbsp;
                <a href="{{ App\Helper\TemplateHelper::fetchSocialLink('twitter') }}"><i class="fab fa-twitter"></i></a>&nbsp;
                <a href="{{ App\Helper\TemplateHelper::fetchSocialLink('instagram') }}"><i class="fab fa-instagram"></i></a>&nbsp;
                <a href="{{ App\Helper\TemplateHelper::fetchSocialLink('steam') }}"><i class="fab fa-steam-symbol"></i></a>&nbsp;
                <a href="{{ App\Helper\TemplateHelper::fetchSocialLink('linkedin') }}"><i
                        class="fab fa-linkedin-in"></i></a>&nbsp;
                <a href="https://github.com/dogukanoksuz"><i class="fab fa-github"></i></a>&nbsp;
                <a href="mailto:{{ App\Helper\TemplateHelper::fetchSocialLink('mail') }}"><i
                        class="fas fa-envelope"></i></a>
            </div>
            <div class="col-sm-4 textAlignRight">
                Made with <i class="fas colorTheme fa-heart"></i> and <b>Laravel</b>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
@if (!Auth::guest())
    <script src="//cdn.tinymce.com/4/tinymce.min.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dist/js/app.js') }}" type="text/javascript"></script>
    <script>
        $('#lfm').filemanager('image', {prefix: '/admin/filemanager'});
        $('#input-tags').tagsInput();
    </script>
@endif
<script src="{{ asset('dist/js/featherlight.js') }}" type="text/javascript"></script>
</body>
</html>
