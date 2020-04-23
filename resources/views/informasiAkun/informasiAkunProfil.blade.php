@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Informasi Akun | EventOn')

@section('content')
@if(\Session::has('alert'))
    <div style="position:absolute;right:15px;top:15px;max-width:400px">
        <div class="ui negative message alert" style="display:none">
            {{Session::get('alert')}}
        </div>
    </div>
@endif
<div class="ui container" style="margin-top:86px;margin-bottom:86px">
    <div class="ui stackable grid">
        <div class="four wide column">
            <div
                style="border:4px solid #4b8991;border-radius:5px;background-color:#f8f8f8;padding:40px 30px 40px 30px">
                <div
                    style="text-align:center;line-height:1.5;font-size:22px;margin-top:20px;margin-bottom:20px;color:#4d4d4d">
                    <b>{{Session::get('username')}}</b>
                </div>
                <div class="ui divider" style="margin-top:10px;margin-bottom:20px"></div>
                <div class="ui secondary vertical pointing fluid menu" style="color:#4d4d4d;font-size:17px">
                    <a class="active item" data-tab="profil">
                        Profil
                    </a>
                    <a class="item" data-tab="riwayat-orderan">
                        Riwayat Pesanan
                    </a>
                </div>
                <div class="ui divider" style="margin-top:20px"></div>
            </div>
        </div>
        <div class="twelve wide column" style="padding-left:30px">
            <div class="ui active tab" data-tab="profil">
                @include('informasiAkun.tabProfil')
            </div>
            <div class="ui tab" data-tab="riwayat-orderan">
                @include('informasiAkun.tabRiwayat')
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
