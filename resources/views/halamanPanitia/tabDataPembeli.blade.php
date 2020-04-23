<div
    style="font-size:32px;color:white;text-align:center;background-color:#4b8991;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Data Pembeli Tiket Acara</b>
</div>
<div style="margin-top:20px;background-color:#f8f8f8;border:5px solid #4b8991;border-radius:5px;color:#4d4d4d">
    <div class="ui container fluid" style="padding:30px 20px 30px 20px">
        <table class="ui striped stackable sortable celled teal table center aligned">
            <thead>
                <tr>
                    <th>No Pembeli</th>
                    <th>Nama Pembeli</th>
                    <th>Nomor HP Pembeli</th>
                    <th>Email Pembeli</th>
                    <th>Alamat Pembeli</th>
                    <th>Status Pembeli</th>
                    <th>Pembelian Tiket</th>
                </tr>
            </thead>
            @for($i = 0; $i < count($pesans); $i++)
            <tbody>
                <tr>
                    <?php
                        $status = null;
                        if($pesans[$i]->status==0 || $pesans[$i]->status==1){
                            $status = "Terdaftar";
                        }else if($pesans[$i]->status==-1){
                            $status = "Pembayaran Tidak Terkonfirmasi";
                        }
                    ?>
                    <td>{{$pesans[$i]->id}}</td>
                    <td>{{$pesans[$i]->nama}}</td>
                    <td>{{$pesans[$i]->nohp}}</td>
                    <td>{{$pesans[$i]->email}}</td>
                    <td>{{$pesans[$i]->alamat}}</td>
                    <td>{{$status}}</td>
                    <td>{{strftime("%d %b %Y",strtotime($pesans[$i]->created_at))}}</td>
                </tr>
            </tbody>
            @endfor
        </table>
    </div>
</div>
