@extends('admin.layouts.master')
@section('title')
Case Studies
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Case Studies
                    <a href=""{{ url('admin/casestudies') }}"" class="btn btn-danger btn-sm float-end">
                        Back
</a>
                </h3>
</div>

<div class="card-body">

@if($errors->any())
<div class="alert alert-warning">
    @foreach($errors->all() as $error)
    <div>"{{ $error }}" </div>
    @endforeach
</div>
@endif

<form action="{{ url('admin/casestudies/'.$casestudies->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">




<div class="mb-3">
<label>Title One</label>
<input type="text" name="titleone"  value="{{ $casestudies->titleone }}"  class="form-control"/>
@error('titleone') <small>"{{ $message}}</small> @enderror
</div>


<div class="mb-3">
<label>Description One</label>
                                            <textarea type="text" name="descone"  id="description{{ $casestudies->id }}" class="form-control" required>{{ $casestudies->descone }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#description{{ $casestudies->id }}').summernote();
                                            </script>
                                            <br>                       
   </div>

<div class="mb-3">
<label>Title Two</label>
<input type="text" name="titletwo"  value="{{ $casestudies->titletwo }}"  class="form-control"/>
@error('titletwo') <small>"{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Description Two</label>
                                            <textarea type="text" name="desctwo"  id="descriptiontwo{{ $casestudies->id }}" class="form-control" required>{{ $casestudies->desctwo }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#descriptiontwo{{ $casestudies->id }}').summernote();
                                            </script>
                                            <br>                       
   </div>

<div class="mb-3">
<label>Title Three</label>
<input type="text" name="titlethree" value="{{ $casestudies->titlethree }}"  class="form-control"/>
@error('titlethree') <small>"{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Description Three</label>
                                            <textarea type="text" name="descthree"  id="descriptionthree{{ $casestudies->id }}" class="form-control" required>{{ $casestudies->descthree }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#descriptionthree{{ $casestudies->id }}').summernote();
                                            </script>
                                            <br>                       
   </div>





   <div class="mb-3">
<label>Type One</label>
<input type="text" name="textone"  class="form-control"  value="{{ $casestudies->textone }}" />
@error('textone') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Type Two</label>
<input type="text" name="texttwo"  class="form-control"  value="{{ $casestudies->texttwo }}" />
@error('texttwo') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Type Three</label>
<input type="text" name="textthree"  class="form-control"  value="{{ $casestudies->textthree }}" />
@error('textthree') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
<label>Span One</label>
<input type="text" name="spanone"  class="form-control"  value="{{ $casestudies->spanone }}" />
@error('spanone') <small>{{ $message }}</small> @enderror
</div>

<div class="mb-3">
<label>Span Two</label>
<input type="text" name="spantwo"  class="form-control"  value="{{ $casestudies->spantwo }}" />
@error('spantwo') <small>{{ $message }}</small> @enderror
</div>

<div class="mb-3">
<label>Span Three</label>
<input type="text" name="spanthree"  class="form-control"  value="{{ $casestudies->spanthree }}" />
@error('spanthree') <small>{{ $message }}</small> @enderror
</div>





<div class="mb-3">
<label>Disclaimer</label>
<input type="text" name="disclaimer"   value="{{ $casestudies->disclaimer }}" class="form-control"/>
@error('disclaimer') <small>"{{ $message}}</small> @enderror
</div>


<div class="mb-3">
<div class="form-group">
<label>Color picker:</label>
<input type="color" name="color" value="{{ $casestudies->color }}" class="form-control" >
</div>


</div>







<div class="mb-3">
<label>Status</label><br/>
<input type="checkbox" {{  $casestudies->status == '1' ? 'checked':'' }} name="status"  />
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
