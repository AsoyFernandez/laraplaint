<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\User;
use App\Role;
use App\Lokasi;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index',compact('user'));
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

        if (isset($request->lokasi_id)) {
            for ($i=0; $i < count($request->lokasi_id); $i++) { 
                $user->lokasis()->attach(Lokasi::find($request->lokasi_id[$i]));
            }
        }

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
            
        ]);
        $user = User::findOrFail($id);
        $user->update($request->except('lokasi_id'));
        if ($request->has('password')) {
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
        }
        // dd($request->all());

        $user->lokasis()->sync($request->lokasi_id);
        

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

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        alert()->success("Berhasil menghapus data pengguna", 'Sukses!')->autoclose(2500);
        return redirect()->route('user.index');

    }
}
