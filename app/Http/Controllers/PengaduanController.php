<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use App\Mesin;
use App\Lokasi;
use File;
class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mesin = Mesin::all();
        $lokasi = Lokasi::all();
        return view('pengaduan.create', compact('mesin', 'lokasi'));
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
            'lokasi_id'=>'required|exists:lokasis,id',
            'mesin_id'=>'required|exists:mesins,id',
            'foto'=> 'required|max:5120',
        ]);
        
        $count = count(Pengaduan::all()) + 1;
        $car = \Carbon\Carbon::now();
        $bulan = "I";
        $tahun = substr($car->year, -2);
        if ($car->month == 1) {
            $bulan = $bulan;
        }elseif ($car->month == 2) {
            $bulan = "II";
        }elseif ($car->month == 3) {
            $bulan = "III";
        }elseif ($car->month == 4) {
            $bulan = "IV";
        }elseif ($car->month == 5) {
            $bulan = "V";
        }elseif ($car->month == 6) {
            $bulan = "VI";
        }elseif ($car->month == 7) {
            $bulan = "VII";
        }elseif ($car->month == 8) {
            $bulan = "VIII";
        }elseif ($car->month == 9) {
            $bulan = "IX";
        }elseif ($car->month == 10) {
            $bulan = "X";
        }elseif ($car->month == 11) {
            $bulan = "XI";
        }elseif ($car->month == 12) {
            $bulan = "XII";
        }
        $no_pengaduan = "LP-$count/SKJ/$bulan/$tahun";
        // dd($request->all());
        $pengaduan = Pengaduan::create($request->except('foto'));
        $pengaduan->no_pengaduan = $no_pengaduan;
        // isi field cover jika ada cover yang diupload
            if ($request->hasFile('foto')) {

            // Mengambil file yang diupload
                $uploaded_foto = $request->file('foto');

            // mengambil extension file
                $extension = $uploaded_foto->getClientOriginalExtension();

            // membuat nama file random berikut extension
                $filename = md5(time()) . '.' . $extension;
                
            // menyimpan cover ke folder public/img
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                $uploaded_foto->move($destinationPath, $filename);
            // mengisi field cover di barang dengan filename yang baru dibuat
                $pengaduan->foto = $filename;
                

                $pengaduan->save();
            }
            ;

            alert()->success("Berhasil mengirim pengaduan", 'Sukses!')->autoclose(2500);
            return redirect()->route('pengaduan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        $mesin = Mesin::all();
        $lokasi = Lokasi::all();
        return view('pengaduan.edit', compact('pengaduan', 'mesin', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->update($request->all());
        alert()->success("Berhasil mengubah data pengaduan", 'Sukses!')->autoclose(2500);

        return redirect()->route('pengaduan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        alert()->success("Berhasil menghapus data pengaduan", 'Sukses!')->autoclose(2500);
        return redirect()->route('pengaduan.index');
    }
}
