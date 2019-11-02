<?php

namespace App\Http\Controllers;

use App\Konfirmasi;
use App\Pengaduan;
use Illuminate\Http\Request;
use Mail;
use App\Lokasi;
use App\User;
class KonfirmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $pengaduan = Pengaduan::find($request->pengaduan_id);
        $lokasi = Lokasi::find($pengaduan->lokasi_id);
        $user = User::find($request->user_id);
        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'pengaduan_id'=>'required|exists:pengaduans,id',
            'status'=>'required',
        ]);

        $konfirmasi = Konfirmasi::create($request->except('status'));
        $status = 'ditolak';
        if ($request->status == 1) {
            $status = 'disetujui';
        }
        $data = [
            'user'=>$user->name,
            'status' =>$status,
        ];
        if ($request->status == 0) {
            // kirim email
            if ($lokasi->users != "[]") {
                foreach ($lokasi->users as $log) {
                    
                    //Broadcast ke selain outlet leader dan selain yang konfirm
                    if ($log->role_id != 2 or $log->id != $request->user_id) {
                    
                        Mail::send('email.konfirmasi', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                        $m->to($log->email)->subject('Konfirmasi Pengaduan AS');
                        });    
                    //broadcast ke pembuat pengaduan
                    }elseif ($log->id == $pengaduan->user_id) {
                        Mail::send('email.konfirmasi', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                            $m->to($log->email)->subject('Konfirmasi Pengaduan AS');
                        });
                    }
                    
                }
            }
            //
            $pengaduan->update([
                'status'=> '-1',
            ]);

        }elseif ($request->status == 1) {
            // kirim email
            if ($lokasi->users != "[]") {
                foreach ($lokasi->users as $log) {
                    
                    //Broadcast ke selain outlet leader dan selain yang konfirm
                    if ($log->role_id != 2 && $log->id != $request->user_id) {
                    
                        Mail::send('email.konfirmasi', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                        $m->to($log->email)->subject('Konfirmasi Pengaduan AS');
                        });    
                    //broadcast ke pembuat pengaduan
                    }elseif ($log->id == $pengaduan->user_id) {
                        Mail::send('email.konfirmasi', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                        $m->to($log->email)->subject('Konfirmasi Pengaduan AS');
                        });
                    }
                    
                }
            }
            //

            $pengaduan->update([
                'status'=> 1,
            ]);
        }
        return redirect()->route('pengaduan.index');
        // dd($pengaduan->status == 0);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konfirmasi  $konfirmasi
     * @return \Illuminate\Http\Response
     */
    public function show(Konfirmasi $konfirmasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konfirmasi  $konfirmasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Konfirmasi $konfirmasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konfirmasi  $konfirmasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konfirmasi $konfirmasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konfirmasi  $konfirmasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konfirmasi $konfirmasi)
    {
        //
    }
}
