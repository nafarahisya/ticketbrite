@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Periksa Pesanan Acara | ticketbrite')

@section('js')
<script>
    $(document)
    .ready(function() {
        $('.ui.form')
            .form({
                fields: {
                    bank_pengirim: {
                        identifier: 'bank_pengirim',
                        rules: [{
                            type: 'empty',
                            prompt: 'Bank pengirim tidak boleh kosong'
                        }]
                    },
                    bank_tujuan: {
                        identifier: 'bank_tujuan',
                        rules: [{
                            type: 'empty',
                            prompt: 'Bank tujuan tidak boleh kosong'
                        }]
                    },
                    nomor_rekening: {
                        identifier: 'nomor_rekening',
                        rules: [{
                            type: 'empty',
                            prompt: 'Nomor rekening tidak boleh kosong'
                        }]
                    }
                }
            });
    });
</script>
@endsection

@section('content')
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div class="ui stackable grid">
            <div class="ten wide middle aligned column">
                <div style="font-size:28px;line-height:1"><b>Periksa Pesanan Acara</b></div>
            </div>
        </div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Anda melakukan pemesanan acara dari panitia :
        </div>
        <div class="ui stackable grid" style="margin-top:5px">
            <div class="three wide column">
                <img class="ui circular image" src="{{asset($panitia->foto)}}"
                    style="width:80px;height:80px;object-fit:cover">
            </div>
            <div class="thirteen wide column">
                <div style="font-size:22px"><b>{{ ucfirst($panitia->nama_panitia)}}</b></div>
                <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate teal icon"></i></div>
                    <div style="font-size:18px">{{ ucfirst($acara->kota)}}</div>
                </div>
            </div>
        </div>
        <?php
        $total = 0; $sisa = 0;
        $fotos = explode(" ", $acara->foto_acara);
        ?>
        <div class="ui divider"></div>
        <div style="font-size:18px"><b>Acara</b></div>
        <div class="ui container fluid" style="margin-top:5px">
            <div class="ui four stackable cards">
                @for($j=0; $j < count($fotos); $j++) <div class="card">
                    <div class="image">
                        <img src="/{{$fotos[$j]}}" style="height:100px;object-fit:cover">
                    </div>
            </div>
            @endfor
        </div>
    </div>
    <form class="ui form" style="margin-top:15px" id="tambah-pesanan" method='post'
        action="{{route('tamu.user.update-konfirmasi-transfer')}}" enctype="multipart/form-data">
        <div class="field">
            <label style="font-size:18px">Nama Anda</label>
            <input type="text" name="nama" value="{{$pesan->nama}}" readonly>
        </div>
        <div class="field">
            <label style="font-size:18px">Nomor Handphone Anda</label>
            <input type="text" name="nohp" value="{{$pesan->nohp}}" readonly>
        </div>
        <div class="field">
            <label style="font-size:18px">Alamat Anda</label>
            <input type="text" name="alamat" value="{{$pesan->alamat}}" readonly>
        </div>
        <div class="field">
            <label style="font-size:18px">Email Anda</label>
            <input type="text" name="email" value="{{$pesan->email}}" readonly>
        </div>
        <div class="field">
            <label style="font-size:18px">Nomor Rekening Anda</label>
            <input type="number" name="nomor_rekening" placeholder="nomor rekening anda">
        <input type="hidden" name="id_pesan" value="{{$pesan->id}}">
        </div>
        <div class="field">
            <label style="font-size:18px">Bank Pengirim</label>
            <div class="ui dropdown selection">
                <select name="bank_pengirim">
                    <option value=""></option>
                    <option value="BCA"></option>
                    <option value="MANDIRI"></option>
                    <option value="BRI"></option>
                    <option value="BNI"></option>
                    <option value="CIMB"></option>
                </select>
                <i class="dropdown icon"></i>
                <div class="default text">
                    <div style="font-size:18px">
                        <b>Pilih Bank Pengirim</b>
                    </div>
                </div>
                <div class="menu fluid">
                    <div class="item" data-value="BCA">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbca.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BCA
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="MANDIRI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankmandiri.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer Mandiri
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="BRI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbri.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BRI
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="BNI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbni.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BNI
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="CIMB">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankcimb.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer CIMB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui divider"></div>
        </div>
        <div class="field">
            <label style="font-size:18px">Bank Tujuan</label>
            <div class="ui dropdown selection">
                <select name="bank_tujuan">
                    <option value=""></option>
                    <option value="BCA">010203</option>
                    <option value="MANDIRI">040506</option>
                    <option value="BRI">070809</option>
                    <option value="BNI">101112</option>
                    <option value="CIMB">131415</option>
                </select>
                <i class="dropdown icon"></i>
                <div class="default text">
                    <div style="font-size:18px">
                        <b>Pilih Bank Tujuan</b>
                    </div>
                </div>
                <div class="menu fluid">
                    <div class="item" data-value="BCA">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbca.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BCA
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="MANDIRI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankmandiri.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer Mandiri
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="BRI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbri.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BRI
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="BNI">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankbni.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer BNI
                            </div>
                        </div>
                    </div>
                    <div class="item" data-value="CIMB">
                        <div style="display:flex;flex-direction:row;align-items:center;padding:5px 10px 5px 10px">
                            <div>
                                <img class="ui tiny image" src="{{asset('bankcimb.png')}}">
                            </div>
                            <div style="font-size:17px;font-weight:bold;margin-left:40px">
                                Transfer CIMB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui divider"></div>
        </div>
        {{csrf_field()}}
        <button class="ui big teal button fluid" onclick="" type="submit" name="submit" style="margin-top:40px">
            Lanjutkan
        </button>
    </form>
</div>
</div>


@include('layouts.footer')
@endsection
