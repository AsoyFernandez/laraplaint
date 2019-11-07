<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use App\Mesin;
use App\Lokasi;
use File;
use Auth;
use App\Mail\PengaduanEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;
use App\User;
use PDF;
use Excel;
use App\Exports\PengaduanExport;
class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateExcelTemplate(){
        return Excel::download(new PengaduanExport, 'invoices.xlsx');
    }

    public function importExcel(Request $request){
        $excel = $request->file('excel');
        $excels = Excel::load($excel, function($reader) {
        // options, jika ada
        })->get();
        $num = 1;
        foreach (array_slice($excels, $num) as $row) {
        
        $book = Pengaduan::create([
        'no_pengaduan' => $row['no_pengaduan'],
        'mesin_id' => $row['mesin_id'],
        'lokasi_id' => $row['lokasi_id'],
        'user_id' => $row['user_id'],
        'foto' => $row['foto'],
        'status' => $row['status'],
        'keterangan' => $row['keterangan'],
        
        ]);
        }

        
    }

    public function index()
    {
        $pengaduan = Pengaduan::all();
        // if ($request->all() == '[]') {
        //     $pengaduan = $pengaduan;
        // }elseif ($request->all() != '[]') {
        //     # code...
        //     $pengaduan = Pengaduan::whereBetween('created_at', [$request->min, $request->max])->get();
        // }
        $lokasiUser = [];
        foreach (Auth::user()->lokasis as $key) {
            $lokasiUser[] = $key->id;
        }

        if (Auth::user()->role->id == 2) {
            $pengaduan = Pengaduan::where('user_id', Auth::id())->get();
        }
        return view('pengaduan.index', compact('pengaduan', 'lokasiUser'));
    }

    public function filter(Request $request){

        $pengaduan = Pengaduan::whereBetween('created_at', [$request->min, $request->max])->get();

        $lokasiUser = [];
        foreach (Auth::user()->lokasis as $key) {
            $lokasiUser[] = $key->id;
        }

        if (Auth::user()->role->id == 2) {
            $pengaduan = Pengaduan::where('user_id', Auth::id())->get();
        }
        $min = $request->min;
        $max = $request->max;
        return view('pengaduan.index', compact('pengaduan', 'lokasiUser', 'min', 'max'));

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

    public function autoCreate($lokasi, $mesin)
    {
        $lokasi = Lokasi::find($lokasi);
        $mesin = Mesin::find($mesin);
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
        $lokasi = Lokasi::find($request->lokasi_id);
        $mesin = Mesin::find($request->mesin_id);
        $user = User::find($request->user_id);     


        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'lokasi_id'=>'required|exists:lokasis,id',
            'mesin_id'=>'required|exists:mesins,id',
            'foto'=> 'required|max:1024',
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
        if ($user->role_id != 2) {
            $pengaduan->status = 1;
        }
        $data = [
            'lokasi' => $lokasi->nama,
            'mesin' => $mesin->nama,
            'user' => $user->name,
            'keterangan' => $request->keterangan,
            'no' => $no_pengaduan,
        ];
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
            // mengisi field cover di pengaduan dengan filename yang baru dibuat
                $pengaduan->foto = $filename;
                

                $pengaduan->save();
            }
            ;
               
            // kirim email
            if ($lokasi->users != "[]") {
                foreach ($lokasi->users->where('role_id', '!=', 2) as $log) {
                    
                    if ($log->id != $request->user_id) {
                        
                    $emailJob = Mail::to($log->email)->queue(new PengaduanEmail($data));
                    }
                    
                }
            }
            return redirect()->route('pengaduan.index');
            // try{
            //     Mail::send('email', ['lokasi' => $lokasi, 'mesin' => $mesin, 'keterangan' => $request->keterangan], function ($message) use ($request)
            //     {
            //         $message->subject('Pengaduan Kerusakan Mesin');
            //         $message->from('laraplaint@gmail.com', 'Admin Laraplaint');
            //         $message->to('esarizki15@gmail.com');
            //     });
            //     return back()->with('alert-success','Berhasil Kirim Email');
            // }
            // catch (Exception $e){
            //     return response (['status' => false,'errors' => $e->getMessage()]);
            // }

            // alert()->success("Berhasil mengirim pengaduan", 'Sukses!')->autoclose(2500);
            // return redirect()->route('pengaduan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show',compact('pengaduan'));
    }

    public function printAll($awal, $akhir){
        $pengaduan = Pengaduan::whereBetween('created_at', [$awal, $akhir])->get();
        // return view('pengaduan.printAll', compact('pengaduan'));
        $pdf = PDF::loadView('pengaduan.printAll', compact('pengaduan'));
        return $pdf->stream('unduh.pdf');
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
        $pengaduan->update($request->except('foto'));
        if ($request->hasFile('foto')) {
        // menambil foto yang diupload berikut ekstensinya
        $filename = null;
        $uploaded_foto = $request->file('foto');
        $extension = $uploaded_foto->getClientOriginalExtension();
        // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        // memindahkan file ke folder public/img
        $uploaded_foto->move($destinationPath, $filename);
        // hapus foto lama, jika ada
        if ($pengaduan->foto) {
        $old_foto = $pengaduan->foto;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $pengaduan->foto;
        try {
        File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }
        }
        $pengaduan->foto = $filename;
        $pengaduan->save();
        }

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
        if ($pengaduan->foto) {
        $old_foto = $pengaduan->foto;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $pengaduan->foto;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
        // File sudah dihapus/tidak ada
        }
        }
        $pengaduan->delete();
        alert()->success("Berhasil menghapus data pengaduan", 'Sukses!')->autoclose(2500);
        return redirect()->route('pengaduan.index');
    }
}
