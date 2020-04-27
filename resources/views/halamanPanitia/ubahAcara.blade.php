@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Ubah Detail Acara | ticketbrite')

@section('js')
<script type="text/javascript">
    Dropzone.options.myDropzone = {
    addRemoveLinks: true,
    paramName: 'file',
    maxFilesize: 20, // MB
    maxFiles: 4,
    acceptedFiles: "image/*",
    init: function() {
        this.on("success", function(file, response) {
            let hasil = 'image/' + response;
            var forms = document.getElementById('ubah-acara');
            var files = document.createElement("input");
            files.setAttribute('name', 'files[]');
            files.setAttribute("type", "hidden");
            files.setAttribute("value", hasil);
            forms.appendChild(files);
        });
        this.on("addedfile", function() {});
    },
    removedfile: function(file) {
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};
</script>
<script>
    $(document)
    .ready(function() {
        $('.ui.form')
            .form({
                fields: {
                    nama_acara: {
                        identifier: 'nama_acara',
                        rules: [{
                            type: 'empty',
                            prompt: 'Nama acara tidak boleh dikosongkan'
                        }]
                    },
                    kategori: {
                        identifier: 'kategori',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan pilih kategori proyek terlebih dahulu'
                        }]
                    },
                    deskripsi: {
                        identifier: 'deskripsi',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan masukkan deskripsi singkat acara terlebih dahulu'
                        }]
                    },
                    kota: {
                        identifier: 'kota',
                        rules: [{
                            type: 'empty',
                            prompt: 'kota acara tidak boleh dikosongkan'
                        }]
                    },
                    lokasi: {
                        identifier: 'lokasi',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan masukkan lokasi acara terlebih dahulu'
                        }]
                    },
                    cp: {
                        identifier: 'cp',
                        rules: [{
                            type: 'empty',
                            prompt: 'Contact Person acara tidak boleh dikosongkan'
                        }]
                    },
                    maksimal: {
                        identifier: 'maksimal',
                        rules: [{
                            type: 'empty',
                            prompt: 'maksimal acara tidak boleh dikosongkan'
                        }]
                    },
                    status: {
                        identifier: 'status',
                        rules: [{
                            type: 'empty',
                            prompt: 'status acara tidak boleh dikosongkan'
                        }]
                    },
                    harga: {
                        identifier: 'harga',
                        rules: [{
                            type: 'empty',
                            prompt: 'harga acara tidak boleh dikosongkan'
                        }]
                    },
                }
            });
    });
</script>
@endsection

@section('content')
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div style="font-size:28px;line-height:1"><b>Ubah Detail Acara</b></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Ubah informasi acara anda menjadi lebih menarik agar para pengguna ticketbrite tertarik dengan acara anda.
        </div>
        <div class="ui divider"></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Anda akan melakukan perubahan pada acara berikut :
        </div>
        <div class="ui stackable grid" style="margin-top:5px">
            <div class="five wide column">
                <div class="ui one special cards">
                    <div class="card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <span>
                                        <button class="ui inverted medium button"
                                            onclick="$('.ui.fullscreen.modal.lihat').modal('show');">Lihat</button>
                                    </span>
                                </div>
                            </div>
                            <?php
                            $fotos= explode(" ", $dataAcara->foto_acara);
                            ?>
                            <img class="ui rounded image" src="{{asset($fotos[0])}}"
                                style="height:150px;object-fit:cover">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eleven wide left aligned column">
                <div style="font-size:22px"><b>{{ucfirst($dataAcara->nama_acara)}}</b></div>
                <div style="margin-top:10px;font-size:15px">
                    <span style="border:2px solid #d4d4d5;border-radius:4px;padding:3px 8px 3px 8px">
                        {{ucfirst($dataAcara->kategori)}}
                    </span>
                </div>
                <div style="margin-top:10px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate grey icon"></i></div>
                    <div style="font-size:19px">{{ucfirst($dataAcara->kota)}}</div>
                </div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui container fluid" style="margin-top:20px">
            <div style="font-size:18px"><b>Foto Acara Anda</b></div>
            <form action="{{ route('tamu.user.upload-foto') }}" enctype="multipart/form-data" class="dropzone"
                id="my-dropzone" style="margin-top:5px">
                {{csrf_field()}}
            </form>
            <button id="submit-all" type="submit" class="submitDropzone" style="display:none">Unggah</button>
            <!-- Cek data -->
            @if(\Session::has('alert'))
            <div class="ui negative message">
                <p>{{Session::get('alert')}}</p>
            </div>
            @endif
        </div>
        <form class="ui form" style="margin-top:15px" id="ubah-acara" method='post'
            action="{{route('tamu.user.panitia.verif.ubah-acara',['id_acara' => $dataAcara->id])}}"
            enctype="multipart/form-data">
            <div class="field">
                <label style="font-size:18px">Nama Acara</label>
                <input type="text" name="nama_acara" placeholder="Nama Acara">
            </div>
            <div class="field">
                <label style="font-size:18px">Kategori Acara</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="kategori">
                    <i class="dropdown icon"></i>
                    <div class="default text">Pilih Kategori Acara</div>
                    <div class="menu">
                        <div class="item" value="edukasi">Edukasi</div>
                        <div class="item" value="kesehatan">Kesehatan</div>
                        <div class="item" value="liburan">Liburan</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Deskripsi Singkat Acara</label>
                <textarea name="deskripsi" maxlength="191" rows="4"
                    placeholder="Tuliskan deskripsi singkat mengenai acara anda..."></textarea>
            </div>
            <div class="field">
                <label style="font-size:18px">Kota Acara</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="kota">
                    <i class="dropdown icon"></i>
                    <div class="default text">Pilih Kota Acara</div>
                    <div class="menu">
                        <div class="item" value="bangkalan">Bangkalan</div>
                        <div class="item" value="banyuwangi">Banyuwangi</div>
                        <div class="item" value="blitar">Blitar</div>
                        <div class="item" value="bojonegoro">Bojonegoro</div>
                        <div class="item" value="bondowoso">Bondowoso</div>
                        <div class="item" value="gresik">Gresik</div>
                        <div class="item" value="jember">Jember</div>
                        <div class="item" value="jombang">Jombang</div>
                        <div class="item" value="kediri">Kediri</div>
                        <div class="item" value="lamongan">Lamongan</div>
                        <div class="item" value="lumajang">Lumajang</div>
                        <div class="item" value="madiun">Madiun</div>
                        <div class="item" value="magetan">Magetan</div>
                        <div class="item" value="malang">Malang</div>
                        <div class="item" value="mojokerto">Mojokerto</div>
                        <div class="item" value="nganjuk">Ngajuk</div>
                        <div class="item" value="ngawi">Ngawi</div>
                        <div class="item" value="pacitan">Pacitan</div>
                        <div class="item" value="pamekasan">Pamekasan</div>
                        <div class="item" value="pasuruan">Pasuruan</div>
                        <div class="item" value="ponorogo">Ponorogo</div>
                        <div class="item" value="probolinggo">Probolinggo</div>
                        <div class="item" value="sampang">Sampang</div>
                        <div class="item" value="sidoarjo">Sidoarjo</div>
                        <div class="item" value="situbondo">Situbondo</div>
                        <div class="item" value="sumenep">Sumenep</div>
                        <div class="item" value="trenggalek">Trenggalek</div>
                        <div class="item" value="tuban">Tuban</div>
                        <div class="item" value="tulungagung">Tulungagung</div>
                        <div class="item" value="batu">Batu</div>
                        <div class="item" value="surabaya">Surabaya</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Nama Lokasi</label>
                <input type="text" name="lokasi" placeholder="Masukkan Nama Lokasi">
            </div>
            <div class="field">
                <label style="font-size:18px">Contact Person</label>
                <input type="text" name="cp" placeholder="Contact Person">
            </div>
            <div class="field">
                <label style="font-size:18px">Maksimal Orang Acara</label>
                <div class="ui labeled fluid input">
                    <input type="number" name="maksimal" placeholder="Masukkan maksimal orang acara">
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Tipe Acara</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="status">
                    <i class="dropdown icon"></i>
                    <div class="default text">Pilih Tipe Acara</div>
                    <div class="menu">
                        <div class="item" value="gratis">Gratis</div>
                        <div class="item" value="bayar">Bayar</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Biaya Acara</label>
                <div class="ui labeled fluid input">
                    <label class="ui label">Rp</label>
                    <input type="number" name="harga" placeholder="Masukkan Biaya Acara">
                </div>
            </div>
            {{csrf_field()}}
            <button class="ui big teal button fluid" onclick="" type="submit" name="submit" style="margin-top:40px">
                Ubah Acara
            </button>
            <div class="ui error message">
                <ul class="list">
                </ul>
            </div>
        </form>
    </div>
</div>

<!-- Modal detail -->
<div class="ui fullscreen modal lihat">
    <div class="content">
        <div class="ui stackable grid">
            <div class="nine wide column">
                <div class="ui stackable grid" style="height:100%">
                    <div class="twelve wide middle aligned column">
                        <div class="ui one stackable cards">
                            <div class="card">
                                <div class="image">
                                    <img class="ui big image" src="{{asset($fotos[0])}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="four wide middle aligned column">

                        <div class="ui one stackable cards">
                            @for($i=0;$i<count($fotos);$i++) <div class="card">
                                <div class="image">
                                    <img class="ui big image" src="{{asset($fotos[$i])}}"
                                        style="height:145px;object-fit:cover">
                                </div>
                        </div>
                        @endfor
                    </div>

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
                    <img class="ui circular image" src="{{asset($dataPanitia->foto)}}"
                        style="width:80px;height:80px;object-fit:cover">
                </div>
                <div class="thirteen wide column">
                    <div style="font-size:22px"><b>{{ucfirst($dataPanitia->nama_panitia)}}</b></div>
                    <div style="font-size:17px">aa</div>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="twelve wide column">
                    <div style="font-size:22px">
                        <b>{{ucfirst($dataAcara->nama_acara)}}</b>
                    </div>
                    <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div style="font-size:17px">{{ucfirst($dataAcara->kota)}}</div>
                    </div>
                </div>
                <div class="four wide right aligned middle aligned column">
                    <span style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                        {{ucfirst($dataAcara->kategori)}}
                    </span>
                </div>
            </div>
            <div class="ui divider"></div>
            <div>
                <div style="font-size:16px"><b>Kota</b></div>
                <div style="font-size:15px">
                    {{$dataAcara->kota}}
                </div>
            </div>
            <div style="margin-top:10px">
                <div style="font-size:16px"><b>Contact Person</b></div>
                <div style="font-size:15px">
                    {{$dataAcara->cp}}
                </div>
            </div>
            <div style="margin-top:10px">
                <div style="font-size:16px"><b>Maksimal</b></div>
                <div style="font-size:15px">
                    {{$dataAcara->cp}}
                </div>
            </div>
            <div style="margin-top:10px">
                <div style="font-size:16px"><b>Deskripsi</b></div>
                <div style="font-size:15px">
                    {{$dataAcara->deskripsi}}
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui container fluid" style="text-align:right">
                <div style="font-size:22px"><b>Biaya Acara</b></div>
                <div style="color:teal;font-size:20px">
                    <b>
                        <span>Rp </span>
                        <span>{{number_format(($dataAcara->harga),0,",",".")}}</span>
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="actions">
    <button class="ui positive button">
        Oke
    </button>
</div>
</div>
<!-- Akhir Modal detail -->

@include('layouts.footer')
@endsection
