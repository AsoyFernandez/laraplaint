<?php

namespace App\Http\Controllers;

use App\Riwayat;
use Illuminate\Http\Request;
use App\Penanganan;
use App\Pengaduan;
use File;
use App\User;
use App\Lokasi;
use PDF;
use Mail;
class RiwayatController extends Controller
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
    public function create($id)
    {
        $log = Pengaduan::find($id);
        return view('riwayat.create', compact('log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penanganan = Penanganan::find($request->penanganan_id);
        $pengaduan = Pengaduan::find($penanganan->pengaduan_id);
        $lokasi = Lokasi::find($pengaduan->lokasi_id);
        $user = User::find($pengaduan->user_id);
        $teknisi = User::find($penanganan->user_id);
        $url = route('pengaduan.show', $pengaduan);
        // dd($url);
        $status = 'Masih dalam penanganan';
        if ($request->status == 1) {
            $status = 'Selesai';   
        }elseif ($request->status == 2) {
            $status = 'Ditarik ke HO';
        }
        $data = [
            'teknisi'=>$teknisi->name,
            'status'=>$status,
            'url'=>$url,
        ];
        // kirim email
            if ($lokasi->users != "[]") {
                foreach ($lokasi->users as $log) {
                    
                    //Broadcast ke selain outlet leader, selain teknisi, dan selain yang konfirm
                    if ($log->role_id != 2 or $log->role_id != 3 or $log->id != $request->user_id) {
                    
                        Mail::send('email.buktiPenanganan', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                        $m->to($log->email)->subject('Bukti Penanganan Teknisi');
                        });    
                    //broadcast ke pembuat pengaduan
                    }elseif ($log->id == $pengaduan->user_id) {
                        Mail::send('email.buktiPenanganan', compact('pengaduan', 'data'), function ($m) use ($log
                        ) {
                            $m->to($log->email)->subject('Bukti Penanganan Teknisi');
                        });
                    }
                    
                }
            }
            //
        $this->validate($request,[
            'penanganan_id'=>'required|exists:penanganans,id',
            'status'=>'required',
            'keterangan' => 'required',
            'foto'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $riwayat = Riwayat::create($request->except('foto'));

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
            // mengisi field cover di riwayat dengan filename yang baru dibuat
                $riwayat->foto = $filename;
                

                $riwayat->save();
            }
            if ($request->status == 1) {
                $penanganan->pengaduan->update([
                    'status'=>3,
                ]);
            }elseif ($request->status == 2) {
                $penanganan->pengaduan->update([
                    'status'=>4,
                ]);
            }
            alert()->success("Berhasil mengirim pengaduan", 'Sukses!')->autoclose(2500);
            return redirect()->route('penanganan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        // return view('riwayat.show', compact('pengaduan'));

        $pdf = PDF::loadView('riwayat.show', compact('pengaduan'));
        return $pdf->stream('unduh.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan, Riwayat $riwayat)
    {
        return view('riwayat.edit', compact('pengaduan', 'riwayat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan, Riwayat $riwayat)
    {
        $riwayat->update($request->except('foto'));
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
        if ($riwayat->foto) {
        $old_foto = $riwayat->foto;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $riwayat->foto;
        try {
        File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }
        }
        $riwayat->foto = $filename;
        $riwayat->save();
        }

        if ($request->status == 1) {
                $penanganan->pengaduan->update([
                    'status'=>3,
                ]);
            }elseif ($request->status == 2) {
                $penanganan->pengaduan->update([
                    'status'=>4,
                ]);
            }elseif ($request->status == 0) {
                $penanganan->pengaduan->update([
                    'status'=>2,
                ]);
            }

        alert()->success("Berhasil mengubah data pengaduan", 'Sukses!')->autoclose(2500);

        return redirect()->route('penanganan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {   
        $pengaduan = Pengaduan::find($riwayat->penanganan->pengaduan_id);
        
        if ($riwayat->status == 1) {
            $riwayat->penanganan->pengaduan->update([
                'status'=> 2,
            ]);
        }
        if ($riwayat->foto) {
        $old_foto = $riwayat->foto;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $riwayat->foto;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
        // File sudah dihapus/tidak ada
        }
        }
        $riwayat->delete();
        alert()->success("Berhasil menghapus data riwayat", 'Sukses!')->autoclose(2500);
        return redirect()->route('pengaduan.show', $pengaduan);

    }
}
