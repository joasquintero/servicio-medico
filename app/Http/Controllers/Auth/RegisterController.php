<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'names' => 'required|string|max:255',
            'family_names' => 'required|string|max:255',
            'id_number' => 'required|string|max:12|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    
    protected function create(array $data)
    {
        $pending_role = Role::where('slug', 'pending')->first();
        // $patient_perm = Permission::where('slug','view-tasks')->first();
        $user = User::create([
            'names' => $data['names'],
            'family_names' => $data['family_names'],
            'id_number' => $data['id_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach($pending_role);
        // $user->permissions()->attach($patient_perm);
        return $user;
    }

}
