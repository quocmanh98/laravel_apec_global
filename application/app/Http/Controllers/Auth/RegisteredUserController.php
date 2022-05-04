<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        if (option('auth.disableRegistration') == 'on') {
            return abort(404);
        }
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $employeeCode = 'MNV' . time();
        $request->validate([
            'fullname' => 'required|string|min:6|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'avatar' => 'required|image|mimes:png,jpg',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $fileavatar = $avatar->getClientOriginalName();
            $avatar->move('public/uploads',  $fileavatar);
            $avatar = "public/uploads/" .  $fileavatar;
        }

        Auth::login($user = User::create([
            'fullname' => $request->fullname,
            'code' =>  $employeeCode,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' =>  $avatar,
            'status' => 'active',
            'ApprovalStatus' => 1
        ]));

        event(new Registered($user));


        return redirect()->route('profile.index')->with('status', 'Bạn vui lòng cập nhật lại hồ sơ !');;
    }
}
