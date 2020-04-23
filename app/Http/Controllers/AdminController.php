<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Member;
use App\Pesan;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function lihatHalamanKonfirmasiPendaftaran()
    {
        $panitias = Panitia::where('status', 0)->get();
        $pesans = Pesan::where('status', 0)->get();
        $users = array();
        for ($i = 0; $i < count($panitias); $i++) {
            $users[$i] = Member::find($panitias[$i]->id_member);
        }
        return view('halamanAdmin.halamanAdminPanitia', compact('panitias', 'pesans', 'users'));
    }

    public function kelolaPanitia(Request $request)
    {
        $dataPanitia = Panitia::find($request->input('id'));
        if ($dataPanitia) {
            if ($request->input('status') == 1) {
                $dataPanitia->status = 1;
                $dataPanitia->save();
                return redirect()->back()->with('alert-success', 'Berhasil menerima panitia');
            } else if ($request->input('status') == -1) {
                $dataPanitia->delete();
                return redirect()->back()->with('alert', 'Berhasil menolak panitia');
            }
        } else {
            abort(404);
        }
    }

    public function lihatHalamanKonfirmasiPembayaran()
    {
        $panitias = Panitia::where('status', 0)->get();
        $pesans = Pesan::where('status', 0)->get();
        $users = array();
        for ($i = 0; $i < count($panitias); $i++) {
            $users[$i] = Member::find($panitias[$i]->id_member);
        }
        return view('halamanAdmin.halamanAdminTransfer', compact('panitias', 'pesans', 'users'));
    }

    public function kelolaPembayaran(Request $request)
    {
        $dataPesan = Pesan::find($request->input('id'));
        if ($dataPesan) {
            if ($request->input('status') == 1) {
                if ($dataPesan) {
                    $dataPesan->status = 1;
                    $dataPesan->kode_pesanan = rand(100000, 999999);
                    $dataPesan->save();
                    return redirect()->back()->with('alert-success', 'Berhasil menyetujui transfer');
                }
            } else if ($request->input('status') == -1) {
                $dataPesan->status = -1;
                $dataPesan->save();
                return redirect()->back()->with('alert-success', 'Berhasil menolak transfer');
            }
        } else {
            abort(404);
        }
    }
}
