<?php

namespace App\Http\Controllers;

use App\Penanganan;
use Illuminate\Http\Request;
use App\Pengaduan;
use Auth;
use App\Lokasi;
use App\User;
use Mail;
class PenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penanganan = Penanganan::where('user_id', Auth::id())->get();
        return view('penanganan.index', compact('penanganan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'pengaduan_id'=>'required|exists:pengaduans,id',
        ]);

        $pengaduan = Pengaduan::find($request->pengaduan_id);
        $lokasi = Lokasi::find($pengaduan->lokasi_id);
        $user = User::find($request->user_id);
        $data = [
            'user'=>$user->name,
        ];
        if ($lokasi->users != "[]") {
                foreach ($lokasi->users as $log) {
                    
                    //Broadcast ke selain outlet leader dan selain yang konfirm
                    if ($log->role_id != 3 or $log->role_id != 2) {
                    
                        Mail::send('email.penanganan', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                        $m->to($log->email)->subject('Konfirmasi Teknisi');
                        });    
                    //broadcast ke pembuat pengaduan
                    }elseif ($log->id == $pengaduan->user_id) {
                        Mail::send('email.penanganan', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                            $m->to($log->email)->subject('Konfirmasi Teknisi');
                        });
                    }
                    
                }
            }

        $pengaduan->update([
            'status' => 2,
        ]);

        $penanganan = Penanganan::create($request->all());
        return redirect()->route('pengaduan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penanganan  $penanganan
     * @return \Illuminate\Http\Response
     */
    public function show(Penanganan $penanganan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penanganan  $penanganan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penanganan $penanganan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penanganan  $penanganan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penanganan $penanganan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penanganan  $penanganan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penanganan $penanganan)
    {
        $pengaduan = Pengaduan::find($penanganan->pengaduan_id);
        $pengaduan->update([
            'status' => 1,
        ]);
        $penanganan->delete();
        return redirect()->route('penanganan.index');
    }
}
