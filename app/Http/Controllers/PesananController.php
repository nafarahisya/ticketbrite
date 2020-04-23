<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Member;
use App\Panitia;
use App\Acara;
use App\Pesan;

class PesananController extends Controller
{
    function pesanTiket(Request $request)
    {
        $acara = Acara::find($request->input('id_acara'));
        if ($acara->sisa_kuota > 0) {
            $data = new Pesan();
            $data->nama = $request->nama;
            $data->nohp = $request->nohp;
            $data->alamat = $request->alamat;
            $data->email = $request->email;
            $data->id_member = Session::get('id_member');
            $data->id_acara = $request->input('id_acara');
            $data->save();
            $kode_unik = rand(100, 999);
            $jumlah = $acara->harga + $kode_unik;
            if ($this->cekStatus($request->input('id_acara'))) {
                $pesan = Pesan::where('id', $data->id)->update(['kode_pesanan' => rand(100000, 999999), 'jumlah' => 0, 'kode_unik' => 0, 'status' => 1]);
                return redirect()->route('index')->with('alert-success', 'pemesanan berhasil, silahkan cek histori untuk melihat kode tiket anda');
            } else {
                $pesan = Pesan::where('id', $data->id)->update(['jumlah' => $jumlah, 'kode_unik' => $kode_unik]);
                return redirect()->route('tamu.user.lihat-halaman-konfirmasi-transfer', ['id_pesan' => $data->id]);
            }
        } else {
            return redirect()->route('index')->with('alert', 'maaf kuota acara sudah penuh');
        }
    }

    function lihatHalamanPesanTiket($id_acara)
    {
        $acara = Acara::where('id', $id_acara)->first();
        $panitia = Panitia::where('id', $acara->id_panitia)->first();
        if ($acara && $panitia) {
            return view('pesanTiket', compact('acara', 'panitia'));
        } else {
            abort(404);
        }
    }

    function cekStatus($id_acara)
    {
        $acara = Acara::find($id_acara);
        $cek = false;
        if ($acara->status == 0) {
            $cek = true;
        }
        return $cek;
    }

    function lihatHalamanKonfirmasiTransfer($id_pesan)
    {
        $pesan = Pesan::find($id_pesan);
        $acara = Acara::find($pesan->id_acara);
        $panitia = Panitia::find($acara->id_panitia);
        if ($acara && $panitia) {
            return view('periksaPesanan', compact('pesan', 'acara', 'panitia'));
        } else {
            abort(404);
        }
    }

    function updateKonfirmasiTransfer(Request $request)
    {
        $data = Pesan::find($request->input('id_pesan'));
        $data->nomor_rekening = $request->nomor_rekening;
        $data->bank_pengirim = $request->bank_pengirim;
        $data->bank_tujuan = $request->bank_tujuan;
        $data->save();
        return redirect()->route('tamu.user.lihat-halaman-upload-bukti-konfirmasi', ['id_pesan' => $data->id]);
    }

    function uploadBuktiKonfirmasiTransfer(Request $request, $id_pesan)
    {
        $data = Pesan::find($id_pesan);
        if ($data) {
            $data->gambar_konfirmasi =  $request->gambarbukti;
            $data->save();
            return redirect()->route('index')->with('alert-success', 'Permohonan konfirmasi telah dikirim');
        } else {
            abort(404);
        }
    }

    function halamanUploadBuktiKonfirmasi($id_pesan)
    {
        $pesan = Pesan::find($id_pesan);
        $acara = Acara::find($pesan->id_acara);
        if ($acara && $pesan) {
            return view('instruksiPembayaran', compact('acara', 'pesan'));
        } else {
            abort(404);
        }
    }
}
