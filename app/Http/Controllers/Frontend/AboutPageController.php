<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    /**
     * About view page.
     *
     * @return //view
     */

    public function index()
    {
        return view('pages.about');
    }
}
