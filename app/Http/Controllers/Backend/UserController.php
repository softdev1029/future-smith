<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\StripePlan;

class UserController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requests for users
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the list of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $users = User::whereRaw('1=1')->get();
        //->paginate(self::COUNT_PER_PAGE);

      return view('backend.user.list', [
        'users' => $users
      ]);
    }

    /**
     * Show the each user detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function each($id) {

      $user = User::find($id);

      return view('backend.user.detail', [
        'user' => $user,
        'tribes' => $user->tribes,
        'projects' => $user->projects,
        'plans' => StripePlan::all(),
      ]);
    }
}
