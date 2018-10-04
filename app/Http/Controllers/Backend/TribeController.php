<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;

use App\Models\Tribe;

class TribeController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Tribe Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requests for tribes
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

      $tribes = Tribe::whereRaw('1=1')->get();
        //->paginate(self::COUNT_PER_PAGE);

      return view('backend.tribe.list', [
        'tribes' => $tribes
      ]);
    }

    /**
     * Show the each tribe detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function each($id) {

      $tribe = Tribe::find($id);

      return view('backend.tribe.detail', [
        'tribe' => $tribe,
      ]);
    }
}
