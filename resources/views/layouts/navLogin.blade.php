<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Site Properties -->
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <script src="/js/dropzone.js"></script>
    <link rel="icon" href="assets/image/favicon.ico" type="image/gif">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="http://semantic-ui.com/javascript/library/tablesort.js"></script>

    @yield('js')

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

        @media only screen and (max-width: 1024px) {
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
            $('table')
                .tablesort();
            $('.menu .item')
                .tab();
            $('.ui.dropdown')
                .dropdown();
            $('select.dropdown')
                .dropdown();
            $('.special.cards .image').dimmer({
                on: 'hover'
            });
            $('.special.cards .segments').dimmer({
                on: 'hover'
            });
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
            $('.ui.positive.message.alert').transition({
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
            //Get Data
            var date = $('.date');
            var inputD = $('#dateD');
            var inputF = $('#dateF');
            date.on('click', function() {
                var valueD = $(this).data('value');
                var valueF = $(this).data('formatted');
                alert(valueD);
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
    <script>
        $(document)
        .ready(function() {});
    //Tampilkan gambar yang dipilih
    function previewImage(preview, unggah) {
        document.getElementById(preview).style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById(unggah).files[0]);
        oFReader.onload = function(oFREvent) {
            document.getElementById(preview).src = oFREvent.target.result;
        };
    };
    </script>
</head>

<body class="pushable">
    <!-- Following Menu -->
    <div class="ui large top borderless menu fixed transition hidden">
        <div class="ui container">
            <div class="item" style="margin-right:10px">
                <img src="{{asset('Model 1.png')}}" style="color:white">
            </div>
            <a class="item" href="{{route('index')}}">Beranda</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'edukasi'])}}">Edukasi</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'kesehatan'])}}">Kesehatan</a>
            <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'liburan'])}}">Liburan</a>
            <div class="item">
                <form class="ui icon input" method="get" action="{{route('lihat-acara-cari')}}" style="width:350px">
                    <input type="text" placeholder="Cari sesuatu..." name="keyword">
                    <i class="search link icon"></i>
                </form>
            </div>
            <div class="right item">
                <div class="ui grey top right pointing dropdown button" style="background-color:#D1A827">
                    <i class="briefcase icon"></i>
                    <span>Panitia</span>
                    <div class="menu">
                        @if(Session::has('nama_panitia'))
                        <div class="header" style="font-size:14px">
                            Informasi Panitia
                        </div>
                        <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-profile-panitia')}}"
                            style="margin-left:20px;margin-right:20px">
                            Profil Panitia
                        </a>
                        <div class="header" style="font-size:14px">
                            Acara Panitia
                        </div>
                        <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-tambah-acara')}}"
                            style="margin-left:20px;margin-right:20px">
                            Tambah Acara
                        </a>
                        <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-kumpulan-acara')}}"
                            style="margin-left:20px;margin-right:20px">
                            Kumpulan Acara
                        </a>
                        <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')}}"
                            style="margin-left:20px;margin-right:20px">
                            Deteksi Barcode Acara
                        </a>
                        @else
                        <a class="item" href="{{route('tamu.user.lihat-halaman-daftar-panitia')}}"
                            style="margin-left:20px;margin-right:20px">
                            Daftar Panitia
                        </a>
                        @endif
                    </div>
                </div>
                <div class="ui grey top right pointing dropdown button" style="margin-left:15px; background-color:#D1A827">
                    <i class="user circle icon"></i>
                    <span>Akun</span>
                    <div class="menu">
                        <a href="#">
                            <div style="width:250px;padding:20px">
                                <div style="font-size:18px;text-align:center;margin-top:15px;color:black">
                                    {{Session::get('username')}}
                                </div>
                            </div>
                        </a>
                        <div class="divider"></div>
                        @if(Session::get('username') == "admin")
                        <a class="item" href="{{route('tamu.user.admin.lihat-halaman-konfirmasi-pembayaran')}}">
                            <div style="font-size:14px">
                                <b>HALAMAN ADMIN</b>
                            </div>
                        </a>
                        @endif
                        <div class="header" style="font-size:14px">
                            Informasi Akun
                        </div>
                        <a class="item" href="{{route('tamu.user.lihat-akun')}}"
                            style="margin-left:20px;margin-right:20px">
                            Profil
                        </a>
                        <a class="item" href="{{route('tamu.user.lihat-halaman-pesanan')}}"
                            style="margin-left:20px;margin-right:20px">
                            Riwayat Pesanan
                        </a>
                        <a href="{{route('tamu.logout')}}">
                            <button class="ui fluid grey button" style="margin-top:10px; background-color:#D1A827">
                                <i class="sign-out icon"></i>
                                Keluar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar borderless menu left" style="background-color:#A1BBD0">
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
            <div class="ui inverted top right pointing dropdown button">
                <i class="briefcase icon"></i>
                <span>Panitia</span>
                <div class="menu">
                    <div class="divider"></div>
                    @if(Session::has('nama_panitia'))
                    <div class="header" style="font-size:14px">
                        Informasi Panitia
                    </div>
                    <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-profile-panitia')}}"
                        style="margin-left:20px;margin-right:20px">
                        Profil Panitia
                    </a>
                    <div class="header" style="font-size:14px">
                        Acara Panitia
                    </div>
                    <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-tambah-acara')}}"
                        style="margin-left:20px;margin-right:20px">
                        Tambah Acara
                    </a>
                    <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-kumpulan-acara')}}"
                        style="margin-left:20px;margin-right:20px">
                        Kumpulan Acara
                    </a>
                    <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')}}"
                        style="margin-left:20px;margin-right:20px">
                        Deteksi Barcode Acara
                    </a>
                    @else
                    <a class="item" href="{{route('tamu.user.lihat-halaman-daftar-panitia')}}"
                        style="margin-left:20px;margin-right:20px">
                        Daftar Panitia
                    </a>
                    @endif
                </div>
            </div>
            <div class="ui inverted top right pointing dropdown button" style="margin-left:15px">
                <i class="user circle icon"></i>
                <span>Akun</span>
                <div class="menu">
                    <a href="#">
                        <div style="width:250px;padding:20px">
                            <div style="font-size:18px;text-align:center;margin-top:15px;color:black">
                                {{Session::get('username')}}
                            </div>
                        </div>
                    </a>
                    <div class="divider"></div>
                    @if(Session::get('username') == "admin")
                    <a class="item" href="{{route('tamu.user.admin.lihat-halaman-konfirmasi-pembayaran')}}">
                        <div style="font-size:14px">
                            <b>HALAMAN ADMIN</b>
                        </div>
                    </a>
                    @endif
                    <div class="header" style="font-size:14px">
                        Informasi Akun
                    </div>
                    <a class="item" href="{{route('tamu.user.lihat-akun')}}" style="margin-left:20px;margin-right:20px">
                        Profil
                    </a>
                    <a class="item" href="{{route('tamu.user.lihat-halaman-pesanan')}}"
                        style="margin-left:20px;margin-right:20px">
                        Riwayat Pesanan
                    </a>
                    <a href="{{route('tamu.logout')}}">
                        <button class="ui fluid grey button" style="margin-top:10px">
                            <i class="sign-out icon"></i>
                            Keluar
                        </button>
                    </a>
                </div>
            </div>
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
                    <div class="item" style="margin-right:10px">
                        <img src="{{asset('Model 1.png')}}" style="color:white">

                    </div>
                    <a class="item" href="{{route('index')}}">Beranda</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'edukasi'])}}">Edukasi</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'kesehatan'])}}">Kesehatan</a>
                    <a class="item" href="{{route('lihat-acara-kategori',['kategori'=>'liburan'])}}">Liburan</a>
                    <div class="item">
                        <form class="ui icon input" method="get" action="" style="width:350px">
                            <input type="text" placeholder="Cari sesuatu..." name="cari">
                            <i class="search link icon"></i>
                        </form>
                    </div>
                    <div class="right item">
                        <div class="ui inverted top right pointing dropdown link button">
                            <i class="briefcase icon"></i>
                            <span>Panitia</span>
                            <div class="menu">
                                @if(Session::has('nama_panitia'))
                                <div class="header" style="font-size:14px">
                                    Informasi Panitia
                                </div>
                                <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-profile-panitia')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Profil Panitia
                                </a>
                                <div class="header" style="font-size:14px">
                                    Acara Panitia
                                </div>
                                <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-tambah-acara')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Tambah Acara
                                </a>
                                <a class="item" href="{{route('tamu.user.panitia.lihat-halaman-kumpulan-acara')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Kumpulan Acara
                                </a>
                                <a class="item" href="{{route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Deteksi Barcode Acara
                                </a>
                                @else
                                <a class="item" href="{{route('tamu.user.lihat-halaman-daftar-panitia')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Daftar Panitia
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="ui inverted top right pointing dropdown button" style="margin-left:15px;">
                            <i class="user circle icon"></i>
                            <span>Akun</span>
                            <div class="menu">
                                <a href="#">
                                    <div style="width:250px;padding:20px">
                                        <div style="font-size:18px;text-align:center;margin-top:15px;color:black">
                                            {{Session::get('username')}}
                                        </div>
                                    </div>
                                </a>
                                <div class="divider"></div>
                                @if(Session::get('username') == "admin")
                                <a class="item" href="{{route('tamu.user.admin.lihat-halaman-konfirmasi-pembayaran')}}">
                                    <div style="font-size:14px">
                                        <b>HALAMAN ADMIN</b>
                                    </div>
                                </a>
                                @endif
                                <div class="header" style="font-size:14px">
                                    Informasi Akun
                                </div>
                                <a class="item" href="{{route('tamu.user.lihat-akun')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Profil
                                </a>
                                <a class="item" href="{{route('tamu.user.lihat-halaman-pesanan')}}"
                                    style="margin-left:20px;margin-right:20px">
                                    Riwayat Pesanan
                                </a>
                                <a href="{{route('tamu.logout')}}">
                                    <button class="ui fluid grey button" style="margin-top:10px">
                                        <i class="sign-out icon"></i>
                                        Keluar
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

</body>

</html>
