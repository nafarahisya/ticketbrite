@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Pencarian | ticketbrite')

@section('content')

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
<div class="ui container" style="margin-top:30px">
    <div style="margin-top:10px;font-size:24px">
        Silahkan cari hingga mendapatkan acara terbaik pilihan anda
    </div>
    <div style="margin-top:10px;margin-bottom:25px;font-size:17px">
        Terdapat {{count($acaras)}} event untuk <b>'{{$key}}'</b> di ticketbrite
    </div>
</div>

<div class="ui divider"></div>

<div class="ui container" style="margin-top:30px">
    @if(count($acaras) <= 0) <!-- Kalo gak ketemu -->
        <div class="ui container center aligned">
            <i class="search icon teal huge"></i>
            <div style="font-size:24px;margin-top:15px"><b>Oops, desain tidak ditemukan :(</b></div>
            <div style="font-size:18px;margin:15px 0px 15px 0px">
                Hasil pencarian untuk <b>'{{$key}}'</b> tidak ditemukan.
                Silahkan coba keyword lainnya
            </div>
        </div>
        @elseif(count($acaras) > 0)
        <!-- Kalo ketemu -->
        <div class="ui stackable grid">
            <div class="four wide column">
                <div class="ui card">
                    <form class="ui form" action="{{route('lihat-acara-kategori')}}" method="get" style="padding:15px">
                        <div class="ui divider"></div>
                        <!-- <div class="ui divider"></div> -->
                        <label><b>Harga</b></label>
                        <div class="grouped fields">
                            <div class="field">
                                <div class="ui input">
                                    <input type="hidden" name="kategori" value="{{$key}}">
                                    <input type="number" name="min" placeholder="Minimum">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui input">
                                    <input type="number" name="max" placeholder="Maksimum">
                                </div>
                            </div>
                        </div>
                        <div class="ui divider"></div>
                        <button class="ui teal button fluid">Filter</button>
                        <div class="ui divider"></div>
                    </form>
                </div>
            </div>
            <div class="twelve wide column">
                <div class="ui three stackable doubling link cards">
                    @for($i=0;$i < count($acaras);$i++) <?php $fotos = explode(" ", $acaras[$i]->foto_acara);?> <div
                        class="card" onclick="$('.ui.fullscreen.modal.detail.<?php echo $i ?>').modal('show');">
                        <img class="ui fluid image" src="{{$fotos[0]}}" style="object-fit:cover;height:250px">
                        <div class="ui top right attached teal large label">
                            <b>
                                <span>{{strftime("%d %b %Y",strtotime($acaras[$i]->tahun.'-'.$acaras[$i]->bulan.'-'.$acaras[$i]->tanggal))}}</span>
                            </b>
                        </div>
                        <div class="content">
                            <div class="header">{{ ucfirst($acaras[$i]->nama_acara)}}</div>
                            <div class="meta" style="margin-top:5px">
                                <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                                    {{ ucfirst($acaras[$i]->kategori)}}
                                </span>
                            </div>
                            <div class="description">
                                {{ $acaras[$i]->deskripsi}}
                            </div>
                        </div>
                        <div class="extra content">
                            <div>
                                <i class="user circle teal icon"></i>
                                {{ucfirst($panitia[$i]->nama_panitia)}}
                            </div>
                            <div style="margin-top:5px;display:flex;flex-direction:row;align-acaras: center">
                                <div><i class="map marker alternate teal icon"></i></div>
                                <div>{{ ucfirst($acaras[$i]->lokasi)}}</div>
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
                                    <img class="ui circular image" src="{{asset($panitia[$i]->foto)}}"
                                        style="width:80px;height:80px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:22px"><b>{{ ucfirst($panitia[$i]->nama_panitia)}}</b></div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="twelve wide column">
                                    <div style="font-size:22px">
                                        <b>{{ucfirst($acaras[$i]->nama_acara)}}</b>
                                    </div>
                                    <div style="margin-top:5px;display:flex;flex-direction:row;align-acaras: center">
                                        <div><i class="map marker alternate teal icon"></i></div>
                                        <div style="font-size:17px">{{ ucfirst($acaras[$i]->kota)}}</div>
                                    </div>
                                </div>
                                <div class="four wide right aligned middle aligned column">
                                    <span
                                        style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                                        {{ucfirst($acaras[$i]->kategori)}}
                                    </span>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Contact Person</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->cp}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Maksimal</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->maksimal}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Kuota Tersisa</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->sisa_kuota}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Deskripsi</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->deskripsi}}
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui container fluid" style="text-align:right">
                                <div style="font-size:22px"><b>Harga Tiket</b></div>
                                <div style="color:teal;font-size:20px">
                                    <b>
                                        <span>Rp </span>
                                        <span>{{number_format(($acaras[$i]->harga),0,",",".")}}</span>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="sixteen wide column">
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="one wide column">
                                    <img class="ui circular image" src="{{asset($panitia[$i]->foto)}}"
                                        style="width:70px;height:70px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:18px"><b>Lorem Ipsum Dolor Amet</b></div>
                                </div>
                            </div>
                            <div class="ui stackable grid">
                                <div class="one wide column">
                                    <img class="ui circular image" src="{{asset($panitia[$i]->foto)}}"
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
                        onclick="window.location.href='{{route('tamu.user.lihat-halaman-pesan-tiket',['id_acara'=>$acaras[$i]->id])}}'">
                        Pesan Tiket
                    </button>
                </div>
            </div>
            <!--Akhir Modal Detail -->
            @endfor
        </div>
</div>
</div>
@endif
</div>

@include('layouts.footer')
@endsection
