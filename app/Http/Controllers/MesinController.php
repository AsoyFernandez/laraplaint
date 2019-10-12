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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesin $mesin)
    {
        //
    }
}
