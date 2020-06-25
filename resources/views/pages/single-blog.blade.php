@extends('layouts.app')

@section('title', 'E-SHOP - Single Blog')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog > {{ $single_blog->post_title_en }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single">
                        <div class="entry-media">
                            <div class="entry-slider owl-carousel owl-theme owl-theme-light">
                                <img src="{{ asset($single_blog->featured_image) }}" alt="Post">
{{--                                <img src="assets/images/blog/post-2.jpg" alt="Post">--}}
{{--                                <img src="assets/images/blog/post-3.jpg" alt="Post">--}}
                            </div><!-- End .entry-slider -->
                        </div><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-date">
                                <span class="day">{{ date('d', strtotime($single_blog->created_at)) }}</span>
                                <span class="month">{{ date('M', strtotime($single_blog->created_at)) }}</span>
                            </div><!-- End .entry-date -->

                            <h2 class="entry-title">
                                {{ $single_blog->post_title_en }}
                            </h2>

                            <div class="entry-meta">
                                <span><i class="icon-calendar"></i>{{ date('M d, Y', strtotime($single_blog->created_at)) }}</span>
                                <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                                <span><i class="icon-folder-open"></i>
                                        <a href="{{ route('blog.category.page', [Str::of($single_blog->get_post_category->category_name_en)->slug('-'), $single_blog->get_post_category->id]) }}">
                                            {{ $single_blog->get_post_category->category_name_en }}
                                        </a>,
                                    </span>
                            </div><!-- End .entry-meta -->

                            <div class="entry-content">
                                {!! $single_blog->post_description_en !!}
                            </div><!-- End .entry-content -->

                            <div class="entry-share">
                                <h3>
                                    <i class="icon-forward"></i>
                                    Share this post
                                </h3>

                                <div class="social-icons">
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div><!-- End .social-icons -->
                            </div><!-- End .entry-share -->

                            <div class="entry-author">
                                <h3><i class="icon-user"></i>Author</h3>

                                <figure>
                                    <a href="#">
                                        <img src="{{ asset('frontend/images/blog/author.jpg') }}" alt="author">
                                    </a>
                                </figure>

                                <div class="author-content">
                                    @php
                                    $admin = \App\Models\Admin\Admin::where('id', 1)->where('is_super', 0)->first();
                                    @endphp
                                    <h4><a href="#">{{ $admin->name }}</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab officia culpa corporis, quidem placeat minima unde vel veniam laboriosam et animi, inventore delectus, officiis doloribus ex amet illum ea suscipit!</p>
                                </div><!-- End .author.content -->
                            </div><!-- End .entry-author -->

{{--                            <div class="comment-respond">--}}
{{--                                <h3>Leave a Reply</h3>--}}
{{--                                <p>Your email address will not be published. Required fields are marked *</p>--}}

{{--                                <form action="#">--}}
{{--                                    <div class="form-group required-field">--}}
{{--                                        <label>Comment</label>--}}
{{--                                        <textarea cols="30" rows="1" class="form-control" required></textarea>--}}
{{--                                    </div><!-- End .form-group -->--}}

{{--                                    <div class="form-group required-field">--}}
{{--                                        <label>Name</label>--}}
{{--                                        <input type="text" class="form-control" required>--}}
{{--                                    </div><!-- End .form-group -->--}}

{{--                                    <div class="form-group required-field">--}}
{{--                                        <label>Email</label>--}}
{{--                                        <input type="email" class="form-control" required>--}}
{{--                                    </div><!-- End .form-group -->--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label>Website</label>--}}
{{--                                        <input type="url" class="form-control">--}}
{{--                                    </div><!-- End .form-group -->--}}

{{--                                    <div class="form-group-custom-control mb-3">--}}
{{--                                        <div class="custom-control custom-checkbox">--}}
{{--                                            <input type="checkbox" class="custom-control-input" id="save-name">--}}
{{--                                            <label class="custom-control-label" for="save-name">Save my name, email, and website in this browser for the next time I comment.</label>--}}
{{--                                        </div><!-- End .custom-checkbox -->--}}
{{--                                    </div><!-- End .form-group-custom-control -->--}}

{{--                                    <div class="form-footer">--}}
{{--                                        <button type="submit" class="btn btn-primary">Post Comment</button>--}}
{{--                                    </div><!-- End .form-footer -->--}}
{{--                                </form>--}}
{{--                            </div><!-- End .comment-respond -->--}}
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                    <div class="related-posts">
                        <h4 class="light-title">Related <strong>Posts</strong></h4>
                        @php
                            $related_blog   = \App\Models\Admin\Post::orderBy('id', 'asc')->where('status', 1)->where('category_id', $single_blog->get_post_category->id)->get();
                        @endphp
                        <div class="owl-carousel owl-theme related-posts-carousel">
                            @foreach($related_blog as $val)
                                @if ($val->id != $single_blog->id)
                                    <article class="entry">
                                        <div class="entry-media">
                                            <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}">
                                                <img src="{{ asset($val->featured_image) }}" alt="Post">
                                            </a>
                                        </div><!-- End .entry-media -->

                                        <div class="entry-body">
                                            <div class="entry-date">
                                                <span class="day">{{ date('d', strtotime($val->created_at)) }}</span>
                                                <span class="month">{{ date('M', strtotime($val->created_at)) }}</span>
                                            </div><!-- End .entry-date -->

                                            <h2 class="entry-title">
                                                <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}">
                                                    {{ $val->post_title_en }}
                                                </a>
                                            </h2>

                                            <div class="entry-content">
                                                <p>
                                                    {!! Str::limit($val->post_description_en, 250) !!}
                                                </p>
                                                <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}" class="read-more">
                                                    Read More <i class="icon-angle-double-right"></i>
                                                </a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </article>
                                @else
                                @endif
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->
                </div><!-- End .col-lg-9 -->

                <aside class="sidebar col-lg-3">
                    <div class="sidebar-wrapper">
                        <div class="widget widget-search">
                            <form role="search" method="get" class="search-form" action="#">
                                <input type="search" class="form-control" placeholder="Search posts here..." name="s" required>
                                <button type="submit" class="search-submit" title="Search">
                                    <i class="icon-search"></i>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>
                        </div><!-- End .widget -->

                        <div class="widget widget-categories">
                            <h4 class="widget-title">Blog Categories</h4>

                            <ul class="list">
                                @forelse($category as $val)
                                    <li><a href="{{ route('blog.category.page', [Str::of($val->category_name_en)->slug('-'), $val->id]) }}">
                                            {{ $val->category_name_en }}
                                        </a></li>
                                @empty
                                    <li><a href="">Category Empty</a></li>
                                @endforelse
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h4 class="widget-title">Recent Posts</h4>

                            <ul class="simple-entry-list">
                                @forelse($latest_post as $val)
                                    <li>
                                        <div class="entry-media">
                                            <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}">
                                                <img src="{{ asset($val->featured_image) }}" alt="{{ $val->post_title_en }}">
                                            </a>
                                        </div><!-- End .entry-media -->
                                        <div class="entry-info">
                                            <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}">{{ Str::limit($val->post_title_en, 15) }}</a>
                                            <div class="entry-meta">
                                                {{ date('M d, Y', strtotime($val->created_at)) }}
                                            </div><!-- End .entry-meta -->
                                        </div><!-- End .entry-info -->
                                    </li>
                                @empty
                                    <li>Recent Post Empty</li>
                                @endforelse
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h4 class="widget-title">Tagcloud</h4>

                            <div class="tagcloud">
                                @forelse($tag as $val)
                                    <a href="">{{ $val->tag_name_en }}</a>
                                @empty
                                    <a href="">Empty</a>
                                @endforelse
                            </div><!-- End .tagcloud -->
                        </div><!-- End .widget -->

                        {{--                        <div class="widget">--}}
                        {{--                            <h4 class="widget-title">Archive</h4>--}}

                        {{--                            <ul class="list">--}}
                        {{--                                @forelse($date as $val)--}}
                        {{--                                <li><a href="#">{{ date('M Y', strtotime($val->created_at)) }}</a></li>--}}
                        {{--                                @empty--}}
                        {{--                                    <li><a href="#">Empty</a></li>--}}
                        {{--                                @endforelse--}}
                        {{--                            </ul>--}}
                        {{--                        </div><!-- End .widget -->--}}
                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('admin-js')
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ef11bf6765d66e6"></script>
@endsection
