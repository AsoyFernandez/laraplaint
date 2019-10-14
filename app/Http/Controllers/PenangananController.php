<?php

namespace App\Http\Controllers;

use App\Penanganan;
use Illuminate\Http\Request;
use App\Pengaduan;
class PenangananController extends Controller
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
        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'pengaduan_id'=>'required|exists:pengaduans,id',
        ]);

        $pengaduan = Pengaduan::find($request->pengaduan_id);
        $pengaduan->update([
            'status' => 1,
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
        //
    }
}
