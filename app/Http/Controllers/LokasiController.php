<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;
use Excel;
use App\Exports\LokasiExport;
use App\Imports\LokasisImport;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateExcelTemplate(){
        return Excel::download(new LokasiExport, 'lokasi.xlsx');
    }

    public function importExcel(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('import')) {
            $file = $request->file('import'); //GET FILE
            Excel::import(new LokasisImport, $file); //IMPORT FILE 
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs(
            //     'public', $filename
            // );
            // //MEMBUAT JOBS DENGAN MENGIRIMKAN PARAMETER FILENAME
            // ImportJob::dispatch($filename); 
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function index()
    {
        $lokasi = Lokasi::all();
        return view('lokasi.index', compact('lokasi'));
    }
    
    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $lokasi = Lokasi::where("nama", "LIKE", "%$keyword%")->get();
        return $lokasi;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lokasi.create');
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
            'nama'=>'required|unique:lokasis',
        ]);

        $lokasi = Lokasi::create($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $lokasi->nama"
        // ]);
        alert()->success("Berhasil menyimpan data $lokasi->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        return view ('lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $lokasi->update($request->all());
        alert()->success("Berhasil mengubah data $lokasi->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('lokasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        alert()->success("Berhasil menghapus data lokasi", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasi.index');
    }
}
