<div
    style="font-size:32px;color:white;text-align:center;background-color:#687672;border-top-left-radius:5px;border-top-right-radius:5px;padding:20px">
    <b style="line-height:1.5">Kumpulan Acara Anda</b>
</div>
<div
    style="margin-top:20px;background-color:#f8f8f8;border:5px solid #687672;border-radius:5px;padding:30px 20px 30px 20px;color:#4d4d4d">
    @if(count($acaras)<=0)
        <div class="ui container center aligned">
            <i class="huge search grey icon"></i>
            <div style="font-size:24px;line-height:1.5;margin-top:15px"><b>Oops, anda belum memiliki acara :(</b></div>
            <div style="font-size:20px;line-height:1.5;margin-top:15px">Yuk tambahkan acara anda ke ticketbrite agar calon pemesan tertarik dengan acara yang anda tawarkan.</div>
            <button class="ui large grey button"  style="margin-top:15px; background-color:#D1A827" onclick="window.location.href='{{route('tamu.user.panitia.verif.lihat-halaman-tambah-acara')}}'">Tambah acara</button>
        </div>
    @else
    <div style="font-size:20px">
        <b>Silahkan pilih salah satu acara yang ingin anda lihat atau ubah detail acaranya</b>
    </div>
    <div class="ui stackable three doubling link special cards" style="margin-top:10px">
        @for($i = 0; $i < count($acaras); $i++)
        <?php
            $fotos= explode(" ", $acaras[$i]->foto_acara);
            ?>
        <div class="card">
            <div class="blurring dimmable image">
                <div class="ui dimmer">
                    <div class="content">
                        <span>
                            <button class="ui inverted medium button" onclick="$('.ui.fullscreen.modal.lihat.<?php echo $i ?>').modal('show');">Lihat</button>
                        </span>
                        <span>
                            <button class="ui inverted medium button" onclick="window.location.href='{{route('tamu.user.panitia.verif.lihat-halaman-ubah-acara',['id_acara' => $acaras[$i]->id])}}'">Ubah</button>
                        </span>
                    </div>
                </div>
                <img src="{{asset($fotos[0])}}" style="object-fit:cover;height:250px">
            </div>
            <div class="content">
            <div class="header">{{ucfirst($acaras[$i]->nama_acara)}}</div>
                <div class="meta" style="margin-top:5px">
                    <span style="border:2px solid #d4d4d5;border-radius:4px;padding:2px 4px 2px 4px">
                        {{ucfirst($acaras[$i]->kota)}}
                    </span>
                </div>
                <div class="description">
                    {{$acaras[$i]->deskripsi}}
                </div>
            </div>
            <div class="extra content">
                <div>
                    <i class="user circle grey icon"></i>
                    {{ucfirst($panitia->nama_panitia)}}
                </div>
                <div style="margin-top:5px;display:flex;flex-direction:row;align-acaras: center">
                    <div><i class="map marker alternate grey icon"></i></div>
                    <div>{{ucfirst($acaras[$i]->lokasi)}}</div>
                </div>
            </div>
        </div>
            <!-- Modal Detail -->
            <div class="ui fullscreen modal lihat <?php echo $i ?>">
                <div class="content">
                    <div class="ui stackable grid">
                        <div class="nine wide column">
                            <div class="ui stackable grid" style="height:100%">
                                <div class="twelve wide middle aligned column">
                                    <div class="ui one stackable cards">
                                        <div class="card">
                                            <div class="image">
                                                <img class="ui big image" src="/{{$fotos[0]}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="four wide middle aligned column">
                                @for($j=0; $j < count($fotos); $j++)
                                    <div class="ui one stackable cards">
                                        <div class="card">
                                            <div class="image">
                                                <img src="/{{$fotos[$j]}}" style="height:145px;object-fit:cover">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                </div>
                            </div>
                        </div>
                        <div class="seven wide column">
                            <div class="ui divider"></div>
                            <div class="ui grid">
                                <div class="one wide middle aligned column">
                                    <i class="info circle large grey icon"></i>
                                </div>
                                <div class="fifteen wide column">
                                    <div style="font-size:22px;color:grey"><b>Detail acara</b></div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="three wide column">
                                    <img class="ui circular image" src="{{asset($panitia->foto)}}"
                                        style="width:80px;height:80px;object-fit:cover">
                                </div>
                                <div class="thirteen wide column">
                                    <div style="font-size:22px"><b>{{ucfirst($panitia->nama_panitia)}}</b></div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui stackable grid">
                                <div class="twelve wide column">
                                    <div style="font-size:22px">
                                        <b>{{ucfirst($acaras[$i]->nama_acara)}}</b>
                                    </div>
                                    <div style="margin-top:5px;display:flex;flex-direction:row;align-acaras: center">
                                        <div><i class="map marker alternate grey icon"></i></div>
                                        <div style="font-size:17px">{{ucfirst($acaras[$i]->lokasi)}}</div>
                                    </div>
                                </div>
                                <div class="four wide right aligned middle aligned column">
                                    <span
                                        style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                                        {{ucfirst($acaras[$i]->kategori)}}
                                    </span>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Kota</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->kota}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Contact Person</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->cp}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Maksimal</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->maksimal}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Tiket Terjual</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->maksimal-$acaras[$i]->sisa_kuota}}
                                </div>
                            </div>
                            <div style="margin-top:10px">
                                <div style="font-size:16px"><b>Deskripsi</b></div>
                                <div style="font-size:15px">
                                    {{$acaras[$i]->deskripsi}}
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui container fluid" style="text-align:right">
                                <div style="font-size:22px"><b>Biaya Acara</b></div>
                                <div style="color:grey;font-size:20px">
                                    <b>
                                        <span>Rp </span>
                                    <span>{{number_format(($acaras[$i]->harga),0,",",".")}}</span>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <a >
                        <button class="ui negative button" onclick="$('.ui.tiny.modal.hapus.<?php echo $i ?>').modal('show')">
                            Hapus acara
                        </button>
                        <button class="ui grey button" onclick="window.location.href='{{route('tamu.user.panitia.verif.lihat-halaman-ubah-acara',['id_acara' => $acaras[$i]->id])}}'">
                            Ubah Detail Acara
                        </button>
                        <button class="ui orange button" onclick="window.location.href='{{route('tamu.user.panitia.verif.lihat-halaman-pembeli',['id_acara' => $acaras[$i]->id])}}'">
                                Lihat Data Pembeli Acara
                        </button>
                    </a>
                </div>
            </div>
            <!--Akhir Modal Detail -->
            <!-- Dimmer hapus -->
            <div class="ui tiny modal hapus <?php echo $i ?>">
                <div class="header">
                    Hapus acara
                </div>
                <div class="content">
                    <div style="font-size:18px">Apakah anda yakin ingin menghapus acara ini?</div>
                </div>
                <div class="actions">
                    <div style="display:flex;flex-direction:row-reverse">
                        <form action='{{route('tamu.user.panitia.verif.hapus-acara',['id_acara' => $acaras[$i]->id])}}' method="post">
                            {{csrf_field()}}
                            <button class="ui positive button">
                                Iya
                            </button>
                        </form>
                        <button class="ui negative button" style="margin-right:10px">
                            Tidak
                        </button>
                    </div>
                </div>
            </div>
        @endfor
        <!-- Card untuk tambah acara -->
        <div class="card">
            <div class="blurring dimmable segments" style="height:100%;padding:190px 20px 190px 20px">
                <div class="ui dimmer">
                    <div class="content">
                        <div class="center">
                            <a>
                            <button class="ui inverted button" onclick="window.location.href='{{route('tamu.user.panitia.verif.lihat-halaman-tambah-acara')}}'">Tambah Acara</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content center aligned">
                    <div class="meta">
                        <i class="icon huge plus"></i>
                        <div style="font-size:24px;margin-top:20px"><b>Tambah acara</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
