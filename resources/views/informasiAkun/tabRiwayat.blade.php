<div
    style="font-size:32px;color:white;text-align:center;background-color:#687672;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Riwayat Pesanan Anda</b>
</div>
<div style="margin-top:20px;background-color:#f8f8f8;border:5px solid #687672;border-radius:5px;color:#4d4d4d">
    <div class="ui borderless inverted huge stackable menu" style="background-color:#687672;border-radius:0px">
        <a class="active item" data-tab="dalam-pengerjaan" style="font-size:17px;color:white">
            <b>Akan Datang</b>
        </a>
        <a class="item" data-tab="selesai" style="font-size:17px;color:white">
            <b>Selesai</b>
        </a>
        <a class="item" data-tab="dibatalkan" style="font-size:17px;color:white">
            <b>Dibatalkan</b>
        </a>
    </div>
    <div class="ui active tab" data-tab="dalam-pengerjaan" style="padding:20px 20px 30px 20px">
            @if(count($pesans)<=0)
            <div class="ui container center aligned">
                <i class="shopping cart icon teal huge"></i>
                <div style="font-size:24px;margin-top:15px"><b>Oops, anda belum melakukan pemesanan :(</b></div>
                <div style="font-size:20px;margin-top:15px">Yuk lakukan pemesanan sekarang...</div>
            </div>
            @elseif(count($pesans)>0)
        <div class="ui stackable three doubling link special cards">
                @for($i = 0; $i < count($pesans); $i++)
                <?php
                $fotos = explode(" ", $acaras[$i]->foto_acara);
                $time = strtotime($acaras[$i]->tahun.'-'.$acaras[$i]->bulan.'-'.$acaras[$i]->tanggal);
                $newformat = date('Y-m-d',$time);
                $now = date('Y-m-d H:i:s');
                $statusTampil = null;
                if($pesans[$i]->status=="0"){
                    $statusTampil = "Menunggu Pembayaran";
                }else if($pesans[$i]->status=="1"){
                    $statusTampil = "Terkonfirmasi";
                }else{
                    $statusTampil = "Tidak Terkonfirmasi";
                }
                ?>
                @if((($pesans[$i]->status=="1" && $newformat>$now) || ( $pesans[$i]->status=="0" && $newformat>$now)))
             <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <i class="teal clock outline huge icon"></i>
                            <div style="font-size:22px;margin-top:10px;margin-bottom:20px">
                                Akan Datang
                            </div>
                        <button class="ui inverted medium button" onclick="window.location.href='{{route('tamu.user.lihat-detail-acara',['id_acara'=>$pesans[$i]->id_acara])}}'">Lihat</button>
                        </div>
                    </div>
                    <img class="ui fluid image" src="{{asset($fotos[0])}}" style="object-fit:cover;height:250px">
                    <div class="ui top right attached teal large label" style="max-width:55%">
                        {{$statusTampil}}
                    </div>
                </div>
                <div class="content">
                    <div class="header">{{ ucfirst($acaras[$i]->nama_acara)}}</div>
                    <div class="meta" style="margin-top:5px">
                        <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                            {{ ucfirst($acaras[$i]->kategori)}}
                        </span>
                    </div>
                    <div class="description">
                            {{ $acaras[$i]->deskripsi}}
                    </div>
                </div>
                <div class="extra content">
                    <div>
                        <i class="user circle teal icon"></i>
                        {{ucfirst($panitias[$i]->nama_panitia)}}
                    </div>
                    <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div>{{ucfirst($acaras[$i]->lokasi)}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endfor
        </div>
        @endif
    </div>
    <div class="ui tab" data-tab="selesai" style="padding:20px 20px 30px 20px">
            @if(count($pesans)<=0)
            <div class="ui container center aligned">
                    <i class="shopping cart icon teal huge"></i>
                    <div style="font-size:24px;margin-top:15px"><b>Oops, anda belum melakukan pemesanan :(</b></div>
                    <div style="font-size:20px;margin-top:15px">Yuk lakukan pemesanan sekarang...</div>
                </div>
            @elseif(count($pesans)>0)
        <div class="ui stackable three doubling link special cards">
                @for($i = 0; $i < count($pesans); $i++)
                <?php
                $fotos = explode(" ", $acaras[$i]->foto_acara);
                $time = strtotime($acaras[$i]->tahun.'-'.$acaras[$i]->bulan.'-'.$acaras[$i]->tanggal);
                $newformat = date('Y-m-d',$time);
                $now = date('Y-m-d H:i:s');
                $statusTampil = null;
                ?>
                @if($pesans[$i]->status=="1" && $newformat<$now)
            <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <i class="green check circle outline huge icon"></i>
                            <div style="font-size:22px;margin-top:10px;margin-bottom:20px">
                                Selesai
                            </div>
                            <button class="ui inverted medium button" onclick="window.location.href='{{route('tamu.user.lihat-detail-acara',['id_acara'=>$pesans[$i]->id_acara])}}'">Lihat</button>
                        </div>
                    </div>
                    <img src="{{asset($fotos[0])}}" style="object-fit:cover;height:250px">
                </div>
                <div class="content">
                    <div class="header">{{ ucfirst($acaras[$i]->nama_acara)}}</div>
                    <div class="meta" style="margin-top:5px">
                        <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                                {{ ucfirst($acaras[$i]->kategori)}}
                        </span>
                    </div>
                    <div class="description">
                        {{ $acaras[$i]->deskripsi}}
                    </div>
                </div>
                <div class="extra content">
                    <div>
                        <i class="user circle teal icon"></i>
                        {{ucfirst($panitias[$i]->nama_panitia)}}
                    </div>
                    <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div>{{ucfirst($acaras[$i]->lokasi)}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endfor
        </div>
        @endif
    </div>
    <div class="ui tab" data-tab="dibatalkan" style="padding:20px 20px 30px 20px">
            @if(count($pesans)<=0)
            <div class="ui container center aligned">
                <i class="shopping cart icon teal huge"></i>
                <div style="font-size:24px;margin-top:15px"><b>Oops, anda belum melakukan pemesanan :(</b></div>
                <div style="font-size:20px;margin-top:15px">Yuk lakukan pemesanan sekarang...</div>
            </div>
            @elseif(count($pesans)>0)
        <div class="ui stackable three doubling link special cards">
                @for($i = 0; $i < count($pesans); $i++)
                <?php
                $fotos = explode(" ", $acaras[$i]->foto_acara);
                ?>
                @if($pesans[$i]->status=="-1")
            <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <i class="red times circle outline huge icon"></i>
                            <div style="font-size:22px;margin-top:10px;margin-bottom:20px">
                                Dibatalkan
                            </div>
                        </div>
                    </div>
                    <img src="{{asset($fotos[0])}}" style="object-fit:cover;height:250px">
                </div>
                <div class="content">
                    <div class="header">{{ ucfirst($acaras[$i]->nama_acara)}}</div>
                    <div class="meta" style="margin-top:5px">
                        <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                                {{ ucfirst($acaras[$i]->kategori)}}
                        </span>
                    </div>
                    <div class="description">
                            {{ ucfirst($acaras[$i]->deskripsi)}}
                    </div>
                </div>
                <div class="extra content">
                    <div>
                        <i class="user circle teal icon"></i>
                        {{ucfirst($panitias[$i]->nama_panitia)}}
                    </div>
                    <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div>{{ucfirst($acaras[$i]->lokasi)}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endfor
        </div>
        @endif
    </div>
</div>

<!-- Modal belum ada progres -->
<div class="ui small modal belum progres">
    <div class="header">
        Belum Ada Progres
    </div>
    <div class="content">
    <div class="ui container center aligned">
            <i class="sync alternate icon teal massive"></i>
            <div style="font-size:24px;margin-top:15px"><b>Oops, progres pengerjaan proyek anda belum tersedia...</b></div>
            <div style="font-size:19px">Harap tunggu beberapa saat sampai profesi mengirimkan progres pengerjaan proyek anda</div>
        </div>
    </div>
    <div class="actions">
        <button class="ui positive button">
            Oke
        </button>
    </div>
</div>
