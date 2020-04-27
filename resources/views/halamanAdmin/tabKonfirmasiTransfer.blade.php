<div
    style="font-size:32px;color:white;text-align:center;background-color:#687672;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Konfirmasi Pembayaran</b>
</div>
<div style="margin-top:20px;background-color:#f8f8f8;border:5px solid #687672;border-radius:5px;color:#4d4d4d">
    <div class="ui container fluid" style="padding:30px 20px 30px 20px">
        <table class="ui striped stackable sortable celled teal table center aligned">
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>Nomor Rekening</th>
                    <th>
                        <div>Nominal dan</div>
                        <div>Bukti Pembayaran</div>

                    </th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            @for($i = 0; $i < count($pesans); $i++) <tbody>
                <tr>
                    <td>{{$pesans[$i]->id}}</td>
                    <td>{{$pesans[$i]->created_at}}</td>
                    <td>{{$pesans[$i]->nama}}</td>
                    <td>{{$pesans[$i]->nomor_rekening}}</td>
                    <td>
                        <span>Rp </span>
                        <span>{{number_format(($pesans[$i]->jumlah),0,",",".")}}</span>
                        <div style="margin-top:5px">
                            <button class="ui button basic teal"
                                onclick="$('.ui.large.modal.bukti.<?php echo $i ?>').modal('show')">Lihat</button>
                        </div>
                    </td>
                    <td>
                        <div class="ui internally celled grid">
                            <div class="row">
                                <form class="eight wide column"
                                    action="{{route('tamu.user.admin.kelola-pembayaran', ['id' => $pesans[$i]->id, 'status'=> 1])}}"
                                    method="post">
                                    {{csrf_field()}}
                                    <button class="ui button basic green">Terima</button>
                                </form>
                                <form class="eight wide column"
                                    action="{{route('tamu.user.admin.kelola-pembayaran', ['id' => $pesans[$i]->id, 'status' => -1])}}"
                                    method="post">
                                    {{csrf_field()}}
                                    <button class="ui button basic red">Tolak</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                <!-- Dimmer Pengajuan Transaksi -->
                <div class="ui large modal bukti <?php echo $i ?>">
                    <div class="header">
                        Bukti Pembayaran
                    </div>
                    <div class="content">
                        <img class="ui large centered image" src={{asset($pesans[$i]->gambar_konfirmasi)}}>
                    </div>
                    <div class="actions">
                        <button class="ui negative button">
                            Tutup
                        </button>
                        <a class="ui teal right button" href="{{asset($pesans[$i]->gambar_konfirmasi)}}"
                            download="buktipembayaran<?php echo $pesans[$i]->nama ?>">
                            Download
                        </a>
                    </div>
                </div>
                @endfor
        </table>
    </div>
</div>
