@extends('admin.layouts.app')

@section('title', 'All Newsletters | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Newsletter Email</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Newsletters</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Email List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="#" class="btn btn-sm btn-danger" id="delete">Select all Delete</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p"><input type="checkbox" name="sample" id="checkAll" class="form-control"/></th>
                            <th class="wd-5p">SL</th>
                            <th class="wd-20p">Email</th>
                            <th class="wd-20p">Created</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newsletters as $key => $val)
                        <tr>
                            <td><input type="checkbox" name="sample" id="checkItem" class="form-control"/></td>
                            <td>{{ $newsletters->firstItem() + $key }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                <a href="{{ route('admin.newsletter.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $newsletters->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection

@section('admin-js')
    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
