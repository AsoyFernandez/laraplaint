<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesin;
use App\Lokasi;
class LokasiMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lokasi = Lokasi::find($id);
        $mesin = Mesin::all();
        return view('lokasiMesin.index', compact('lokasi', 'mesin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $lokasi = Lokasi::where("nama", "LIKE", "%$keyword%")->get();
        return $lokasi;
    }
    
    public function create($id)
    {
        $lokasi = Lokasi::find($id);
        $data = [];
        $mesin = Mesin::all();
        foreach ($lokasi->mesins as $key) {
            $data[] = $key->id;
        }
        return view('lokasiMesin.create', compact('mesin', 'lokasi', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $lokasi = Lokasi::find($id);
        $this->validate($request,[
            'mesin_id' => 'required|exists:mesins,id',
        ]);
        for ($i=0; $i < count($request->mesin_id); $i++) { 
            # code...
        $lokasi->mesins()->attach($request->mesin_id[$i]);
        }
        alert()->success("Berhasil menyimpan data", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasiMesin.index', $lokasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lokasi,$mesin)
    {
        $lokasi = Lokasi::find($lokasi);
        $mesin = Mesin::find($mesin);
        $lokasi->mesins()->detach($mesin);
        alert()->success("Berhasil menghapus data", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasiMesin.index', $lokasi);
    }
}
