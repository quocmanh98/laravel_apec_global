<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Mail\Error;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            $user = User::where('email', request()->email)->first();

            if ($user) {
                $role = Role::all();
                foreach ($role as $v) {
                    if ($v->id == $user->role_id) {
                        $roles_id = $request->session()->put('roles_id', $user->role_id);
                        $fullname =  $request->session()->put('full_name', $user->fullname);
                        $gmail =  $request->session()->put('email', $user->email);
                    }
                }
                if ($user->status_work == 2) {
                    $request->authenticate();
                    $request->session()->regenerate();
                    event(new LoggedIn());
                    return redirect()->intended(RouteServiceProvider::HOME);
                } elseif ($user->status_work == 1) {
                    $data = [
                        'email' =>  $user->email
                    ];
                    Mail::to($user->email)->send(new Error($data));
                    return redirect()->route('login')->with('status', 'Tài khoản của bạn đã bị khóa vĩnh viễn ! Xin vui lòng check mail để biết thêm chi tiết !');
                }
            } else {
                return redirect()->route('login')->with('status', 'Tài khoản của bạn tạm thời không truy cập được ! Xin vui lòng quay lại sau !');
            }
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        event(new LoggedOut(Auth::guard('web')->id()));

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
