<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Admin\Home;
use App\Models\Admin\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PagesController extends Controller
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
     * Show the application homepage panel form.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function Homepage()
    {
        $get = Home::where('id', 1)->first();
        $icon = Icon::where('id', 1)->first();
        return view('admin.pages.pages.home', compact('get', 'icon'));
    }

    /**
     * Update header data.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function HomeUpdate(Request $request, $id)
    {

        $home                           = Home::find($id);
        //Old Image Link
        $old_left_banner_1              = $home->left_banner_1;
        $old_left_banner_2              = $home->left_banner_2;
        $old_left_banner_3              = $home->left_banner_3;
        $old_mid_banner_1               = $home->mid_banner_1;
        $old_mid_banner_2               = $home->mid_banner_2;
        $old_mid_banner_3               = $home->mid_banner_3;
        $old_right_banner_1             = $home->right_banner_1;
        $old_right_banner_2             = $home->right_banner_2;
        $old_right_banner_3             = $home->right_banner_3;

        //New Image
        $left_banner_1                  = $request->file('left_banner_1');
        $left_banner_2                  = $request->file('left_banner_2');
        $left_banner_3                  = $request->file('left_banner_3');
        $mid_banner_1                   = $request->file('mid_banner_1');
        $mid_banner_2                   = $request->file('mid_banner_2');
        $mid_banner_3                   = $request->file('mid_banner_3');
        $right_banner_1                 = $request->file('right_banner_1');
        $right_banner_2                 = $request->file('right_banner_2');
        $right_banner_3                 = $request->file('right_banner_3');

        if ($left_banner_1) {

            //unlink($old_left_banner_1);
            $left_banner1 = Str::random(50) . '.' . $left_banner_1->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($left_banner_1)->resize(270, 304)->save(public_path('uploads/others/' . $left_banner1));
            $home->left_banner_1 = 'uploads/others/' . $left_banner1;

        }
        if ($left_banner_2) {

            unlink($old_left_banner_2);
            $left_banner2 = Str::random(50) . '.' . $left_banner_2->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($left_banner_2)->resize(270, 344)->save(public_path('uploads/others/' . $left_banner2));
            $home->left_banner_2 = 'uploads/others/' . $left_banner2;

        }
        if ($left_banner_3) {

            unlink($old_left_banner_3);
            $left_banner3 = Str::random(50) . '.' . $left_banner_3->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($left_banner_3)->resize(270, 244)->save(public_path('uploads/others/' . $left_banner3));
            $home->left_banner_3 = 'uploads/others/' . $left_banner3;

        }
        if ($mid_banner_1) {

            unlink($old_mid_banner_1);
            $mid_banner1 = Str::random(50) . '.' . $mid_banner_1->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($mid_banner_1)->resize(569, 369)->save(public_path('uploads/others/' . $mid_banner1));
            $home->mid_banner_1 = 'uploads/others/' . $mid_banner1;

        }
        if ($mid_banner_2) {

            unlink($old_mid_banner_2);
            $mid_banner2 = Str::random(50) . '.' . $mid_banner_2->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($mid_banner_2)->resize(570, 226)->save(public_path('uploads/others/' . $mid_banner2));
            $home->mid_banner_2 = 'uploads/others/' . $mid_banner2;

        }
        if ($mid_banner_3) {

            unlink($old_mid_banner_3);
            $mid_banner3 = Str::random(50) . '.' . $mid_banner_3->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($mid_banner_3)->resize(569, 296)->save(public_path('uploads/others/' . $mid_banner3));
            $home->mid_banner_3 = 'uploads/others/' . $mid_banner3;

        }
        if ($right_banner_1) {

            unlink($old_right_banner_1);
            $right_banner1 = Str::random(50) . '.' . $right_banner_1->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($right_banner_1)->resize(270, 216)->save(public_path('uploads/others/' . $right_banner1));
            $home->right_banner_1 = 'uploads/others/' . $right_banner1;

        }
        if ($right_banner_2) {

            unlink($old_right_banner_2);
            $right_banner2 = Str::random(50) . '.' . $right_banner_2->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($right_banner_2)->resize(270, 476)->save(public_path('uploads/others/' . $right_banner2));
            $home->right_banner_2 = 'uploads/others/' . $right_banner2;

        }
        if ($right_banner_3) {

            unlink($old_right_banner_3);
            $right_banner3 = Str::random(50) . '.' . $right_banner_3->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($right_banner_3)->resize(270, 200)->save(public_path('uploads/others/' . $right_banner3));
            $home->right_banner_3 = 'uploads/others/' . $right_banner3;

        }

        $home->save();
        $notification = array(
            'messege' => 'Banners successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    /**
     * Update info box data.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function InfoUpdate(Request $request, $id)
    {

        $icon                           = Home::find($id);
        $icon->info_title_1             = $request->info_title_1;
        $icon->info_title_2             = $request->info_title_2;
        $icon->info_title_3             = $request->info_title_3;
        $icon->info_subtitle_1          = $request->info_subtitle_1;
        $icon->info_subtitle_2          = $request->info_subtitle_2;
        $icon->info_subtitle_3          = $request->info_subtitle_3;
        $icon->info_icon_1              = $request->info_icon_1;
        $icon->info_icon_2              = $request->info_icon_2;
        $icon->info_icon_3              = $request->info_icon_3;

        $icon->save();
        $notification = array(
            'messege' => 'Info box data successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
