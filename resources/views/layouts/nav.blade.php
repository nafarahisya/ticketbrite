<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Site Properties -->
    <link rel="icon" href="assets/image/favicon.ico" type="image/gif">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

    <style type="text/css">
        .hidden.menu {
            display: none;
        }

        .masthead.segment {
            min-height: 700px;
            padding: 1em 0em;
        }

        .masthead .logo.item img {
            margin-right: 1em;
        }

        .masthead .ui.menu .ui.button {
            margin-left: 0.5em;
        }

        .masthead h1.ui.header {
            margin-top: 3em;
            margin-bottom: 0em;
            font-size: 4em;
            font-weight: normal;
        }

        .masthead h2 {
            font-size: 1.7em;
            font-weight: normal;
        }

        .ui.vertical.stripe {
            padding: 8em 0em;
        }

        .ui.vertical.stripe h3 {
            font-size: 2em;
        }

        .ui.vertical.stripe .button+h3,
        .ui.vertical.stripe p+h3 {
            margin-top: 3em;
        }

        .ui.vertical.stripe .floated.image {
            clear: both;
        }

        .ui.vertical.stripe p {
            font-size: 1.33em;
        }

        .ui.vertical.stripe .horizontal.divider {
            margin: 3em 0em;
        }

        .quote.stripe.segment {
            padding: 0em;
        }

        .quote.stripe.segment .grid .column {
            padding-top: 5em;
            padding-bottom: 5em;
        }

        .footer.segment {
            padding: 5em 0em;
        }

        .secondary.menu .toc.item {
            display: none;
        }

        @media only screen and (max-width: 768px) {
            .ui.fixed.menu {
                display: none !important;
            }

            .secondary.inverted.menu .item,
            .secondary.inverted.menu .menu {
                display: none;
            }

            .secondary.inverted.menu .toc.item {
                display: block;
            }
        }
    </style>
    <script>
        $(document)
        .ready(function() {
            // fix menu when passed
            $('.inverted.vertical')
                .visibility({
                    once: false,
                    onBottomPassed: function() {
                        $('.fixed.menu').transition('fade in');
                    },
                    onBottomPassedReverse: function() {
                        $('.fixed.menu').transition('fade out');
                    }
                });
            // create sidebar and attach to menu open
            $('.ui.sidebar')
                .sidebar('attach events', '.toc.item');

            $('.menu .item')
                .tab();
            $('.ui.dropdown')
                .dropdown();
                $('.ui.negative.message.alert').transition({
                animation  : 'fade in',
                duration   : '0.8s',
                onComplete : function() {
                    $(this).transition({
                        interval   : '2000',
                        animation  : 'fade out',
                        duration   : '0.8s',
                    });
                }
            });
        });
    </script>
    <script>
        //Salin Nilai
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    //Popup Berhasil
    var popupTimer;

    function delayPopup(popup) {
        popupTimer = setTimeout(function() {
            $(popup).popup('hide')
        }, 1000);
    }

    $(document).ready(function() {
        $('.copyToken').click(function() {
            clearTimeout(popupTimer);
            var $input = $(this).closest('div').find('.copyInput');
            /* Select the text field */
            $input.select();
            /* Copy the text inside the text field */
            document.execCommand("copy");
            $(this)
                .popup({
                    title: 'Berhasil Disalin!',
                    on: 'manual',
                    exclusive: true
                })
                .popup('show');
            // Hide popup after 5 seconds
            delayPopup(this);
        });
    });
    </script>
</head>

<body class="pushable">
    <!-- Following Menu -->
    <div class="ui large top borderless menu fixed transition hidden">
        <div class="ui container">
            <div class="item" style="margin-right:10px; width:100;height:100">
                <img src="{{asset('Model 1.png')}}" style="color:white">

            </div>
            <a class="item" href="{{route('index')}}">Beranda</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'edukasi'])}}">Edukasi</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'kesehatan'])}}">Kesehatan</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'liburan'])}}">Liburan</a>
            <div class="right item">
                <a class="ui teal button" style="margin-right:15px; background-color:#D1A827" href="{{ route('tamu.lihat-login') }}">
                    Masuk
                </a>
                <a class="ui teal button" style="background-color:#D1A827" href="{{ route('tamu.lihat-registrasi') }}">
                    Daftar
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar borderless menu left" style="background-color:#D1A827">
        <div class="item" style="margin-right:10px">
            <a class="ui tiny image" href="#">
                <img src="{{asset('Model 1.png')}}">
            </a>
        </div>
        <a class="item" href="{{route('index')}}">Beranda</a>
        <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'edukasi'])}}">Edukasi</a>
        <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'kesehatan'])}}">Kesehatan</a>
        <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'liburan'])}}">Liburan</a>
        <div class="right item">
            <a class="ui inverted button" style="margin-right:15px" href="{{ route('tamu.lihat-login') }}">
                Masuk
            </a>
            <a class="ui inverted button" href="{{ route('tamu.lihat-registrasi') }}">
                Daftar
            </a>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="pusher">
        <div class="ui inverted vertical center aligned segment" style="background-color:#A1BBD0">
            <div class="ui container">
                <div class="ui large secondary inverted menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <div class="item" style="margin-right:10px; width:100;height:100">
                        <img src="{{asset('Model 1.png')}}" style="color:white">
                    </div>
                    <a class="item" href="{{route('index')}}">Beranda</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'edukasi'])}}">Edukasi</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'kesehatan'])}}">Kesehatan</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'liburan'])}}">Liburan</a>
                    <div class="right item">
                        <div class="item">
                            <form class="ui icon input" method="get" action="{{route('lihat-acara-cari')}}">
                                <input type="text" placeholder="Cari sesuatu..." name="keyword">
                                <i class="search link icon"></i>
                            </form>
                        </div>
                        <a class="ui inverted button" style="margin-right:15px" href="{{ route('tamu.lihat-login') }}">
                            Masuk
                        </a>
                        <a class="ui inverted button" href="{{ route('tamu.lihat-registrasi') }}">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

</body>

</html>
