<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKontak;
use Session;

class Login extends Controller

{
    public function index()
    {
        return view('login');
    }
    public function cek(Request $req)
    {
        $this->validate($req,[
            'usr'=>'required',
            'pw'=>'required',
        ]);
        $proses=ModelKontak::where('username',$req->usr)->where('password',$req->pw)->first();
        if($proses){
            Session::put('id',$proses->id);
            Session::put('username',$proses->usr);
            Session::put('password',$proses->pw);
            Session::put('nama',$proses->nama);
            Session::put('hak_akses',$proses->hak_akses);
            Session::put('login_status',true);
            return redirect('/');
        } else {
            Session::flash('alert_pesan','Username dan password tidak cocok');
            return redirect('login');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
