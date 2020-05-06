@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Pesan Tiket | ticketbrite')

@section('js')
<script>
    $(document)
    .ready(function() {
        $('.ui.form')
            .form({
                fields: {
                    nama: {
                        identifier: 'nama',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan masukkan nama pesanan anda terlebih dahulu'
                        }]
                    },
                    nohp: {
                        identifier: 'nohp',
                        rules: [{
                            type: 'empty',
                            prompt: 'Nomor hp tidak boleh dikosongkan!'
                        }]
                    },
                    alamat: {
                        identifier: 'alamat',
                        rules: [{
                            type: 'empty',
                            prompt: 'alamat tidak boleh dikosongkan!'
                        }]
                    },
                    email: {
                            identifier: 'email',
                            rules: [{
                                    type: 'empty',
                                    prompt: 'Alamat email tidak boleh kosong'
                                },
                                {
                                    type: 'email',
                                    prompt: 'Harap masukan email anda yang benar'
                                }
                            ]
                        },
                }
            });
    });
</script>
@endsection

@section('content')
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div style="font-size:28px"><b>Pesan Tiket</b></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Anda akan melakukan pemesanan Tiket dari Event :
        </div>
        <div class="ui stackable grid" style="margin-top:5px">
            <div class="three wide column">
                <?php
                    $fotos = explode(" ", $acara->foto_acara);
                    ?>
                <img class="ui circular image" src="{{asset($fotos[0])}}"
                    style="width:80px;height:80px;object-fit:cover">
            </div>
            <div class="thirteen wide column">
            <div style="font-size:22px"><b>{{$acara->nama_acara}}</b></div>
                <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate grey icon"></i></div>
                    <div style="font-size:18px">{{$acara->kategori}}</div>
                </div>
            </div>
        </div>
        <div class="ui divider"></div>
        <form class="ui form" style="margin-top:15px" id="tambah-pesanan" method='post'
            action="{{route('tamu.user.pesan-tiket')}}" enctype="multipart/form-data">
            <div class="field">
                <label style="font-size:18px">Nama Anda</label>
                <input type="text" name="nama">
            </div>
            <div class="field">
                <label style="font-size:18px">Nomor Handphone Anda</label>
                <input type="text" name="nohp">
            </div>
            <div class="field">
                <label style="font-size:18px">Alamat Anda</label>
                <input type="text" name="alamat">
                <input type="hidden" name="id_acara" value="{{$acara->id}}">
            </div>
            <div class="field">
                <label style="font-size:18px">Email Anda</label>
                <input type="text" name="email">
            </div>
            <div class="field">
                <label style="font-size:18px">Total Harga Tiket</label>
                <div class="ui labeled fluid input" style="font-size:18px">
                    <label class="ui label">Rp</label>
                    <input type="text" name="harga" value="{{number_format(($acara->harga),0,",",".")}}" readonly
                        style="background-color:#e8e8e8;border:none">
                </div>
            </div>
            <div style="margin-top:20px;padding:20px 20px 20px 20px;border-radius:5px;background-color:#F7EFD2">
                <div class="ui grid">
                    <div class="one wide column middle aligned">
                        <i class="info circle large grey icon"></i>
                    </div>
                    <div class="fifteen wide column" style="font-size:14px;line-height:1.5">
                        Pembayaran total biaya tiket dilakukan secara lunas.
                    </div>
                </div>
            </div>
            {{csrf_field()}}
            <button class="ui big grey button fluid" onclick="" type="submit" name="submit" style="margin-top:30px;backgroud-color:#D1A827">
                Periksa Pesanan Tiket
            </button>
            <div class="ui error message">
                <ul class="list">
                </ul>
            </div>
        </form>
    </div>
</div>


@include('layouts.footer')
@endsection
