@extends('layouts.simple.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Posts</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item">List</li>
@endsection

@section('content')
    <div class="container-fluid">
        @include('layouts.buttons.create-btn', [$createRoute])
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered display datatables data-table p-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatable-global-setting.js') }}"></script>
    <script src="{{ asset('js/delete-btn.js') }}"></script>
    <script>
        $(function ()
        {
            var table = $('.data-table').DataTable(
            {
                ajax: "{{ route('posts.index') }}",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'category', name: 'category'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'updated_by', name: 'updated_by'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
