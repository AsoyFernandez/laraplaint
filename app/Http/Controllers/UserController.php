<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\User;
use App\Role;
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
        $role = Role::all();
        return view('user.create', compact('role'));
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
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('user.edit', compact('user', 'role'));
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
        $user = User::findOrFail($id);
        $user->update($request->all());
        if ($request->has('password')) {
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
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
