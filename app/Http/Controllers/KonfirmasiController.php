<?php

namespace App\Http\Controllers;

use App\Konfirmasi;
use App\Pengaduan;
use Illuminate\Http\Request;

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
        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'pengaduan_id'=>'required|exists:pengaduans,id',
            'status'=>'required',
        ]);

        $konfirmasi = Konfirmasi::create($request->except('status'));
        if ($request->status == 0) {
            $pengaduan->update([
                'status'=> '-1',
            ]);
        }elseif ($request->status == 1) {
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
