@include('admin.partials.header')
@guest

@else
    @include('admin.partials.sidebar')
    @include('admin.partials.topbar')
@endguest
@yield('content')
@include('admin.partials.footer')
