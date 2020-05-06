@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Detail Acara | ticketbrite')

@section('content')

<div class="ui container" style="padding:65px 0px 65px 0px">
<h2>Acara {{$acara->nama_acara}}</h2>
    <div class="ui divider" style="margin-bottom:20px"></div>
    <div class="ui stackable grid">
        <div class="ten wide column">
            <div class="ui stackable grid" style="height:100%">
                <?php
                $fotos = explode(" ", $acara->foto_acara);
                ?>
                <div class="twelve wide column">
                    <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img class="ui big image" src="{{asset($fotos[0])}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    @for($j=0; $j < count($fotos); $j++) <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img src="{{asset($fotos[$j])}}" style="height:175px;object-fit:cover">
                            </div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="four wide column">
        <div class="ui divider"></div>
        <div class="ui grid">
            <div class="one wide middle aligned column">
                <i class="info circle large grey icon"></i>
            </div>
            <div class="fourteen wide middle aligned column" style="margin-left:5px">
                <div style="font-size:22px;color:grey"><b>Detail Acara</b></div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui stackable grid">
            <div class="one wide column">
                <img class="ui circular image" src="{{asset($panitia->foto)}}"
                    style="width:80px;height:80px;object-fit:cover">
            </div>
            <div class="one wide middle aligned column">
                <div style="font-size:22px"><b>{{ucfirst($panitia->nama_panitia)}}</b></div>
                <div style="font-size:17px;margin-top:5px">Nomor Panitia: {{$panitia->nohp}}</div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui stackable grid">
            <div class="twelve wide middle aligned column">
                <div style="font-size:22px">
                    <b>{{strftime("%d %b %Y",strtotime($acara->tahun.'-'.$acara->bulan.'-'.$acara->tanggal))}}</b>
                </div>
                <div style="margin-top:10px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate grey icon"></i></div>
                    <div style="font-size:16px">{{ucfirst($acara->kota)}}</div>
                </div>
            </div>
            <div class="four wide right aligned middle aligned column">
                <span style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                    {{ucfirst($acara->kategori)}}
                </span>
            </div>
        </div>
        <div class="ui divider"></div>
    <div style="font-size:20px"><b>Deskripsi</b></div>
        <div style="font-size:17px;margin-top:10px">
            <span>{{$acara->deskripsi}} </span>
        </div>
        <div style="font-size:20px;margin-top:15px"><b>Lokasi Acara</b></div>
        <div style="font-size:17px;margin-top:10px;line-height:1.5">
            {{$acara->lokasi}}
        </div>
        <div style="font-size:20px;margin-top:15px"><b>Contact Person Acara</b></div>
        <div style="font-size:17px;margin-top:10px;line-height:1.5">
            {{$acara->cp}}
        </div>
    </div>
</div>
</div>

@include('layouts.footer')
@endsection
