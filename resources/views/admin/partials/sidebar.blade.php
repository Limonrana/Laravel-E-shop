@php
    $role = \App\Models\Admin\Admin::where('id', \Illuminate\Support\Facades\Auth::user()->id)->first();
@endphp
@if ($role)
<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo"><a href=""><i class="icon ion-aperture"></i> E-SHOP</a></div>
<div class="sl-sideleft">
    <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
    </div><!-- input-group -->

    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-home tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @if ($role->roles->posts == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/blog*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-clipboard tx-18"></i>
                <span class="menu-item-label">Posts</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.post') }}" class="nav-link {{ Request::is('admin/blog') ? 'active' : '' }}">All Posts</a></li>
            <li class="nav-item"><a href="{{ route('admin.post.add.new') }}" class="nav-link {{ Request::is('admin/blog/add-new') ? 'active' : '' }}">Add New Post</a></li>
            <li class="nav-item"><a href="{{ route('admin.post.category') }}" class="nav-link {{ Request::is('admin/blog/category') ? 'active' : '' }}">Category</a></li>
            <li class="nav-item"><a href="{{ route('admin.post.tag') }}" class="nav-link {{ Request::is('admin/blog/tags') ? 'active' : '' }}">Tags</a></li>
        </ul>
        @else
        @endif

        @if ($role->roles->pages == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/pages*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-clone tx-18"></i>
                <span class="menu-item-label">Pages</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.page.home') }}" class="nav-link {{ Request::is('admin/pages/panel/home') ? 'active' : '' }}">Home</a></li>
            <li class="nav-item"><a href="{{ route('admin.page.about') }}" class="nav-link {{ Request::is('admin/pages/panel/about') ? 'active' : '' }}">About</a></li>
            <li class="nav-item"><a href="{{ route('admin.page.contact') }}" class="nav-link {{ Request::is('admin/pages/panel/contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        @else
        @endif

{{--        @if ($role->roles->comments == 1)--}}
{{--        <a href="widgets.html" class="sl-menu-link">--}}
{{--            <div class="sl-menu-item">--}}
{{--                <i class="menu-item-icon icon ion-chatbox tx-20"></i>--}}
{{--                <span class="menu-item-label">Comments</span>--}}
{{--            </div><!-- menu-item -->--}}
{{--        </a><!-- sl-menu-link -->--}}
{{--        @else--}}
{{--        @endif--}}

        @if ($role->roles->reviews == 1)
        <a href="{{ route('admin.review') }}" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-chatboxes tx-20"></i>
                <span class="menu-item-label">Reviews</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @else
        @endif

        @if ($role->roles->coupons == 1)
        <a href="{{ route('admin.coupon') }}" class="sl-menu-link {{ Request::is('admin/coupon') ? 'active' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-gift tx-20"></i>
                <span class="menu-item-label">Coupons</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @else
        @endif

        @if ($role->roles->ecommerce == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/ecommerce*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-pie-chart tx-20"></i>
                <span class="menu-item-label">E-commerce</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.ecommerce.dashboard') }}" class="nav-link {{ Request::is('admin/ecommerce/dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('admin.all.orders') }}" class="nav-link {{ Request::is('admin/ecommerce/orders') ? 'active' : '' }}">Orders</a></li>
            <li class="nav-item"><a href="{{ route('admin.category') }}" class="nav-link {{ Request::is('admin/product/category') ? 'active' : '' }}">Customers</a></li>
            <li class="nav-item"><a href="{{ route('admin.ecommerce.dashboard') }}" class="nav-link {{ Request::is('') ? 'active' : '' }}">Reports</a></li>
            <li class="nav-item"><a href="{{ route('admin.shipping') }}" class="nav-link {{ Request::is('admin/ecommerce/shipping/method') ? 'active' : '' }}">Shipping</a></li>
            <li class="nav-item"><a href="{{ route('admin.brand') }}" class="nav-link {{ Request::is('admin/product/brand') ? 'active' : '' }}">Settings</a></li>
        </ul>
        @else
        @endif

        @if ($role->roles->orders == 1)
        @php
            $order = \App\Models\Admin\Order::where('status', 0)->where('refund', 0)->get();
        @endphp
        <a href="#" class="sl-menu-link {{ Request::is('admin/orders*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-shopping-cart tx-20"></i>
                @if (count($order) > 0)
                    <span class="badge badge-danger icon-notify">{{ count($order) }}</span>
                @else
                @endif
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.new.orders') }}" class="nav-link {{ Request::is('admin/orders/new') ? 'active' : '' }}">
                    New Orders
                    @if (count($order) > 0)
                        <span class="badge badge-danger text-right">{{ count($order) }}</span>
                    @else
                    @endif
                </a></li>
            <li class="nav-item"><a href="{{ route('admin.pending.orders') }}" class="nav-link {{ Request::is('admin/orders/pending') ? 'active' : '' }}">Pending</a></li>
            <li class="nav-item"><a href="{{ route('admin.confirm.orders') }}" class="nav-link {{ Request::is('admin/orders/confirm') ? 'active' : '' }}">Confirm</a></li>
            <li class="nav-item"><a href="{{ route('admin.processing.orders') }}" class="nav-link {{ Request::is('admin/orders/processing') ? 'active' : '' }}">Processing</a></li>
            <li class="nav-item"><a href="{{ route('admin.complete.orders') }}" class="nav-link {{ Request::is('admin/orders/complete') ? 'active' : '' }}">Complete</a></li>
            <li class="nav-item"><a href="{{ route('admin.hold.orders') }}" class="nav-link {{ Request::is('admin/orders/on-hold') ? 'active' : '' }}">On-Hold</a></li>
        </ul>
        @else
        @endif

        @if ($role->roles->products == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/product*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-cube tx-20"></i>
                <span class="menu-item-label">Products</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.product') }}" class="nav-link {{ Request::is('admin/product') ? 'active' : '' }}">All Products</a></li>
            <li class="nav-item"><a href="{{ route('admin.product.add.new') }}" class="nav-link {{ Request::is('admin/product/add-new') ? 'active' : '' }}">Add New</a></li>
            <li class="nav-item"><a href="{{ route('admin.category') }}" class="nav-link {{ Request::is('admin/product/category') ? 'active' : '' }}">Category</a></li>
            <li class="nav-item"><a href="{{ route('admin.subcategory') }}" class="nav-link {{ Request::is('admin/product/sub-category') ? 'active' : '' }}">Subcategory</a></li>
            <li class="nav-item"><a href="{{ route('admin.brand') }}" class="nav-link {{ Request::is('admin/product/brand') ? 'active' : '' }}">Brand</a></li>
        </ul>
        @else
        @endif

        @php
            $out_stock = \App\Models\Admin\Product::where('status', 1)->where('product_quantity', 0)->get();
            $low_stock = \App\Models\Admin\Product::where('status', 1)->where('product_quantity', '<=', 5)->get();
        @endphp
        @if ($role->roles->stock_manage == 1)
            <a href="#" class="sl-menu-link {{ Request::is('admin/stock/*') ? 'active show-sub' : '' }}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon fa fa-houzz tx-20"></i>
                    @if (count($out_stock) > 0)
                        <span class="badge badge-danger icon-notify">{{ count($out_stock) }}</span>
                    @elseif (count($low_stock) > 0)
                        <span class="badge badge-warning text-white icon-notify">{{ count($low_stock) }}</span>
                    @else
                    @endif
                    <span class="menu-item-label">Stock Management</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.stock') }}" class="nav-link {{ Request::is('admin/stock/all') ? 'active' : '' }}">Stock Products</a></li>
                <li class="nav-item"><a href="{{ route('admin.stock.low') }}" class="nav-link {{ Request::is('admin/stock/low-stock') ? 'active' : '' }}">Low Stock</a></li>
                <li class="nav-item"><a href="{{ route('admin.stock.out') }}" class="nav-link {{ Request::is('admin/stock/out-of-stock') ? 'active' : '' }}">Out Of Stock</a></li>
            </ul>
        @else
        @endif

        @if ($role->roles->theme_panel == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/theme*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon fa fa-server tx-18"></i>
                <span class="menu-item-label">Theme Panel</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.theme.header') }}" class="nav-link {{ Request::is('admin/theme/panel/header-footer') ? 'active' : '' }}">Header/Footer</a></li>
                <li class="nav-item"><a href="{{ route('admin.theme.slider') }}" class="nav-link {{ Request::is('admin/theme/panel/slider') ? 'active' : '' }}">Slider</a></li>
                <li class="nav-item"><a href="table-basic.html" class="nav-link">All Customers</a></li>
                <li class="nav-item"><a href="table-basic.html" class="nav-link">Add Customer</a></li>
                <li class="nav-item"><a href="table-basic.html" class="nav-link">Your Profile</a></li>
            </ul>
        @else
        @endif

        @if ($role->roles->mail == 1)
        <a href="mailbox.html" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-email tx-24"></i>
                <span class="menu-item-label">Mailbox</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @else
        @endif

        @if ($role->roles->widgets == 1)
        <a href="widgets.html" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-plug tx-20"></i>
                <span class="menu-item-label">Cards &amp; Widgets</span>
            </div><!-- menu-item -->
        </a>
        @else
        @endif

        @if ($role->roles->users == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/user*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-person-stalker tx-20"></i>
                <span class="menu-item-label">Users</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.user') }}" class="nav-link {{ Request::is('admin/user/all') ? 'active' : '' }}">All Admins</a></li>
            <li class="nav-item"><a href="{{ route('admin.user.add.new') }}" class="nav-link {{ Request::is('admin/user/add-new') ? 'active' : '' }}">Add Admin</a></li>
            <li class="nav-item"><a href="table-basic.html" class="nav-link">All Customers</a></li>
            <li class="nav-item"><a href="table-basic.html" class="nav-link">Add Customer</a></li>
            <li class="nav-item"><a href="table-basic.html" class="nav-link">Your Profile</a></li>
        </ul>
        @else
        @endif

        @if ($role->roles->tools == 1)
        <a href="#" class="sl-menu-link {{ Request::is('admin/tools*') ? 'active show-sub' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-wrench tx-22"></i>
                <span class="menu-item-label">Tools</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.newsletters') }}" class="nav-link {{ Request::is('admin/tools/newsletters') ? 'active show-sub' : '' }}">Newsletters</a></li>
            <li class="nav-item"><a href="{{ route('admin.tools.seo') }}" class="nav-link {{ Request::is('admin/tools/seo') ? 'active show-sub' : '' }}">SEO Tools</a></li>
            <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
            <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
        </ul>
        @else
        @endif

        @if ($role->roles->settings == 1)
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-gear-b tx-22"></i>
                <span class="menu-item-label">Settings</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.newsletters') }}" class="nav-link">Newsletters</a></li>
            @if ($role->is_super == 0)
                <li class="nav-item"><a href="{{ route('admin.database.show') }}" class="nav-link">Backup</a></li>
            @else
            @endif
            <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
            <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
        </ul>
        @else
        @endif
    </div><!-- sl-sideleft-menu -->

    <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->
@else
@endif
