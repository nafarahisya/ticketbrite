<div
    style="font-size:32px;color:white;text-align:center;background-color:#687672;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Informasi Akun</b>
</div>
<div
    style="margin-top:20px;background-color:#f8f8f8;border:5px solid #687672;border-radius:5px;padding:40px 50px 40px 50px;color:#4d4d4d">
    <div style="margin-top:30px">
        <label style="font-size:22px"><b>Nama Panitia</b></label>
        <div style="font-size:18px;margin-top:10px">
            {{Session::get('nama_panitia')}}
        </div>
    </div>
    <div style="margin-top:30px">
        <label style="font-size:22px"><b>Nomor Telepon</b></label>
        <div style="font-size:18px;margin-top:10px">
            {{ $panitia->nohp}}
        </div>
    </div>
    <div style="margin-top:30px">
        <label style="font-size:22px"><b>Alamat Tempat Tinggal</b></label>
        <div style="font-size:18px;margin-top:10px">
            {{ $panitia->alamat}}
        </div>
    </div>
    <div style="margin-top:30px">
        <div style="font-size:16px;margin-top:10px">
            Bergabung dengan ticketbrite sejak <b>{{strftime("%d %b %Y",strtotime($panitia->created_at))}}</b>
        </div>
    </div>
</div>
