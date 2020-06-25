<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;
use phpDocumentor\Reflection\Types\Null_;

class AdminManageController extends Controller
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
     * Show the application admin.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $admin = Admin::where('is_super', 1)->paginate(10);
        return view('admin.pages.user.all-admin', compact('admin'));
    }

    /**
     * Show the application add new admin.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function showAdminForm()
    {
        return view('admin.pages.user.add-new-admin');
    }

    /**
     * Store a new admin.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:85',
            'email' => 'required|unique:admins|max:55',
            'password' => 'required',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->is_super = 1;
        $avatar = $request->file('avatar');

//        if ($avatar) {
//
//            $main_image = Str::random(50) . '.' . $avatar->getClientOriginalExtension();
//            // resizing an uploaded file
//            Image::make($avatar)->resize(350, 220)->save(public_path('uploads/users/admin' . $main_image));
//            $admin->avatar = 'uploads/users/admin' . $main_image;
//
//        }

        $admin->save();

        $role = new Role();
        $role->admin_id     = $admin->id;
        $role->posts        = $request->posts;
        $role->pages        = $request->pages;
        $role->comments     = $request->comments;
        $role->reviews      = $request->reviews;
        $role->coupons      = $request->coupons;
        $role->ecommerce    = $request->ecommerce;
        $role->orders       = $request->orders;
        if ($request->products){
            $role->products     = $request->products;
            $role->stock_manage = 1;
        }
        $role->theme_panel  = $request->theme_panel;
        $role->mail         = $request->mail;
        $role->widgets      = $request->widgets;
        $role->users        = $request->users;
        $role->tools        = $request->tools;
        $role->settings     = $request->settings;
        $role->create_admin = $request->create_admin;
        $role->save();
        $notification = array(
            'messege' => 'Admin successfully added',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.user')->with($notification);
    }

    /**
     * Edit existing product.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $admin = Admin::where('is_super', 1)->findOrFail($id);
        return view('admin.pages.user.edit-admin', compact('admin'));
    }

    /**
     * Update existing product.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */
    public function update($id, $role_id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:85',
            'email' => 'required|max:55',
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password){
            $admin->password = Hash::make($request->password);
        }
        $admin->is_super = 1;
        $avatar = $request->file('avatar');

        //Old Image Link
        //$old_avatar     = $request->old_avatar;

//        if ($avatar) {
//
//            unlink($old_avatar);
//            $main_image = Str::random(50) . '.' . $avatar->getClientOriginalExtension();
//            // resizing an uploaded file
//            Image::make($avatar)->resize(500, 500)->save(public_path('uploads/users/admin' . $main_image));
//            $admin->avatar = 'uploads/users/admin' . $main_image;
//
//        }
        $admin->save();

        $role = Role::find($role_id);
        $role->posts        = $request->posts;
        $role->pages        = $request->pages;
        $role->comments     = $request->comments;
        $role->reviews      = $request->reviews;
        $role->coupons      = $request->coupons;
        $role->ecommerce    = $request->ecommerce;
        $role->orders       = $request->orders;
        if ($request->products){
            $role->products     = $request->products;
            $role->stock_manage = 1;
        }
        else {
            $role->products     = $request->products;
            $role->stock_manage = NULL;
        }
        $role->theme_panel  = $request->theme_panel;
        $role->mail         = $request->mail;
        $role->widgets      = $request->widgets;
        $role->users        = $request->users;
        $role->tools        = $request->tools;
        $role->settings     = $request->settings;
        $role->create_admin = $request->create_admin;
        $role->save();
        $notification = array(
            'messege' => 'Admin successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.user')->with($notification);
    }

    /**
     * Delete existing product.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id, $role_id)
    {
        $admin = Admin::find($id);
        $role  = Role::find($role_id);

        $admin->forceDelete();
        $role->forceDelete();
        $notification = array(
            'messege' => 'Admin successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.user')->with($notification);
    }
}
