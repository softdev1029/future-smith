<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BackendController;

// Models
use App\Models\User;
use App\Models\Discussion;
use App\Models\Tribe;
use App\Models\Project;

class DashboardController extends BackendController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $user_count = User::all()->count();
    $tribe_count = Tribe::all()->count();
    $project_count = Project::all()->count();

    return view('backend.dashboard', [
      'user_count' => $user_count,
      'tribe_count' => $tribe_count,
      'project_count' => $project_count,
    ]);
  }
}
