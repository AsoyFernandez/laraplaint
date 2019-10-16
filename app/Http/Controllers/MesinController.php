<?php

namespace App\Http\Controllers;

use App\Mesin;
use Illuminate\Http\Request;
use App\Kategori;
class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesin = Mesin::all();
        return view('mesin.index', compact('mesin'));
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $mesins = Mesin::where("nama", "LIKE", "%$keyword%")->get();
        return $mesins;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('mesin.create', compact('kategori'));
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
            'kategori_id' => 'required|exists:kategoris,id',
            'nama'=>'required|unique:lokasis',
        ]);

        $mesin = Mesin::create($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $mesin->nama"
        // ]);
        alert()->success("Berhasil menyimpan data $mesin->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('mesin.index');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function show(Mesin $mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesin $mesin)
    {
        $kategori = Kategori::all();
        return view('mesin.edit', compact('mesin', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesin $mesin)
    {
        $mesin->update($request->all());
        alert()->success("Berhasil mengubah data $mesin->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('mesin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesin $mesin)
    {
        $mesin->delete();
        alert()->success("Berhasil menghapus data mesin", 'Sukses!')->autoclose(2500);
        return redirect()->route('mesin.index');
    }
}
