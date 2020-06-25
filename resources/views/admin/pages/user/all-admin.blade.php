@extends('admin.layouts.app')

@section('title', 'All Admin | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Admin</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Admin</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Admin List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="{{ route('admin.user.add.new') }}" class="btn btn-sm btn-info" >Add New</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">SL</th>
                            <th class="wd-10p">Name</th>
                            <th class="wd-10p">Email</th>
                            <th class="wd-5p">Role</th>
                            <th class="wd-50p">Permission</th>
                            <th class="wd-10p">Created</th>
                            @if (Auth::user()->is_super == 0)
                            <th class="wd-10p">Action</th>
                            @else
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($admin as $key => $val)
                        <tr>
                            <td>{{ $admin->firstItem() + $key }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->email }}</td>
                            <td>
                                @if ($val->is_super == 1)
                                    <span class="badge badge-info">Admin</span>
                                @endif
                            </td>
                            <td>
                                @if ($val->roles->posts == 1)
                                    <span class="badge badge-success">Posts</span>
                                @else
                                @endif
                                @if ($val->roles->pages == 1)
                                    <span class="badge badge-success">Pages</span>
                                    @else
                                @endif
                                    @if ($val->roles->comments == 1)
                                        <span class="badge badge-success">Comments</span>
                                    @else
                                    @endif
                                    @if ($val->roles->reviews == 1)
                                        <span class="badge badge-success">Reviews</span>
                                    @else
                                    @endif
                                    @if ($val->roles->coupons == 1)
                                        <span class="badge badge-success">Coupons</span>
                                    @else
                                    @endif
                                    @if ($val->roles->ecommerce == 1)
                                        <span class="badge badge-success">E-commerce</span>
                                    @else
                                    @endif
                                    @if ($val->roles->orders == 1)
                                        <span class="badge badge-success">Orders</span>
                                    @else
                                    @endif
                                    @if ($val->roles->products == 1)
                                        <span class="badge badge-success">Products</span>
                                    @else
                                    @endif
                                    @if ($val->roles->stock_manage == 1)
                                        <span class="badge badge-success">Stock Manage</span>
                                    @else
                                    @endif
                                    @if ($val->roles->theme_panel == 1)
                                        <span class="badge badge-success">Theme Panel</span>
                                    @else
                                    @endif
                                    @if ($val->roles->mail == 1)
                                        <span class="badge badge-success">Mail</span>
                                    @else
                                    @endif
                                    @if ($val->roles->widgets == 1)
                                        <span class="badge badge-success">Widgets</span>
                                    @else
                                    @endif
                                    @if ($val->roles->users == 1)
                                        <span class="badge badge-success">Users</span>
                                    @else
                                    @endif
                                    @if ($val->roles->tools == 1)
                                        <span class="badge badge-success">Tools</span>
                                    @else
                                    @endif
                                    @if ($val->roles->settings == 1)
                                        <span class="badge badge-success">Settings</span>
                                    @else
                                    @endif
                                    @if ($val->roles->create_admin == 1)
                                        <span class="badge badge-success">Admin Manage</span>
                                    @else
                                    @endif
                            </td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                @if (Auth::user()->is_super == 0)
                                    <a href="{{ route('admin.user.edit', $val->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil fa-lg" title="EDIT"></i></a>
                                    <a href="{{ route('admin.user.delete', [$val->id, $val->roles->id]) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @else
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE ADMIN HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="{{ route('admin.user.add.new') }}" class="btn btn-md btn-info" >Create New Admin</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $admin->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
