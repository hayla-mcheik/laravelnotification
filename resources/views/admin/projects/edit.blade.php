@inject('images','App\Models\ProjectImage')
@extends('admin.layouts.master')
@section('title')
Projects
@endsection
@section('content')
<script>
        var desc = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script>
<style>
   option:checked {
        background:#00E546 !important;
    }
    </style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Projects
                    <a href="{{ url('admin/projects') }}" class="btn btn-danger btn-sm float-end">
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

<form action="{{ route('admin.home.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="mb-3">
<label>Category:</label>
<label>Press CTRL for multiple selection </label>
<div id="dropdown1">
<select name="categories[]" multiple class="form-control">
    @foreach($categories as $category)
    <option type="checkbox" value ="{{ $category->id }}" {{ count($project->categories->where('id', $category->id)) ? 'selected':'' }}>
        {{ $category->name }}
    </option>
    @endforeach
</select>
</div>
</div>

<div class="mb-3">
<label>Project Name</label>
<input type="text" name="name"  value="{{ $project->name}}" class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
<div class="mb-3">
<label>Project Slug</label>
<input type="text" name="slug" value="{{ $project->slug}}" class="form-control"/>
@error('slug') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Title</label>
<input type="text" name="titletwo" value="{{ $project->titletwo}}" class="form-control"/>
@error('titletwo') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Description</label>
                                            <textarea type="text" name="description"  id="description{{ $project->id }}" class="form-control" required>{{ $project->description }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#description{{ $project->id }}').summernote();
                                            </script>
                                            <br>                       
   </div>


   <div class="mb-3">
<label>Description Details</label>
                                            <textarea type="text" name="titlethree"  id="titlethree{{ $project->id }}" class="form-control" required>{{ $project->titlethree }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#titlethree{{ $project->id }}').summernote();
                                            </script>
                                            <br>                       
   </div>

   <div class="mb-3">
<label>Width</label>
<input type="text" name="width" value="{{ $project->width}}" class="form-control"/>
@error('width') <small>{{ $message}}</small> @enderror
</div>



<div class="mb-3">
<label>Type</label>
<input type="text" name="class" value="{{ $project->class}}" class="form-control"/>
@error('class') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox" {{ $project->status == '1' ? 'checked':'' }} name="status"  />
</div>


<div class="mb-3">
<label>Featured</label><br/>
<input type="checkbox" {{ $project->featured == '1' ? 'checked':'' }} name="featured"  />
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
