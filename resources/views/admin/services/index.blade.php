@extends('admin.layouts.master')
@section('title')
Services
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Services
                    <a href="{{ url('admin/services/create') }}" class="btn btn-primary btn-sm float-end">
                        Add Services
</a>
                </h3>
</div>

<div class="card-body">

<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($service as $service)
    <tr>
        <td>{{ $service->id }}</td>
        <td>{{ $service->category->name ?? 'No category' }}</td>
        <td>{{ $service->name  }}</td>
        <td>{{ $service->status == '1' ? 'Hidden':'Visible' }}</td>
        <td>
            <a href="{{ url('admin/services/'.$service->id.'/edit') }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ url('admin/services/'.$service->id.'/delete') }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
        </td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Services Available</rd>
</tr>
    @endforelse

</tbody>
</table>

</div>
</div>
</div>
</div>
@endsection
