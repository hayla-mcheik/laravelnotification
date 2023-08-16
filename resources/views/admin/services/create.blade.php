@extends('admin.layouts.master')
@section('title')
Services
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Services
                    <a href="{{ url('admin/services/create') }}" class="btn btn-danger btn-sm float-end">
                        Back
</a>
                </h3>
</div>

<div class="card-body">

@if($errors->any())
<div class="alert alert-warning">
    @foreach($errors->all() as $error)
    <div>{{ $error }} </div>
    @endforeach
</div>
@endif

<form action="{{ url('admin/services') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="mb-3">
<label>Category</label>
<select name="category_id" class="form-control">
    @foreach($categoryservice as $category)
    <option value ="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
</div>

<div class="mb-3">
<label> Name</label>
<input type="text" name="name"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>


<div class="mb-3">
<label>Description</label>
                            <textarea name="description" id="description" row="7" ></textarea>
                            <div class="invalid-feedback">
                                Please enter description.
                            </div>
                            <br>
                            <script>
                                $('#description').summernote();
                            </script>
   </div> 


   <div class="mb-3">
<label>Services</label>
                            <textarea name="services" id="descriptionn" ></textarea>
                            <div class="invalid-feedback">
                                Please enter services.
                            </div>
                            <br>
                            <script>
                                $('#descriptionn').summernote();
                            </script>
   </div> 


<div class="mb-3">
<label>Upload Image</label>
<input type="file" name="image[]" multiple class="form-control">
</div>

<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox" name="status"  />
</div>

<div class="col-md-12 mb-3">
    <button type="btn" class="btn btn-primary float-end">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection
