@extends('admin.layouts.app')

@section('title', 'All Reviews | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Reviews</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Product Reviews</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Review List</h6>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">SL</th>
                            <th class="wd-10p">Customer Name</th>
                            <th class="wd-10p">Product Code</th>
                            <th class="wd-5p">Rating</th>
                            <th class="wd-60p">Comment</th>
                            <th class="wd-5p">Created</th>
                            <th class="wd-5p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($review as $key => $val)
                            @php
                                $review_count = $val->ratings + $val->value + $val->price;
                                $total = round($review_count / 3, 1);
                            @endphp
                        <tr>
                            <td>{{ $review->firstItem() + $key }}</td>
                            <td>{{ $val->user->name }}</td>
                            <td>{{ $val->product->product_code }}</td>
                            <td>{{ $total }} Star</td>
                            <td>{{ $val->review }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>
{{--                                <a href="{{ route('admin.category.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>--}}
                                <a href="{{ route('admin.review.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE REVIEWS HERE</h3>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $review->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
