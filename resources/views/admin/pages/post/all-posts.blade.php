@extends('admin.layouts.app')

@section('title', 'All Posts | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Posts</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Posts</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Post List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="{{ route('admin.post.add.new') }}" class="btn btn-sm btn-info" >Add New</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">SL</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-15p">Post name (EN)</th>
                            <th class="wd-15p">Post name (BN)</th>
                            <th class="wd-10p">Category</th>
                            <th class="wd-15p">Tags</th>
                            <th class="wd-10p">Created</th>
                            <th class="wd-15">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($all_post as $key => $val)
                        <tr>
                            <td>{{ $all_post->firstItem() + $key }}</td>
                            <td><img src="{{ asset($val->featured_image ? $val->featured_image : 'uploads/no-image/no-image.png') }}"
                                     width="80px" height="50px"></td>
                            <td>{{ $val->post_title_en }}</td>
                            <td>{{ $val->post_title_bn ? $val->post_title_bn : "N/A" }}</td>
                            <td><span class="badge badge-info">{{ $val->get_post_category->category_name_en }}</span></td>
                            @php
                            $val_tag = $val->tag_name;
                            $tags = explode(',', $val_tag);
                            @endphp
                            <td>
                                @forelse($tags as $row)
                                <span class="badge badge-primary">{{ $row }}</span>
                                @empty
                                    <span class="badge badge-danger">{{ "N/A" }}</span>
                                @endforelse
                            </td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                @if ($val->status == 1)
                                    <a href="{{ route('admin.post.inactive', $val->id) }}" class="btn btn-sm btn-warning">Disable</a>
                                    <a href="{{ route('single.blog.page', [$val->slug, Str::random(30)]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-lg" title="VIEW"></i></a>
                                    <a href="{{ route('admin.post.edit', $val->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil fa-lg" title="EDIT"></i></a>
                                    <a href="{{ route('admin.post.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @else
                                    <a href="{{ route('admin.post.active', $val->id) }}" class="btn btn-sm btn-success">Enable</a>
                                    <a href="{{ route('admin.post.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE POST HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="{{ route('admin.post.add.new') }}" class="btn btn-md btn-info" >Create First POST</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $all_post->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
