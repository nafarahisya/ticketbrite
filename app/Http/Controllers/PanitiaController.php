<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PanitiaRequest;
use App\Http\Requests\AcaraRequest;
use App\Panitia;
use App\Acara;
use App\Peserta;
use App\Pesan;



class PanitiaController extends Controller
{

    function lihatProfilePanitia()
    {
        $panitia = Panitia::where('id', Session::get('id_panitia'))->first();
        $acaras = Acara::where('id_panitia', $panitia->id)->get();
        if ($panitia) {
            return view('halamanPanitia.profilPanitia', compact('panitia', 'acaras'));
        } else {
            abort(404);
        }
    }

    function buatAcara(AcaraRequest $request)
    {
        if ($request['files'] != null) {
            $data = new Acara();
            $data->foto_acara = implode(" ", $request['files']);
            $data->nama_acara = $request->nama_acara;
            $data->deskripsi = $request->deskripsi;
            $data->kota = $request->kota;
            $data->lokasi = $request->lokasi;
            $data->kategori = $request->kategori;
            $data->cp = $request->cp;
            $data->maksimal = $request->maksimal;
            $data->tanggal = $request->tanggal;
            $bulan = null;
            if ($request->bulan == "januari") {
                $bulan = 1;
            } else if ($request->bulan == "februari") {
                $bulan = 2;
            } else if ($request->bulan == "maret") {
                $bulan = 3;
            } else if ($request->bulan == "april") {
                $bulan = 4;
            } else if ($request->bulan == "mei") {
                $bulan = 5;
            } else if ($request->bulan == "juni") {
                $bulan = 6;
            } else if ($request->bulan == "juli") {
                $bulan = 7;
            } else if ($request->bulan == "agustus") {
                $bulan = 8;
            } else if ($request->bulan == "september") {
                $bulan = 9;
            } else if ($request->bulan == "oktober") {
                $bulan = 10;
            } else if ($request->bulan == "november") {
                $bulan = 11;
            } else if ($request->bulan == "desember") {
                $bulan = 12;
            }
            $data->bulan = $bulan;
            $data->tahun = $request->tahun;
            $data->id_panitia = Session::get('id_panitia');
            $tipe = -1;
            if ($request->status == "gratis") {
                $tipe = 0;
            } else {
                $tipe = 1;
            }
            $data->status = $tipe;
            $data->harga = $request->harga;
            $data->save();
            return redirect()->route('index')->with('alert-success', 'Berhasil buat acara');
        } else {
            return redirect()->back()->with('alert', 'Masukkan foto acara anda terlebih dahulu!')->withInput();
        }
    }

    function lihatKumpulanAcara()
    {
        $panitia = Panitia::where('id', Session::get('id_panitia'))->first();
        $acaras = Acara::where('id_panitia', $panitia->id)->get();
        if($panitia){
        return view('halamanPanitia.kumpulanAcara', compact('panitia', 'acaras'));
        }else{
            abort(404);
        }
    }

    function editAcara(AcaraRequest $request, $id_acara)
    {
        if ($request['files'] != null) {
            $tipe = -1;
            if ($request->status == "gratis") {
                $tipe = 0;
            } else {
                $tipe = 1;
            }
            $dataAcara = Acara::where('id_panitia', Session::get('id_panitia'))->where('id', $id_acara)->update([
                'foto_acara' => implode(" ", $request['files']),
                'nama_acara' => $request->nama_acara, 'deskripsi' => $request->deskripsi, 'kota' => $request->kota, 'lokasi' => $request->lokasi,
                'kategori' => $request->kategori, 'cp' => $request->cp, 'maksimal' => $request->maksimal, 'status' => $tipe, 'harga' => $request->harga
            ]);
            return redirect()->route('index')->with('alert-success', 'Acara berhasil di ubah');
        } else {
            return redirect()->back()->with('alert', 'Masukkan foto terbaru acara anda terlebih dahulu!')->withInput();
        }
    }

    function hapusAcara($id_acara)
    {
        $acara = Acara::find($id_acara);
        if ($acara) {
            $acara = Acara::where('id', $id_acara)->delete();
            return redirect()->route('index')->with('alert-success', 'Acara telah dihapus');
        } else {
            abort(404);
        }
    }

    function lihatDataPembeli($id_acara)
    {
        $pesans = Pesan::where('id_acara', $id_acara)->get();
        if ($pesans) {
            return view('halamanPanitia.lihatDataPembeli', compact('pesans'));
        } else {
            abort(404);
        }
    }

    function deteksiKodeAcara(Request $request)
    {
        try {
            if (strlen($request->kode_pesanan) == 6) {
                $kode_pesanan = $request->kode_pesanan;
            } else if ($request->kode_pesanan) {
                $kode_pesanan = decrypt($request->kode_pesanan);
            } else {
                return redirect()->back()->with('alert', 'kode_pesanan atau password tidak boleh dikosongi');
            }

            if ($kode_pesanan) {
                $pesan = Pesan::where('kode_pesanan', $kode_pesanan)->first();


                if ($pesan) {
                    $cek = Peserta::where('id_pesan', $pesan->id)->first();
                    if (!$cek) {
                        $pesan->status = 2;
                        $pesan->save();
                        $peserta = new Peserta;
                        $peserta->id_acara = $pesan->id_acara;
                        $peserta->id_member = $pesan->id_member;
                        $peserta->id_pesan = $pesan->id;
                        $peserta->save();
                        $berhasil = 'Absensi peserta dengan kode ' . $kode_pesanan . ' berhasil dimasukkan';
                        return redirect()->back()->with('alert-success', $berhasil);
                    } else {
                        $kata = 'Maaf peserta dengan kode ' . $kode_pesanan . ' sudah terdaftar';
                        return redirect()->back()->with('alert', $kata);
                    }
                } else {
                    return redirect()->route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')->with('alert', 'peserta tidak ditemukan');
                }
            } else {
                throw new DecryptException;
            }
        } catch (DecryptException $e) {
            return redirect()->route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')->with('alert-success', 'Kesalahan input atau kode QR');
        } catch (Exception $e) {
            return redirect()->route('tamu.user.panitia.verif.lihat-halaman-scan-barcode')->with('alert', 'Kesalahan pengolahan data');
        }
    }

    function lihatHalamanTambahAcara()
    {
        return view('halamanPanitia.tambahAcara');
    }

    function lihatHalamanEditAcara($id_acara)
    {
        $dataAcara = Acara::where('id', $id_acara)->where('id_panitia', Session::get('id_panitia'))->first();
        $dataPanitia = Panitia::find($dataAcara->id_panitia);
        if ($dataAcara && $dataPanitia) {
            return view('halamanPanitia.ubahAcara',  compact('dataAcara', 'dataPanitia'));
        } else {
            abort(500);
        }
    }

    function lihatHalamanDeteksiKode()
    {
        return view('halamanPanitia.inputKodeAcara');
    }
}
