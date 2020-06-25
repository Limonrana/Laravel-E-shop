<aside class="sidebar col-lg-3">
    <div class="widget widget-dashboard">
        <h3 class="widget-title">My Account</h3>

        <ul class="list">
            <li class="{{ Request::is('customer/dashboard') ? 'active' : '' }}"><a href="{{ route('home') }}">Account Dashboard</a></li>
            <li class="{{ Request::is('customer/orders/new') ? 'active' : '' }}"><a href="{{ route('customer.new.order') }}">New Orders</a></li>
            <li class="{{ Request::is('customer/orders/complete') ? 'active' : '' }}"><a href="{{ route('customer.complete.order') }}">Complete Orders</a></li>
            <li class="{{ Request::is('') ? 'active' : '' }}"><a href="#">Return Order</a></li>
            <li class="{{ Request::is('customer/feedback/pending') ? 'active' : '' }}"><a href="{{ route('customer.pending.feedback') }}">My Reviews</a></li>
            <li class="{{ Request::is('customer/wishlist') ? 'active' : '' }}"><a href="{{ route('customer.wishlist') }}">My Wishlist</a></li>
            <li class="{{ Request::is('customer/billing-address') ? 'active' : '' }}"><a href="{{ route('customer.billing.address') }}">Billing Address</a></li>
            <li class="{{ Request::is('change/password') ? 'active' : '' }}"><a href="{{ route('change.password') }}">Change Password</a></li>
            <li class="{{ Request::is('customer/profile') ? 'active' : '' }}"><a href="{{ route('customer.profile') }}">Account Information</a></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->



