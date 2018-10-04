<?php

/**
 * @author Dejan
 * @since  Sep 21, 2018
 */

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models

class PageController extends Controller
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
     * Show about us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about_us(Request $request) {
        return view('frontend.pages.about_us', ['messages' => $messages]);
    }
}
