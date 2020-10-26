<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {

        return Validator::make($data, [
            'role_id' => ['required', Rule::notIn([1,2])],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'department' => [''],
            'tel' => [''],
            'adresse' => [''],
            'company' => [''],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return void
     */
    protected function create(array $data)
    {
        //$role_id = (int) $data['role_id'] === 1 ? 2 : (int) $data['role_id'];

        $user = new User();
        $user->role_id = $data['role_id'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->department = $data['department'] ?? null;
        $user->tel = $data['tel'] ?? null;
        $user->adresse = $data['adresse'] ?? null;
        $user->company = $data['company'] ?? null;
        $user->save();

        //Todo: Assigner un role à l'utilisateur
        //$user->assignRole(\Spatie\Permission\Models\Role::findById($data['role_id'])->get());

        return $user;
    }
}
