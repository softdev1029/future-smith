<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends BackendController
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
     * Show the list of projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $projects = Project::whereRaw('1=1')->get();
        //->paginate(self::COUNT_PER_PAGE);

      return view('backend.project.list', [
        'projects' => $projects
      ]);
    }

    /**
     * Show the each project detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function each($id) {

      $project = Project::find($id);

      return view('backend.project.detail', [
        'project' => $project,
      ]);
    }
}
