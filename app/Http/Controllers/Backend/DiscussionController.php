<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;

use App\Models\Discussion;

class DiscussionController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Project Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requests for projects
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
     * Show the list of discussions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $discussions = Discussion::whereRaw('1=1')->get();
        //->paginate(self::COUNT_PER_PAGE);

      return view('backend.discussion.list', [
        'discussions' => $discussions
      ]);
    }

    /**
     * Show the each project detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function each($id) {

      $discussion = Discussion::find($id);

      return view('backend.discussion.detail', [
        'discussion' => $discussion,
      ]);
    }
}
