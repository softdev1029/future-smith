<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Tribe;

class HomeController extends Controller
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
    public function index()
    {
        $projects = Project::whereRaw('1=1')
                           ->orderBy('id', 'DESC');

        $tribes   = Tribe::whereRaw('1=1')
                           ->orderBy('id', 'DESC');


        $user = Auth::user();

        return view('frontend.home', [
            'projects' => $projects->get(),
            'tribes'   => $tribes->get()
        ]);
    }
}
