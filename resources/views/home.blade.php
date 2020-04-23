@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Beranda | EventOn')

@section('content')
<div class="ui container fluid" style="background-color:#273d40">
    @if(\Session::has('alert'))
    <div style="position:absolute;right:15px;top:15px;max-width:400px">
        <div class="ui negative message alert" style="display:none">
            {{Session::get('alert')}}
        </div>
    </div>
    @elseif(\Session::has('alert-success'))
    <div style="position:absolute;right:15px;top:15px;max-width:400px">
        <div class="ui positive message alert" style="display:none">
            {{Session::get('alert-success')}}
        </div>
    </div>
    @endif
    <div class="ui container center aligned">
        <div class="ui three row stackable grid">
            <div class="column">
                <div class="row">
                    <h1 style="font-size:36px;color:white;margin-top:20px">Wujudkan Event Terbesar Anda</h1>
                </div>
                <div class="ui two column stackable grid" style="margin-top:20px">
                    <div class="row">
                        <div class="column">
                            <img src="{{asset('eventOn1.png')}}" class="ui big centered image">
                        </div>
                        <div class="column middle aligned">
                            <div class="ui two row grid">
                                <div class="column">
                                    <div class="row">
                                        <h2 class="ui header" style="color:white">Apa Itu eventOn?</h2>
                                        <p style="color:white;font-size:16px">EventOn merupakan solusi yang tepat bagi
                                            anda yang ingin membuat suatu event
                                            impian anda.
                                        </p>
                                    </div>
                                    <div class="row" style="margin-top:30px">
                                        <h2 class="ui header" style="color:white">Mengikuti Event Tertentu</h2>
                                        <p style="color:white;font-size:16px">Selain itu, di eventOn kamu juga bisa
                                            memesan tiket event tertentu lho!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    @if(!Session::has('username'))
                    <a href="{{ route('tamu.lihat-registrasi') }}">
                        <div class="ui huge animated fade button teal" tabindex="0"
                            style="border-radius:5px;margin-bottom:20px;color:white">
                            <div class="visible content">Ingin Jadi Event Organizer?</div>
                            <div class="hidden content">
                                Daftar Sekarang
                            </div>
                        </div>
                    </a>
                    @else
                    <a href="#cari">
                        <div class="ui huge animated fade button teal" tabindex="0"
                            style="border-radius:5px;margin-bottom:20px;color:white">
                            <div class="visible content">Ingin Beli Tiket Event Tertentu ?</div>
                            <div class="hidden content">
                                Pesan Sekarang
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui container" style="margin-top:60px;margin-bottom:40px">
    <div style="font-size:36px;text-align:center">
        <p>Apa Keuntungan Menggunakan eventOn?</p>
    </div>
    <div class="ui divider" style="margin:40px 0px 20px 0px"></div>
    <div style="font-size:32px;margin-bottom:10px">
        <p>Bagi Event Organizer</p>
    </div>
    <div class="ui middle aligned stackable grid">
        <div class="seven wide left floated column">
            <img src="{{asset('arsitek2.jpg')}}" class="ui large rounded image">
        </div>
        <div class="nine wide column">
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="file image huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Event</h2>
                    <p style="font-size:18px">Memasarkan event yang dibuat untuk dapat ditemukan oleh semua pengguna
                        EventOn</p>
                </div>
            </div>
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="handshake huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Penjualan</h2>
                    <p style="font-size:18px">Memudahkan penjualan tiket event yang diselenggarakan</p>
                </div>
            </div>
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="money bill alternate huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Keuntungan</h2>
                    <p style="font-size:18px">Mendapatkan penghasilan dari penjualan tiket yang pasarkan</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ui divider" style="margin:40px 0px 20px 0px"></div>
    <div style="font-size:32px;margin-bottom:10px;text-align:right">
        <p>Bagi Pelanggan</p>
    </div>
    <div class="ui middle aligned stackable grid">
        <div class="nine wide column">
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="search huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Menemukan</h2>
                    <p>Menemukan event yang diinginkan</p>
                </div>
            </div>
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="calendar alternate huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Tanggal</h2>
                    <p>Tanggal pemesanan sebelum event berlangsung</p>
                </div>
            </div>
            <div class="ui middle aligned stackable grid">
                <div class="two wide left floated column">
                    <i class="shield alternate huge icon"></i>
                </div>
                <div class="fourteen wide left floated column" style="padding-left:20px">
                    <h2>Keamanan</h2>
                    <p>Transaksi yang aman dan terpercaya</p>
                </div>
            </div>
        </div>
        <div class="seven wide right floated column">
            <img src="{{asset('customer.jpg')}}" class="ui large rounded right floated image">
        </div>
    </div>
</div>

<div id="cari" class="ui container fluid">
    <div class="ui divider"></div>
    <div class="ui container" style="margin-top:30px">
        <div class="ui center aligned container" style="font-size:36px">
            <p>Ingin mencari event yang anda inginkan ?</p>
        </div>
        <div class="ui center aligned container" style="margin-top:10px;font-size:22px">
            <p>Silahkan cari hingga mendapatkan event yang cocok untuk anda</p>
        </div>
        <form class="ui fluid action input" style="margin-top:20px;font-size:18px;padding-left:60px;padding-right:60px"
            method="get" action="{{route('lihat-acara-cari')}}">
            <input type="text" name="keyword" placeholder="Cari desain rumah impian yang ingin anda buat...">
            <button type="submit" class="ui button teal">Cari</button>
        </form>
    </div>

    <div class="ui container" style="margin-top:30px">
        <div class="ui four stackable doubling link cards">
            @for($i=0;$i<(count($items)> 10 ? 10 : count($items));$i++)
                <?php
            $fotos = explode(" ", $items[$i]->foto_acara);
            ?>
                <div class="card" onclick="$('.ui.fullscreen.modal.detail.<?php echo $i ?>').modal('show');">
                    <img class="ui fluid image" src="{{asset($fotos[0])}}" style="object-fit:cover;height:250px">
                    <div class="ui top right attached teal large label">
                        <b>
                            <span>{{strftime("%d %b %Y",strtotime($items[$i]->tahun.'-'.$items[$i]->bulan.'-'.$items[$i]->tanggal))}}</span>
                        </b>
                    </div>
                    <div class="content">
                        <div class="header">{{ucfirst($items[$i]->nama_acara)}}</div>
                        <div class="meta" style="margin-top:5px">
                            <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                                {{ucfirst($items[$i]->kategori)}}
                            </span>
                        </div>
                        <div class="description">
                            {{$items[$i]->deskripsi}}
                        </div>
                    </div>
                    <div class="extra content">
                        <div>
                            <i class="user circle teal icon"></i>
                            {{ ucfirst($panitias[$i]->nama_panitia)}}
                        </div>
                        <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                            <div><i class="map marker alternate teal icon"></i></div>
                            <div>{{ucfirst($items[$i]->kota)}}</div>
                        </div>
                    </div>
                </div>
                <!-- Modal Detail -->
                <div class="ui fullscreen modal detail <?php echo $i ?>">
                    <div class="content">
                        <div class="ui stackable grid">
                            <div class="nine wide column">
                                <div class="ui stackable grid" style="height:100%">
                                    <div class="twelve wide middle aligned column">
                                        <div class="ui one stackable cards">
                                            <div class="card">
                                                <div class="image">
                                                    <img class="ui big image" src="/{{$fotos[0]}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="four wide middle aligned column">
                                        @for($j=0; $j < count($fotos); $j++) <div class="ui one stackable cards">
                                            <div class="card">
                                                <div class="image">
                                                    <img src="/{{$fotos[$j]}}" style="height:145px;object-fit:cover">
                                                </div>
                                            </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="seven wide column">
                            <div class="ui divider"></div>
                            <div class="ui grid">
                                <div class="one wide middle aligned column">
                                    <i class="info circle large teal icon"></i>
                                </div>
                                <div class="fifteen wide column">
                                    <div style="font-size:22px;color:teal"><b>Detail Acara</b></div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="three wide column">
                                    <img class="ui circular image" src="{{asset($panitias[$i]->foto)}}"
                                        style="width:80px;height:80px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:22px"><b>{{ ucfirst($panitias[$i]->nama_panitia)}}</b></div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="twelve wide column">
                                    <div style="font-size:22px">
                                        <b>{{ucfirst($items[$i]->nama_acara)}}</b>
                                    </div>
                                    <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                                        <div><i class="map marker alternate teal icon"></i></div>
                                        <div style="font-size:17px">{{ ucfirst($items[$i]->kota)}}</div>
                                    </div>
                                </div>
                                <div class="four wide right aligned middle aligned column">
                                    <span
                                        style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                                        {{ucfirst($items[$i]->kategori)}}
                                    </span>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Contact Person</b></div>
                                <div style="font-size:15px">
                                    {{$items[$i]->cp}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Maksimal</b></div>
                                <div style="font-size:15px">
                                    {{$items[$i]->maksimal}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Kuota Tersisa</b></div>
                                <div style="font-size:15px">
                                    {{$items[$i]->sisa_kuota}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Deskripsi</b></div>
                                <div style="font-size:15px">
                                    {{$items[$i]->deskripsi}}
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui container fluid" style="text-align:right">
                                <div style="font-size:22px"><b>Harga Tiket</b></div>
                                <div style="color:teal;font-size:20px">
                                    <b>
                                        <span>Rp </span>
                                        <span>{{number_format(($items[$i]->harga),0,",",".")}}</span>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="sixteen wide column">
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="one wide column">
                                    <img class="ui circular image" src="{{asset($panitias[$i]->foto)}}"
                                        style="width:70px;height:70px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:18px"><b>Lorem Ipsum Dolor Amet</b></div>
                                </div>
                            </div>
                            <div class="ui stackable grid">
                                <div class="one wide column">
                                    <img class="ui circular image" src="{{asset($panitias[$i]->foto)}}"
                                        style="width:70px;height:70px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:18px"><b>Lorem Ipsum Dolor Amet</b></div>
                                </div>
                            </div>
                            <form class="ui form" style="margin-top:15px" id="daftar-panitia" method='post' action="/"
                                enctype="multipart/form-data">
                                <div class="field">
                                    <label style="font-size:18px">Isi Komentar</label>
                                    <input type="text" name="alamat" placeholder="Isi Komentar Anda">
                                </div>
                                {{csrf_field()}}
                                <button class="ui big teal button fluid" onclick="" type="submit" name="submit"
                                    style="margin-top:40px">Kirim Komentar
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="actions">
                    <button class="ui negative button">
                        Pilih Lagi
                    </button>
                    <button class="ui positive button"
                        onclick="window.location.href='{{route('tamu.user.lihat-halaman-pesan-tiket',['id_acara'=>$items[$i]->id])}}'">
                        Pesan Tiket
                    </button>
                </div>
        </div>
        @endfor
        <!--Akhir Modal Detail -->
    </div>
    <div class="ui center aligned container" style="margin-top:40px">
        <a href="{{route('lihat-semua-acara')}}">
            <div class="ui vertical animated large teal button" style="width:150px">
                <div class="hidden content">Lihat Semua</div>
                <div class="visible content">
                    <i class="angle double down icon"></i>
                </div>
            </div>
        </a>
    </div>
</div>
</div>





@include('layouts.footer')
@endsection
