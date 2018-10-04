<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Notification Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requests for notifications
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
     * Show the list of tribes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $notifications = DB::table('notifications')->get();
        //->paginate(self::COUNT_PER_PAGE);

      return view('backend.notification.list', [
        'notifications' => $notifications
      ]);
    }
}
