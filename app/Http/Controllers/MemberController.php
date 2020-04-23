<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;
use App\Member;
use App\Panitia;
use App\Acara;
use App\Pesan;
use App\Komentar;
use App\Http\Requests\PanitiaRequest;


class MemberController extends Controller
{
    public function logout()
    {
        Session::flush();
        return redirect()->route('index')->with('alert', 'Anda telah keluar');
    }

    public function lihatAkun()
    {
        $akun = Member::where('username', Session::get('username'))->first();

        $pesans = Pesan::where('id_member', $akun->id)->get();
        $acaras = array();
        for ($i = 0; $i < count($pesans); $i++) {
            $acaras[$i] = Acara::where('id', $pesans[$i]->id_acara)->first();
        }
        $panitias = array();
        for ($i = 0; $i < count($pesans); $i++) {
            $panitias[$i] = Panitia::where('id', $acaras[$i]->id_panitia)->first();
        }
        return view('informasiAkun.informasiAkunProfil', compact('akun','pesans','acaras','panitias'));
    }

    public function lihatDetailAcara($id_acara)
    {
        $acara = Acara::find($id_acara);
        $pesan = Pesan::where('id_acara',$acara->id)->first();
        if ($acara) {
            $panitia = Panitia::find($acara->id_panitia);
            return view('informasiAkun.lihatDetailAcara',compact('acara', 'panitia','pesan'));
        } else {
            abort(404);
        }
    }

    public function cariAcara(Request $request)
    {
        $acaras = Acara::where('nama_acara', 'like', '%' . $request->input('keyword') . '%');
        $acaras = $acaras->get();
        if ($acaras) {

            $panitia = array();
            for ($i = 0; $i < count($acaras); $i++) {
                $panitia[$i] = Panitia::where('id', $acaras[$i]->id_panitia)->first();
            }
            $key = $request->input('keyword');
            return view('cari', compact('acaras', 'key', 'panitia'));
        } else {
            abort(404);
        }
    }

    public function daftarPanitia(PanitiaRequest $request)
    {
        if ($request['files'] != null) {
            $filename = explode('.', $request->foto->getClientOriginalName());
            $fileExt = end($filename);
            $id = $this->generateIdGambar();
            $filename = $id . '.' . $fileExt;
            $path = $request->foto->storeAs('image/profile', $filename, 'public_uploads');

            $data = new Panitia();
            $data->foto = $path;
            $data->url_image = implode(" ", $request['files']);
            $data->nama_panitia = $request->nama_panitia;
            $data->alamat = $request->alamat;
            $data->nohp = $request->nohp;
            $data->id_member = Session::get('id_member');
            $data->status = 0;
            $data->save();
            Session::put('nama_panitia', $data->nama_panitia);
            Session::put('id_panitia', $data->id);
            Session::put('id_user', $data->id_member);
            Session::put('foto_panitia', $data->foto);
            return redirect()->route('index')->with('alert-success', 'Berhasil mendaftar panitia');
        } else {
            return redirect()->back()->with('alert', 'Anda wajib memberikan foto Portofolio kepada pihak EventOn!')->withInput();
        }
    }

    public function generateIdGambar()
    {
        $char = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
        $id = "";
        for ($i = 0; $i < 6; $i++) {
            $id = $id . $char[rand(0, 15)];
        }
        return $id;
    }

    public function lihatHalamanBeranda()
    {
        $items = Acara::all();
        $panitias = array();
        for ($i = 0; $i < count($items); $i++) {
            $panitias[$i] = Panitia::where('id', $items[$i]->id_panitia)->first();
        }
        return view('home', compact('items', 'panitias'));
    }

    public function lihatSemuaAcara()
    {
        $acaras = Acara::all();
        $panitia = array();
        for ($i = 0; $i < count($acaras); $i++) {
            $panitia[$i] = Panitia::find($acaras[$i]->id_panitia);
        }
        $key = 'semua';
        return view('cari', compact('acaras', 'panitia', 'key'));
    }

    public function cariAcaraKategori(Request $request)
    {
        $acaras = null;
        if ($request->input('kategori') != "semua") {
            $acaras = Acara::where('kategori', $request->input('kategori'));
        } else {
            $acaras = Acara::where('id', '>=', '1');
        }
        if ($request->input('max') != null) {
            $acaras->where('harga', '<=', $request->input('max'));
        }
        if ($request->input('min') != null) {
            $acaras->where('harga', '>=', $request->input('min'));
        }
        $acaras = $acaras->get();
        $key =  $request->input('kategori');
        $panitia = array();
        for ($i = 0; $i < count($acaras); $i++) {
            $panitia[$i] = Panitia::where('id', $acaras[$i]->id_panitia)->first();
        }
        return view('cari', compact('acaras', 'panitia', 'key'));
    }

    public function lihatHalamanDaftarPanitia()
    {
        return view('daftarPanitia');
    }
    public function lihatHalamanPesanan()
    {
        $akun = Member::where('username', Session::get('username'))->first();

        $pesans = Pesan::where('id_member', $akun->id)->get();
        $acaras = array();
        for ($i = 0; $i < count($pesans); $i++) {
            $acaras[$i] = Acara::where('id', $pesans[$i]->id_acara)->first();
        }
        $panitias = array();
        for ($i = 0; $i < count($pesans); $i++) {
            $panitias[$i] = Panitia::where('id', $acaras[$i]->id_panitia)->first();
        }
        return view('informasiAkun.informasiAkunRiwayat', compact('akun', 'pesans', 'acaras', 'panitias'));
    }

}
