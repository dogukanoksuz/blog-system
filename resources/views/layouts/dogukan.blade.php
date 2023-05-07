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
     -->
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>Doğukan Öksüz</title>
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/featherlight.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.css') }}?v=20200728" rel="stylesheet">
    <style>
      div.tagsinput{border:1px solid #CCC;background:#FFF;padding:5px;width:300px;height:100px;overflow-y:auto}div.tagsinput span.tag{border:1px solid #a5d24a;-moz-border-radius:2px;-webkit-border-radius:2px;display:block;float:left;padding:5px;text-decoration:none;background:#cde69c;color:#638421;margin-right:5px;margin-bottom:5px;font-family:helvetica;font-size:13px}div.tagsinput span.tag a{font-weight:700;color:#82ad2b;text-decoration:none;font-size:11px}div.tagsinput input{width:80px;margin:0 5px 5px 0;font-family:helvetica;font-size:13px;border:1px solid transparent;padding:5px;background:0 0;color:#000;outline:0}div.tagsinput div{display:block;float:left}.tags_clear{clear:both;width:100%;height:0}.not_valid{background:#FBD8DB!important;color:#90111A!important}
    </style>
</head>
<body>
@yield('content')
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/js/featherlight.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/js/highlight.pack.js') }}" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
  document.querySelectorAll('pre').forEach((block) => {
    hljs.highlightBlock(block);
  });
});
</script>
@yield('scripts')
</body>
</html>
