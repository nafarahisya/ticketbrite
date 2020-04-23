@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Tambah Acara | EventOn')

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
            var forms = document.getElementById('buat-acara');
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
                    tanggal: {
                        identifier: 'tanggal',
                        rules: [{
                            type: 'empty',
                            prompt: 'tanggal acara tidak boleh dikosongkan'
                        }]
                    },
                    bulan: {
                        identifier: 'bulan',
                        rules: [{
                            type: 'empty',
                            prompt: 'bulan acara tidak boleh dikosongkan'
                        }]
                    },
                    tahun: {
                        identifier: 'tahun',
                        rules: [{
                            type: 'empty',
                            prompt: 'tahun acara tidak boleh dikosongkan'
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
        <div style="font-size:28px"><b>Tambah Acara</b></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Bagikan informasi acara anda kepada para pengguna EventOn agar mereka tertarik dengan acara anda.
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
        <form class="ui form" style="margin-top:15px" id="buat-acara" method='post'
            action="{{ route('tamu.user.panitia.verif.buat-acara') }}" enctype="multipart/form-data">
            <div class="field">
                <label style="font-size:18px">Nama Acara</label>
                <input type="text" name="nama_acara" placeholder="Masukkan Nama Acara">
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
                <label style="font-size:18px">Tanggal Acara</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="tanggal">
                    <i class="dropdown icon"></i>
                    <div class="default text">Pilih Tanggal Acara</div>
                    <div class="menu">
                        <div class="item" value="1">1</div>
                        <div class="item" value="2">2</div>
                        <div class="item" value="3">3</div>
                        <div class="item" value="4">4</div>
                        <div class="item" value="5">5</div>
                        <div class="item" value="6">6</div>
                        <div class="item" value="7">7</div>
                        <div class="item" value="8">8</div>
                        <div class="item" value="9">9</div>
                        <div class="item" value="10">10</div>
                        <div class="item" value="11">11</div>
                        <div class="item" value="12">12</div>
                        <div class="item" value="13">13</div>
                        <div class="item" value="14">14</div>
                        <div class="item" value="15">15</div>
                        <div class="item" value="16">16</div>
                        <div class="item" value="17">17</div>
                        <div class="item" value="18">18</div>
                        <div class="item" value="19">19</div>
                        <div class="item" value="20">20</div>
                        <div class="item" value="21">21</div>
                        <div class="item" value="22">22</div>
                        <div class="item" value="23">23</div>
                        <div class="item" value="24">24</div>
                        <div class="item" value="25">25</div>
                        <div class="item" value="26">26</div>
                        <div class="item" value="27">27</div>
                        <div class="item" value="28">28</div>
                        <div class="item" value="29">29</div>
                        <div class="item" value="30">30</div>
                        <div class="item" value="31">31</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Bulan Acara</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="bulan">
                    <i class="dropdown icon"></i>
                    <div class="default text">Pilih Bulan Acara</div>
                    <div class="menu">
                        <div class="item" value="1">Januari</div>
                        <div class="item" value="2">Februari</div>
                        <div class="item" value="3">Maret</div>
                        <div class="item" value="4">April</div>
                        <div class="item" value="5">Mei</div>
                        <div class="item" value="6">Juni</div>
                        <div class="item" value="7">Juli</div>
                        <div class="item" value="8">Agustus</div>
                        <div class="item" value="9">September</div>
                        <div class="item" value="10">Oktober</div>
                        <div class="item" value="11">November</div>
                        <div class="item" value="12">Desember</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label style="font-size:18px">Tahun Acara</label>
                <input type="text" name="tahun" placeholder="Masukkan Tahun Acara">
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
                Tambah Acara
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
