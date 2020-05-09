@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Kode Pesanan Acara | ticketbrite')

@section('js')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
@endsection

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
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div style="font-size:28px"><b>Masukkan Kode Pesanan Acara Peserta</b></div>

        <div class="ui divider"></div>
        <form class="ui form" style="margin-top:15px" id="tambah-progres" method="get" action="{{route('tamu.user.panitia.verif.deteksi-barcode-acara')}}" enctype="multipart/form-data">

            <div class="field">
                <label style="font-size:18px">Kode Pesanan</label>
                <input type="text" name="kode_pesanan" placeholder="Masukkan Kode Acara">
            </div>
            {{csrf_field()}}
            <button class="ui big grey button fluid" type="submit" name="submit" style="margin-top:40px;background-color:#D1A827">
                Kirim
            </button>
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection
