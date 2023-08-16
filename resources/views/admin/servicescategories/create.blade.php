@extends('admin.layouts.master')
@section('title')
Category Services
@endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category
                    <a href="{{ url('admin/service/category/create') }}" class="btn btn-primary btn-sm float-end">Back
</a>
                </h3>
</div>

<div class="card-body">
    <form action="{{ url('admin/service/category') }}" method="POST">
        @csrf
        <div class="row">
        <div class="mb-3">
<label>Name</label>
<input type="text" name="name"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Slug</label>
<input type="text" name="slug"  class="form-control"/>
@error('slug') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox" name="status"  />
</div>

<div class="col-md-12 mb-3">
    <button type="btn" class="btn btn-primary float-end">Save</button>
</div>
</div>
</form>
</div>

</div>
</div>
</div>

@endsection
