<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const COUNT_PER_PAGE = 3;

	/**
    * Constructor
    */
    public function __construct() {
        $this->middleware(function (Request $request, $next) {
            $redirect = $this->beforeAction($request);
	    	
	    	if (!$redirect)
                return $next($request);

            return $redirect;
        });
    }

    public function beforeAction() {
    	$route_name = \Request::route()->getName();

    	view()->share([
            'page_route' => $route_name,
            'page_key'   => str_replace('.', '-', $route_name),
            'current_user' => Auth::user()
    	]);
    }
}
