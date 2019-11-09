<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PengaduanEmail;
use Illuminate\Support\Facades\Mail;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function email(){
        Mail::to("testing@malasngoding.com")->send(new PengaduanEmail());
 
            return "Email telah dikirim";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
