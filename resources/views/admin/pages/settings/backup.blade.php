@extends('admin.layouts.app')

@section('title', 'Backup Files & Database | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Backup</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Backup Files</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Backup List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="{{ route('app.backups.store') }}" class="btn btn-sm btn-info">Create New</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">SL</th>
                            <th class="wd-20p">File Name</th>
                            <th class="wd-10p">Size</th>
                            <th class="wd-25p">Created</th>
                            <th class="wd-10p">Download</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($backups as $key => $backup)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $backup['file_name'] }}</td>
                                    <td>{{ $backup['file_size'] }}</td>
                                    <td>{{ $backup['created_at'] }}</td>
                                    <td >
                                        <a class="btn btn-info btn-sm" href="{{ route('app.backups.download',$backup['file_name']) }}"><i
                                                class="fa fa-download"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('app.backups.destroy',$backup['file_name']) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </a>
{{--                                        <form id="delete-form-{{ $key }}"--}}
{{--                                              action="{{ route('app.backups.destroy',$backup['file_name']) }}" method="POST"--}}
{{--                                              style="display: none;">--}}
{{--                                            @csrf()--}}
{{--                                            @method('DELETE')--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE BACKUP FILE HERE</h3>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
{{--                    {{ $files->links() }}--}}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
