@extends('layouts.app')

@section('title', 'E-SHOP - Blog Page')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @forelse($blog as $val)
                    <article class="entry">
                        <div class="entry-media">
                            <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}">
                                <img src="{{ asset($val->featured_image) }}" alt="{{ $val->post_title_en }}">
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

                            <div class="entry-meta">
                                <span><i class="icon-calendar"></i>{{ date('M d Y', strtotime($val->created_at)) }}</span>
                                <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                                <span><i class="icon-folder-open"></i>
                                        <a href="{{ route('blog.category.page', [Str::of($val->get_post_category->category_name_en)->slug('-'), $val->category_id]) }}">
                                            {{ $val->get_post_category->category_name_en }}
                                        </a>
                                    </span>
                            </div><!-- End .entry-meta -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                    @empty
                        <article class="entry">
                            <h2>Blog Post Empty</h2>
                        </article>
                    @endforelse

                    <nav class="toolbox toolbox-pagination">
                        <ul class="pagination">
                            {{ $blog->links() }}
                        </ul>
                    </nav>
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
                                <a href="">
                                    {{ $val->tag_name_en }}
                                </a>
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
