@extends('admin.layouts.master')
@section('title')
Category categories_services
@endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category
                    <a href="{{ url('admin/service/category') }}" class="btn btn-primary btn-sm float-end">Back
</a>
                </h3>
</div>

<div class="card-body">
    <form action="{{ url('admin/service/category/'.$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="mb-3">
<label>Name</label>
<input type="text" name="name"  value="{{ $category->name }}" class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Slug</label>
<input type="text" name="slug" value="{{ $category->slug }}" class="form-control"/>
@error('slug') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox"  name="status"  {{ $category->status == '1' ? 'checked':'' }} />
</div>

<div class="col-md-12 mb-3">
    <button type="btn" class="btn btn-primary float-end">Update</button>
</div>
</div>
</form>
</div>

</div>
</div>
</div>

@endsection
