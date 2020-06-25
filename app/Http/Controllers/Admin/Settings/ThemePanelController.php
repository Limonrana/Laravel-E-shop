<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Admin\HeaderFooter;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ThemePanelController extends Controller
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
     * Show the application header-footer form.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function HeaderShow()
    {
        $get = HeaderFooter::where('id', 1)->first();
        return view('admin.pages.theme-panel.theme-panel', compact('get'));
    }

    /**
     * Update header data.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function HeaderUpdate(Request $request, $id)
    {

        $header                        = HeaderFooter::find($id);
        $header->logo_width            = $request->logo_width;
        $header->top_massage           = $request->top_massage;
        $header->phone_subtitle        = $request->phone_subtitle;
        $header->phone_number          = $request->phone_number;

        //Old Image Link
        $old_logo                       = $request->old_logo;
        $old_menu_image                 = $request->old_menu_image;

        //New Image
        $logo                           = $request->file('logo');
        $menu_image                     = $request->file('menu_image');

        if ($logo) {

            unlink($old_logo);
            $main_image = Str::random(50) . '.' . $logo->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($logo)->save(public_path('uploads/others/' . $main_image));
            $header->logo = 'uploads/others/' . $main_image;

        }
        if ($menu_image) {

            unlink($old_menu_image);
            $new_menu_logo = Str::random(50) . '.' . $menu_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($menu_image)->resize(300, 240)->save(public_path('uploads/others/' . $new_menu_logo));
            $header->menu_image = 'uploads/others/' . $new_menu_logo;

        }

        $header->save();
        $notification = array(
            'messege' => 'Header successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    /**
     * Update footer data.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function FooterUpdate(Request $request, $id)
    {

        $footer                        = HeaderFooter::find($id);
        $footer->footer_title          = $request->footer_title;
        $footer->address               = $request->address;
        $footer->phone_footer          = $request->phone_footer;
        $footer->email_footer          = $request->email_footer;
        $footer->working_day           = $request->working_day;
        $footer->newsletter_title      = $request->newsletter_title;
        $footer->newsletter_subtitle   = $request->newsletter_subtitle;
        $footer->copyright_text        = $request->copyright_text;
        //Old Image Link
        $old_payment_logo              = $request->old_payment_logo;

        //New Image
        $payment_logo                  = $request->file('payment_logo');

        if ($payment_logo) {

            //unlink($old_payment_logo);
            $new_payment_logo = Str::random(50) . '.' . $payment_logo->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($payment_logo)->resize(267, 36)->save(public_path('uploads/others/' . $new_payment_logo));
            $footer->payment_logo = 'uploads/others/' . $new_payment_logo;

        }

        $footer->save();
        $notification = array(
            'messege' => 'Footer successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Show the application slider form.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function SliderShow()
    {
        $slider = Slider::paginate(10);
        return view('admin.pages.theme-panel.slider', compact('slider'));
    }

    /**
     * Store Slider data.
     *
     * @param //Request  $request
     * @return //Response
     */

    public function SliderStore(Request $request)
    {

        $slider                     = new Slider();
        $slider->title              = $request->title;
        $slider->subtitle           = $request->subtitle;
        $slider->button_text        = $request->button_text;
        $slider->description        = $request->description;
        $slider->button_url         = $request->button_url;
        $slider->button_bg          = $request->button_bg;

        //New Image
        $slider_image               = $request->file('slider_image');

        if ($slider_image) {
            $main_image = Str::random(50) . '.' . $slider_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($slider_image)->save(public_path('uploads/others/' . $main_image));
            $slider->slider_image = 'uploads/others/' . $main_image;
        }
        $slider->save();
        $notification = array(
            'messege' => 'Slider successfully added',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Edit existing Slider.
     *
     * @param  //id
     * @return //view
     */

    public function SliderEdit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.pages.theme-panel.edit-slider', compact('slider'));
    }

    /**
     * Update existing slider.
     *
     * @param  //id
     * @return //view
     */
    public function SliderUpdate($id, Request $request)
    {
        $slider                     = Slider::find($id);
        $slider->title              = $request->title;
        $slider->subtitle           = $request->subtitle;
        $slider->button_text        = $request->button_text;
        $slider->description        = $request->description;
        $slider->button_url         = $request->button_url;
        $slider->button_bg          = $request->button_bg;
        $old_image                  = $slider->slider_image;
        //New Image
        $slider_image               = $request->file('slider_image');

        if ($slider_image) {
            if ($old_image) {
                unlink($old_image);
            }
            $main_image = Str::random(50) . '.' . $slider_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($slider_image)->save(public_path('uploads/others/' . $main_image));
            $slider->slider_image = 'uploads/others/' . $main_image;
        }
        $slider->save();
        $notification = array(
            'messege' => 'Slider successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.theme.slider')->with($notification);
    }

    /**
     * Delete existing slider.
     *
     * @param  //id
     * @return //view
     */
    public function SliderDelete($id)
    {
        $slider         = Slider::find($id);
        $slider_image   = $slider->slider_image;
        if ($slider_image) {
            unlink($slider_image);
        }
        $slider->forceDelete();
            $notification=array(
                'messege'=>'Slider successfully deleted.',
                'alert-type'=>'error'
            );
            return back()->with($notification);
    }
}
