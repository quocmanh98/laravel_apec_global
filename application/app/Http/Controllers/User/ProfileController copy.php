<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Degree;
use App\Models\Admin\Department;
use App\Models\Admin\District;
use App\Models\Admin\Level;
use App\Models\Admin\Marriages;
use App\Models\Admin\Nation;
use App\Models\Admin\Nationality;
use App\Models\Admin\Position;
use App\Models\Admin\Province;
use App\Models\Admin\Religion;
use App\Models\Admin\Specialize;
use App\Models\Admin\Typeofemployees;
use App\Models\Admin\Ward;


class ProfileController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * ProfileController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->authorize('profile.show');

        $user = auth()->user();
        $roles = Role::all();
        return view('profile.show', compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize('profile.update');
        $user = auth()->user();

        $marriages = Marriages::all();
        $districts = District::all();
        $wards = Ward::all();
        $provinces = Province::all();
        $nationality = Nationality::all();
        $religions = Religion::all();
        $roles = Role::all();
        $departments = Department::all();
        $nations = Nation::all();
        $positions = Position::all();
        $typeofemployees = Typeofemployees::all();
        $levels = Level::all();
        $degrees = Degree::all();
        $specializes = Specialize::all();
        $roles = Role::all();
        return view('profile.edit', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'nationality', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('profile.update');
        $id = auth()->id();
        $request->validate([
            'username' => 'required|unique:users,username,'. $id,
            'email' => 'required|unique:users,email,'. $id,
            'phone' => 'integer|unique:users,phone,'. $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'birthday' => 'required|date',
        ]);

        $this->user->where('id', $id)->update($request->except(['_token']));

        return back()->withInput($request->all())->withSuccess('User created successfully.⚡️');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        $this->authorize('profile.update');
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|max:50',
            'new_confirm_password' => 'same:new_password',
        ]);

        $this->user->where('id', auth()->id() )->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->withSuccess('Password Change successfull');
    }
}
