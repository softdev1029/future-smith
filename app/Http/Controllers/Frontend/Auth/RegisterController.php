<?php

namespace App\Http\Controllers\Frontend\Auth;

use Mail;

use App\Models\User;
use App\Models\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Models\EmailTemplate;
use App\Mail\EmailSend;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => str_random(40) . time(),
            'status' => User::INACTIVE
        ]);

        $profile = new UserProfile();
        $profile->name      = $user->name;
        $profile->overview  = '';
        $profile->suburb    = '';
        $profile->state     = '';
        $profile->topic_id  = 0;
        $profile->user_id   = $user->id;

        $profile->save();

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->sendRegisterActivateNotification();

        add_message(__('message.user.registered'), 'success');

        return redirect()->route('login');
    }

    /**
     * @param $token
     */
    public function activate($token = null)
    {
        $user = User::where('token', $token)->first();
        
        if (empty($user)) {
            add_message(__('message.user.activate'), 'danger');
            return redirect()->route('login');
        }

        $user->update(['token' => null, 'status' => User::ACTIVE]);

        add_message(__('message.user.activated'), 'success');

        return redirect()->route('login');
    }
}
