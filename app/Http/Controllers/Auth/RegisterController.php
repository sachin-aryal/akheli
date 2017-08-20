<?php

namespace App\Http\Controllers\Auth;
use App\Client;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'shop_name' => 'required|string|max:255',
            'phone_no' => 'required|number|max:9|min:7',
            "location" => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'enabled' => true,
        ]);

        $path = "default.jpg";
        if ($data->hasFile('photo')) {
            $image = $data->file('photo');
            $name = $data["email"].".jpg";
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $user->client=Client::create([
            'name'=>$data['name'],
            'shop_name'=>$data['shop_name'],
            'phone_no'=>$data['phone'],
            'location'=>$data['location'],
            'user_id'=>$user->id,
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', 'client')->first());

        return $user;




    }
}
