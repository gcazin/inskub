<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'role_name' => ['required', Rule::notIn(['super-admin', 'admin'])],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'department_id' => [
                Rule::requiredIf($data['role_name'] === "expert"),
                'exists:departments,id'
            ],
            'postal_code' => [
                Rule::requiredIf($data['role_name'] === "expert"),
                'exists:cities,zip_code'
            ],
            'city_id' => [
                Rule::requiredIf($data['role_name'] === "expert"),
                'exists:cities,id'
            ],
            'perimeter' => [
                Rule::requiredIf($data['role_name'] === "expert"),
                'integer'
            ],
            'company_id' => ['exists:companies,id'],
            'siret_number' => [
                Rule::requiredIf($data['role_name'] === 'intermediate'),
            ]
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
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->department_id = $data['department_id'] ?? null;
        $user->postal_code = $data['postal_code'] ?? null;
        $user->city_id = $data['city_id'] ?? null;
        $user->company_id = $data['company_id'] ?? null;
        $user->siret_number = $data['siret_number'] ?? null;
        $user->save();

        $user->assignRole($data['role_name']);

        return $user;
    }
}
