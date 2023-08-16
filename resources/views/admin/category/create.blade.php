@extends('admin.layouts.master')
@section('title')
Category
@endsection
@section('content')

<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch-checkbox {
  display: none;
}

.switch-label {
  position: absolute;
  top: 0;
  left: 80px;
  width: 100%;
  height: 100%;
  background-color: #ccc;
  border-radius: 12px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.switch-checkbox:checked + .switch-label {
  background-color: #66bb6a; /* Color when switch is ON */
}

.switch-label::after {
  content: "";
  position: absolute;
  top: 2px;
  left: 2px;
  width: 20px;
  height: 20px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s;
}

.switch-checkbox:checked + .switch-label::after {
  transform: translateX(26px); /* Move the circle to the right when switch is ON */
}

    </style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Back
</a>
                </h3>
</div>

<div class="card-body">
    <form action="{{ url('admin/category') }}" method="POST">
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



<div class="switch mb-3">
<label>Status:</label>
  <input type="checkbox" id="switch-checkbox" class="switch-checkbox mx-5">
  <label for="switch-checkbox" class="switch-label"></label>
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
