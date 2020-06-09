<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Set whether or not to include inactive items on the page (including in the navbar).
//        $activeArray = [$includeInactive === 'include_inactive' ? 0 : 1, 1];

        return view('home');
    }
}
