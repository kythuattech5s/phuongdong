<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="vi">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {!!\vanhenry\helpers\helpers\SEOHelper::HEADER_SEO(@$currentItem?$currentItem:NULL)!!}
    <base href="{{url('/')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div id="google_translate_element2">
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                /*pageLanguage: 'vi',*/
                autoDisplay: false
            }, 'google_translate_element2');
        }
        function restoDefaultLanguage(){
            jQuery('#\\:1\\.container').contents().find('#\\:1\\.restore').click()
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    <script type="text/javascript">
        /* <![CDATA[ */
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
        /* ]]> */
    </script>
    <script src="frontend/js/jquery-3.4.0.min.js"></script>
    <script src="frontend/js/bootstrap.min.js" defer></script>
    <script src="frontend/js/bootstrap-datepicker.min.js" defer></script>
    <script src="frontend/js/bootstrap-datepicker.vi.min.js" defer></script>
    <script src="frontend/js/jquery.fancybox.min.js" defer></script>
    <script src="frontend/js/wow.js" defer></script>
    <script src="frontend/js/toastr.min.js" defer></script>
    <script src="frontend/js/swiper.min.js" defer></script>
    @yield('jsl')
    <script src="frontend/js/base.js" defer></script>
    <script src="frontend/js/script.js" defer></script>
    @yield('js')
</body>
</html>
