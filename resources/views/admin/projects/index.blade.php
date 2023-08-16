@extends('admin.layouts.master')
@section('title')
Projects
@endsection
@section('content')
<style>
    td{
        font-size:14px;
   
        align-items:center;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Projects
                    <a href="{{ url('admin/projects/create') }}" class="btn btn-primary btn-sm float-end">
                        Add Projects
</a>
                </h3>
</div>

<div class="card-body">

<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Project</th>
     
            <th>status</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($projects as $project)
    <tr>
        <td>{{ $project->id }}</td>
        <td>
            @if(count($project->categories))
        @foreach($project->categories as $category)    
        {{ $category->name}},
        @endforeach
        @else
        No categories
        @endif
    </td>
        <td>{{ $project->name  }}</td>

        <td>{{ $project->status == '1' ? 'Hidden':'Visible' }}</td>
        <td>
            <a href="{{ url('admin/projects/'.$project->id.'/edit') }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ url('admin/projects/'.$project->id.'/delete') }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
            <a href="{{ url('admin/projects/'.$project->id.'/images') }}" class="btn btn-sm btn-info"><i class="fas fa-images"></i></a>
         
        </td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Projects Available</rd>
</tr>
    @endforelse

</tbody>
</table>

</div>
</div>
</div>
</div>
@endsection
