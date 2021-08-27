<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="vi">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {!!\vanhenry\helpers\helpers\SEOHelper::HEADER_SEO(@$currentItem?$currentItem:NULL)!!}
    <base href="{{url('/')}}">
    <link href="frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/animate.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/toastr.min.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/bootstrap-datepicker.min.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/swiper.min.css" type="text/css" rel="stylesheet" />
    <link href="frontend/css/jquery.fancybox.min.css" type="text/css" rel="stylesheet" />
    @yield('cssl')
    <link href="frontend/css/reset.css" type="text/css" rel="stylesheet" />
    <link href="frontend/scss/style.css" type="text/css" rel="stylesheet" />
    <link href="frontend/scss/mobile.css" type="text/css" rel="stylesheet" />
    @yield('css')
    <script type="text/javascript">
        var messageNotify = "{{Session::get('messageNotify', '')}}";
        var typeNotify = "{{Session::get('typeNotify', '')}}";
    </script>
</head>
<body class="scrollstyle">
    @if (!isset($onlyShowContent))
        @include('header')
    @endif
    @yield('content')
    @if (!isset($onlyShowContent))
        @include('footer')
    @endif
    <script src="frontend/js/jquery-3.4.0.min.js"></script>
    <script src="frontend/js/bootstrap.min.js" defer></script>
    <script src="frontend/js/bootstrap-datepicker.min.js" defer></script>
    <script src="frontend/js/bootstrap-datepicker.vi.min.js" defer></script>
    <script src="frontend/js/jquery.fancybox.min.js" defer></script>
    <script src="frontend/js/wow.js" defer></script>
    <script src="frontend/js/toastr.min.js" defer></script>
    <script src="frontend/js/swiper.min.js" defer></script>
    @yield('jsl')
    <script src="frontend/js/script.js" defer></script>
    @yield('js')
</body>
</html>
