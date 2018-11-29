@extends('admin.layouts.main')
@section('content')
<table class="table table-bordered" id="listUsers" style="margin-bottom: 10px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>action</th>
        </tr>
    </tfoot>
    </table>

    @endsection
    @section('js')
<script>
    $(function() {
    $('#listUsers').DataTable({
        dom: 'lifrtp',
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('users.getData')}}",
        },
        columns: [
            { data: 'id', name: 'users.id' },
            { data: 'name', name: 'users.name' },
            { data: 'email', name: 'users.email' },
            { data: 'created_at', name: 'users.created_at' },
            { data: 'updated_at', name: 'users.updated_at' }
        ]
    });
});
</script>
    @endsection