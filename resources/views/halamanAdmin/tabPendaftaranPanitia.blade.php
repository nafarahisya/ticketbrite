<div
    style="font-size:32px;color:white;text-align:center;background-color:#687672;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Pendaftaran Panitia</b>
</div>
<div style="margin-top:20px;background-color:#f8f8f8;border:5px solid #687672;border-radius:5px;color:#4d4d4d">
    <div class="ui container fluid" style="padding:30px 20px 30px 20px">
        <table class="ui striped stackable sortable celled grey table center aligned">
            <thead>
                <tr>
                    <th>ID Panitia</th>
                    <th>
                        <div>Nama Panitia</div>
                        <div>Nomor Telepon</div>
                    </th>
                    <th>Alamat Kantor</th>
                    <th>
                        Nama Pemilik
                    </th>
                    <th>Portofolio</th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($panitias); $i++) <?php $fotos= explode(" ", $panitias[$i]->url_image);?> <tr>
                    <td>{{$panitias[$i]->id}}</td>
                    <td>
                        <div>{{$panitias[$i]->nama_panitia}}</div>
                        <div>{{$panitias[$i]->nohp}}</div>
                    </td>
                    <td>{{$panitias[$i]->alamat}}</td>
                    <td>{{$users[$i]->username}}</td>
                    <td>
                        <button class="ui button basic grey"
                            onclick="$('.ui.large.modal.portofolio.<?php echo $i ?>').modal('show')">
                            Lihat
                        </button>
                    </td>
                    <td>
                        <div class="ui internally celled grid">
                            <div class="row">
                                <form class="eight wide column"
                                    action="{{route('tamu.user.admin.kelola-panitia', ['id' => $panitias[$i]->id, 'status'=> 1])}}"
                                    method="post">
                                    {{csrf_field()}}
                                    <button class="ui button basic green">Terima</button>
                                </form>
                                <form class="eight wide column"
                                    action="{{route('tamu.user.admin.kelola-panitia',['id' => $panitias[$i]->id, 'status' => -1])}}"
                                    method="post">
                                    {{csrf_field()}}
                                    <button class="ui button basic red">Tolak</button>
                                </form>

                            </div>
                        </div>
                    </td>
                    </tr>
                    <!-- Dimmer Portofolio Pendaftar -->
                    <div class="ui large modal portofolio <?php echo $i ?>">
                        <div class="header">
                            Portofolio Pendaftar
                        </div>
                        <div class="content">
                            <div class="ui two stackable cards">
                                @for($j=0; $j < count($fotos); $j++) <div class="card">
                                    <img src="/{{$fotos[$j]}}" style="height:250px;object-fit:cover">
                                    <a class="ui grey bottom attached button" href="/{{$fotos[$j]}}"
                                        download="portofolio<?php echo $j+1 ?>">
                                        Download
                                    </a>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="actions">
                        <button class="ui positive button">
                            Oke
                        </button>
                    </div>
    </div>
    @endfor
    </tbody>




</div>
</table>
</div>
</div>
