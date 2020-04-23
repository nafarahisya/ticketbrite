<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Member;
use App\Panitia;

class TamuController extends Controller
{
    public function lihatHalamanLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = Member::where('username', $username)->first();
        if ($user && Hash::check($password, $user->password)) {
            Session::put('id_member', $user->id);
            Session::put('username', $user->username);
            Session::put('email', $user->email);

            $dataPanitia = Panitia::where('id_member', $user->id)->first();

            if ($dataPanitia) {
                Session::put('nama_panitia', $dataPanitia->nama_panitia);
                Session::put('id_panitia', $dataPanitia->id);
                Session::put('id_user', $dataPanitia->id_member);
                Session::put('foto_panitia', $dataPanitia->foto);
            }
        } else {
            return redirect()->back()->with('alert', 'Informasi login salah');
        }
        return redirect()->route('index')->with('alert-success', 'Berhasil masuk ke sistem');
    }

    public function lihatHalamanRegistrasi()
    {
        return view('register');
    }

    public function registrasi(UserRequest $request)
    {
        $data = new Member();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        Session::put('id_member', $data->id);
        Session::put('username', $data->username);
        Session::put('email', $data->email);
        return redirect()->route('index')->with('alert-success', 'Berhasil mendaftar user');
    }
}
