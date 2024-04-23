<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']]))
        {
            $user = auth()->user();
            switch ($user->type)
            {
                case 'admin':
                    return redirect()->route('admin.home');
                case 'superadmin':
                    return redirect()->route('superadmin.home');
                case 'dosen':
                    return redirect()->route('dosen.home');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.home');
                case 'tendik':
                    return redirect()->route('tendik.home');
                case 'akademik':
                    return redirect()->route('akademik.home');
                case 'keuangan':
                    return redirect()->route('keuangan.home');
                case 'direktur':
                    return redirect()->route('direktur.home');
                case 'wd1':
                    return redirect()->route('wd1.home');
                case 'wd2':
                    return redirect()->route('wd2.home');
                case 'wd3':
                    return redirect()->route('wd3.home');
                case 'lppm':
                    return redirect()->route('lppm.home');
                case 'sdm':
                    return redirect()->route('sdm.home');
                default:
                    return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email address and password are incorrect.');
        }
    }
}
