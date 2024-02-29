<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        return view('home');
    }

    public function login()
    {
        $user = User::where('email', request('email'))->first();
        if(Hash::check(request('password'), $user->password)){
            auth()->loginUsingId($user->id);
            return redirect('home');
        }else{
            return redirect('login-unique-private');
        }
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->flush();
        return redirect(route('login'));
        // return view('auth.login.start-home-new', [ 'attendant_id' => Crypt::encrypt(Auth::user()->id), 'is_helpdesk' => ConfigsCompanyReleased::is_helpdesk(),]);
        // return view('home');
    }

    public function admin(Request $request)
    {
        return view('layouts.admin');
    }

    public function marlos()
    {
        return view('marlos');
    }

}
