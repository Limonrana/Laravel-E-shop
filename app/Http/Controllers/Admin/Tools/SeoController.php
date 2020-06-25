<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
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
     * Show the application product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        $seo = Seo::where('id', 1)->first();
        return view('admin.pages.tools.seo', compact('seo'));
    }

    /**
     * Update SEO meta-data.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function update($id, Request $request)
    {
        $seo                    = Seo::find($id);
        $seo->meta_title        = $request->meta_title;
        $seo->meta_author       = $request->meta_author;
        $seo->meta_tag          = $request->meta_tag;
        $seo->meta_description  = $request->meta_description;
        $seo->google_analytics  = $request->google_analytics;
        $seo->bing_analytics    = $request->bing_analytics;
        $seo->save();
        $notification = array(
            'messege' => 'SEO meta data updated done',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
