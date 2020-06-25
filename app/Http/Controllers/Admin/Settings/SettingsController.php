<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application backup page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
//        $files = File::allFiles('storage/app/Eshop')->get();
//        dd($files);
//        return view('admin.pages.settings.backup', compact('files'));
        return view('admin.pages.settings.backup')->with('files', File::allFiles('storage/app/eshop'));
    }
}
