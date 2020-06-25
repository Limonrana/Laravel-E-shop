<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
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
     * Show the application category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brand = Brand::paginate(8);
        return view('admin.pages.brand.brand', compact('brand'));
    }

    /**
     * Store a new category.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand_logo = $request->file('brand_logo');
        if ($brand_logo)
        {
            $logo_name      = Str::random(40);
            $logo_ext       = strtolower($brand_logo->getClientOriginalExtension());
            $logo_ran_name  = $logo_name.'.'.$logo_ext;
            $upload_path    = 'uploads/brands/';
            $logo_url       = $upload_path.$logo_ran_name;
            $upload_logo    = $brand_logo->move($upload_path, $logo_ran_name);
            $brand->brand_logo = $logo_url;
            $brand->save();
            $notification=array(
                'messege'=>'Brand successfully added.',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.brand')->with($notification);
        }
        else
        {
            $brand->save();
            $notification=array(
                'messege'=>'Brand successfully added.',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.brand')->with($notification);
        }
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.pages.brand.edit-brand', compact('brand'));
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|max:55',
        ]);
        $brand_old_logo = $request->old_logo;
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand_logo = $request->file('brand_logo');
        if ($brand_logo)
        {
            unlink($brand_old_logo);
            $logo_name      = Str::random(40);
            $logo_ext       = strtolower($brand_logo->getClientOriginalExtension());
            $logo_ran_name  = $logo_name.'.'.$logo_ext;
            $upload_path    = 'uploads/brands/';
            $logo_url       = $upload_path.$logo_ran_name;
            $upload_logo    = $brand_logo->move($upload_path, $logo_ran_name);
            $brand->brand_logo = $logo_url;
            $brand->save();
            $notification=array(
                'messege'=>'Brand successfully updated',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.brand')->with($notification);
        }
        else
        {
            $brand->save();
            $notification=array(
                'messege'=>'Brand successfully updated',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.brand')->with($notification);
        }
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand_logo = $brand->brand_logo;
        unlink($brand_logo);
        $brand->forceDelete();
        $notification=array(
            'messege'=>'Brand successfully deleted.',
            'alert-type'=>'error'
        );
        return redirect()->route('admin.brand')->with($notification);
    }
}
