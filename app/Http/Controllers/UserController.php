<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\User;
use App\Role;
use App\Lokasi;
use Excel;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Auth;
use Notification;
use App\Notifications\PengaduanNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateExcelTemplate(){
        $filename = "./template/user.xlsx";
        return response()->download($filename);
    
        // return Excel::download(new UserExport, 'user.xlsx');
    }

    public function importExcel(Request $request){
        //VALIDASI
        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('import')) {
            $file = $request->file('import'); //GET FILE
            Excel::import(new UserImport, $file); //IMPORT FILE 
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
        $user = User::all();
        $auth = Auth::user();
        $message = "Berhasil menyimpan data";
        $url = route('user.index');
        $notif = Notification::send($auth, new PengaduanNotification($user));
        $auth->notify(new PengaduanNotification($user));
        return view('user.index',compact('user', 'message', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasi = Lokasi::all();
        $role = Role::all();
        return view('user.create', compact('role', 'lokasi'));
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
            'name'=>'required|unique:users',
            'nik'=>'required|max:12',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required',
            
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($request->optradio) && $request->optradio == 0) {
                $user->lokasis()->sync(Lokasi::all());
        }
        if (isset($request->lokasi_id)) {
            for ($i=0; $i < count($request->lokasi_id); $i++) { 
                $user->lokasis()->attach(Lokasi::find($request->lokasi_id[$i]));
            }
        }
        $auth = User::find(1);
        $notif = Notification::send($auth, new PengaduanNotification($user));
        $auth->notify(new PengaduanNotification($user));
        dd($auth->notifications);
        alert()->success("Berhasil menyimpan data $user->name", 'Sukses!')->autoclose(2500);
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $user->name"
        // ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasi = Lokasi::all();
        $user = User::find($id);
        $lokasiUser = [];
        foreach($user->lokasis as $userCity)
        {
            $lokasiUser[] = $userCity->id;
        }
        return view('user.show', compact('user', 'lokasi', 'lokasiUser'));
    }

    public function ajax()
    {
        return Lokasi::all()->toJson();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $lokasiUserIds = [];
        // $user = User::find($id);
        // $lokasi = Lokasi::all();
        // foreach($user->lokasis as $lokasi)
        // {
        //     $lokasiUserIds[] = $lokasi->id;
        // }
        // echo "$lokasiUserIds";
        // dd('stop');        
        // $lokasi = Lokasi::all();
        // $user = User::findOrFail($id);
        $lokasiUser = [];
        $user = User::find($id);
        $lokasi = Lokasi::all();
        foreach($user->lokasis as $userCity)
        {
            $lokasiUser[] = $userCity->id;
        }      
        // foreach ($lokasi as $key) {
        //     in_array($key->id, $lokasiUser);
        // }
        //   dd($lokasiUser);
        $role = Role::all();
        return view('user.edit', compact('user', 'role', 'lokasi', 'lokasiUser'));
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
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
        $this->validate($request,[
            'name'=>'required',
            'nik'=>'required|max:12',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required',
            'optradio'=>'required',
            
        ]);
        $user = User::findOrFail($id);
        $user->update($request->except('lokasi_id'));
        if ($request->has('password')) {
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
        }
        // dd($request->all());

        if (isset($request->optradio) && $request->optradio == 0) {
                $user->lokasis()->sync(Lokasi::all());
        }
        if (isset($request->optradio) && $request->optradio == 1) {
        
        $user->lokasis()->sync($request->lokasi_id);
        }

        alert()->success("Berhasil mengubah data $user->name", 'Sukses!')->autoclose(2500);

        return redirect()->route('user.index');
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        if ($request->has('password')) {
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
        }

        alert()->success("Berhasil mengubah data diri", 'Sukses!')->autoclose(2500);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function storeLokasi(Request $request)
    {
        $user = User::find($request->user_id);
        $this->validate($request,[
            'user_id'=>'required',
            'optradio'=>'required',
        ]);

        if (isset($request->optradio) && $request->optradio == 0) {
                $user->lokasis()->sync(Lokasi::all());
        }
        if (isset($request->lokasi_id)) {
            for ($i=0; $i < count($request->lokasi_id); $i++) { 
                $user->lokasis()->attach(Lokasi::find($request->lokasi_id[$i]));
            }
        }

        alert()->success("Berhasil menyimpan data lokasi", 'Sukses!')->autoclose(2500);
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $user->name"
        // ]);
        return redirect()->route('user.show', $user);
    }

    public function deleteLokasi($user, $id)
    {
        $user = User::find($user);
        $lokasi = Lokasi::find($id);
        $user->lokasis()->detach($lokasi);
        return redirect()->route('user.show', $user);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        alert()->success("Berhasil menghapus data pengguna", 'Sukses!')->autoclose(2500);
        return redirect()->route('user.index');

    }
}
