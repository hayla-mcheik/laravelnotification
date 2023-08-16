@extends('admin.layouts.master')
@section('title')
Services
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">                                                     
        <div class="card">
            <div class="card-header">
                <h3>Edit Services
                    <a href="{{ url('admin/services/edit') }}" class="btn btn-danger btn-sm float-end">
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

<form action="{{ url('admin/services/'.$service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="mb-3">
<label>Category</label>
<select name="category_id" class="form-control">
    @foreach($categoryservice as $category)
    <option value ="{{ $category->id }}"  {{ $category->id == $service->category_id ? 'selected':'' }}>{{ $category->name }}</option>
    @endforeach
</select>
</div>

<div class="mb-3">
<label> Name</label>
<input type="text" name="name" value="{{ $service->name }}" class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Description</label>
                                            <textarea type="text" name="description"  id="description{{ $service->id }}" class="form-control" row="7" required>{{ $service->description }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#description{{ $service->id }}').summernote();
                                            </script>
                                            <br>
                                            
   </div> 
<div class="mb-3">
<label>Services</label>
                                            <textarea type="text" name="services"  id="descriptionn{{ $service->id }}" class="form-control" required>{{ $service->services }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#descriptionn{{ $service->id }}').summernote();
                                            </script>
                                            <br>
                                            
   </div> 

<div class="mb-3">
<label>Upload Image</label>
<input type="file" name="image[]" multiple class="form-control">
</div>
<div>
    @if( $service->servicesimages)
<div class="row">
@foreach($service->servicesimages as $image)
    <div class="col-md-2">
    <img src="{{ asset($image->image) }}" style="width:80px;height:80px;"
    class="me-4 border" alt="Img" />
<a href="{{ url('admin/services-image/'.$image->id.'/delete') }}" class="d-block" >Remove</a>
</div>
@endforeach
</div>



    @else
    <h5>No Image Added</h5>
    @endif
</div>

<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox" name="status" {{ $service->status =='1' ? 'checked':'' }} />
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
