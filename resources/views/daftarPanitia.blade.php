@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Beranda | EventOn')

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
            var forms = document.getElementById('daftar-panitia');
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
                    foto: {
                        identifier: 'foto',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan pilih foto profil panitia terlebih dahulu'
                        }]
                    },
                    nama: {
                        identifier: 'nama_panitia',
                        rules: [{
                            type: 'empty',
                            prompt: 'Nama panitia tidak boleh dikosongkan'
                        }]
                    },
                    address: {
                        identifier: 'alamat',
                        rules: [{
                            type: 'empty',
                            prompt: 'Alamat panitia tidak boleh dikosongkan'
                        }]
                    },
                    nohp: {
                        identifier: 'nohp',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan masukkan nomor telepon panitia terlebih dahulu'
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
        <div style="font-size:28px"><b>Formulir Pendaftaran Panitia</b></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Daftarkan diri sebagai panitia agar bisa mempromosikan acara untuk pengguna EventOn
        </div>
        <div class="ui divider"></div>
        <div class="ui container fluid" style="margin-top:20px">
            <div style="font-size:18px"><b>Foto Portofolio</b></div>
            <form action="{{ route('tamu.user.upload-foto') }}" enctype="multipart/form-data" class="dropzone"
                id="my-dropzone" name="portofolio" style="margin-top:5px">
                {{csrf_field()}}
            </form>
            <!-- Cek data -->
            @if(\Session::has('alert'))
            <div class="ui negative message">
                <p>{{Session::get('alert')}}</p>
            </div>
            @endif
        </div>
        <form class="ui form" style="margin-top:15px" id="daftar-panitia" method='post'
            action="{{route('tamu.user.daftar-panitia')}}" enctype="multipart/form-data">
            <div class="ui container fluid">
                <div style="font-size:18px"><b>Foto Profil</b></div>
                <img class="ui small image" id="image-preview1" style="margin-top:10px">
                <label for="unggah_gambar1" class="ui label" style="cursor:pointer;margin-top:5px;margin-bottom:15px">
                    <i class="cloud upload icon"></i>
                    Pilih Foto
                </label>
                <input type="file" id="unggah_gambar1" name="foto"
                    onchange="previewImage('image-preview1','unggah_gambar1')" style="display: none">
            </div>
            <div class="field">
                <label style="font-size:18px">Nama Panitia</label>
                <input type="text" name="nama_panitia" placeholder="Masukkan Nama Panitia">
            </div>
            <div class="field">
                <label style="font-size:18px">Alamat Lengkap</label>
                <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap">
            </div>
            <div class="field">
                <label style="font-size:18px">Nomor Telepon</label>
                <input type="text" name="nohp" placeholder="Masukkan Nomor Telepon">
            </div>
            {{csrf_field()}}
            <button class="ui big teal button fluid" onclick="" type="submit" name="submit"
                style="margin-top:40px">Kirim Pendaftaran
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
