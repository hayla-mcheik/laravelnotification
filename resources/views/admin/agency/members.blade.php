@extends('admin.layouts.master')
@section('title')
Agency
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

    <br>
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Our Team</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <div style="float: right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addnew">Add New</button>
            </div>
            <br>
            <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnew"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ Route('admin.agency.members.add') }}" id="frmnewvalue" novalidate method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <label>Image</label>
                                <br>
                                <div align="center">
                                    <img id="imgvalue" alt="" style="width: 50%">
                                </div>
                                <br>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                                        onchange="desc(event,'imgvalue');" name="image" required>
                                    <div class="invalid-feedback">
                                        Please choose an image.
                                    </div>
                                    <label class="custom-file-label" for="customFile">Choose file...</label>
                                </div>
                                <br>


                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter a title
            </div>
            </br>

            <label>Job</label>
                                <input type="text" name="job" id="job" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter a job
            </div>
            </br>

            <label>Quote</label>
                                <input type="text" name="quote" id="quote" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter a quote
            </div>
            </br>


            <label>Small Text</label>
                                <input type="text" name="text" id="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter a text
            </div>
            </br>

            <label>Description</label>
                            <textarea name="description" id="description" required></textarea>
                            <div class="invalid-feedback">
                                Please enter description.
                            </div>
                            <br>
                            <script>
                                $('#description').summernote();
                            </script>
            <br>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict'
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('#frmadd')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                })()
            </script>
             <div class="card-body filterable">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Job</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot style="display: table-header-group">
                        <tr class="filters">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ( $team as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->job }}</td>
                                <td align="center"><img src="{{ asset($value->image) }}" style="width:100px"></td>
                   
                                <td align="center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edt{{ $value->id }}"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#dlt{{ $value->id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="edt{{ $value->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="addnew" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit offer</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ Route('admin.agency.members.update', $value->id) }}"
                                            class="frmvalueedit{{ $value->id }}"
                                            id="frmvalueedit{{ $value->id }}" novalidate method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Image</label>
                                                <br>
                                                <div align="center">
                                                    <img id="imgvalue{{ $value->id }}"
                                                        src="{{ asset($value->image) }}" alt=""
                                                        style="width: 50%">
                                                </div>
                                                <br>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" accept="image/*"
                                                        id="customFile"
                                                        onchange="desc(event,'imgvalue{{ $value->id }}');"
                                                        name="image">
                                                    <div class="invalid-feedback">
                                                        Please choose an image.
                                                    </div>
                                                    <script>
                                                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                                                        (function() {
                                                            'use strict'

                                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                            var forms = document.querySelectorAll('#frmvalueedit{{ $value->id }}')

                                                            // Loop over them and prevent submission
                                                            Array.prototype.slice.call(forms)
                                                                .forEach(function(form) {
                                                                    form.addEventListener('submit', function(event) {
                                                                        if (!form.checkValidity()) {
                                                                            event.preventDefault()
                                                                            event.stopPropagation()
                                                                        }

                                                                        form.classList.add('was-validated')
                                                                    }, false)
                                                                })
                                                        })
                                                        ()
                                                    </script>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file...</label>
                                                </div>
                                                <br>
                                             
                                                <label>Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ $value->title }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a title.
                                            </div>
<br>

<label>Job</label>
                                            <input type="text" name="job" id="job" class="form-control"
                                                value="{{ $value->job }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a job .
                                            </div>
<br>

<label>Quote</label>
                                            <input type="text" name="quote" id="quote" class="form-control"
                                                value="{{ $value->quote }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a quote.
                                            </div>
<br>
<label>Small Text</label>
                                            <input type="text" name="text" id="text" class="form-control"
                                                value="{{ $value->text }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a quote.
                                            </div>
<br>

<label>Description</label>
                                            <textarea type="text" name="description"  id="description{{ $value->id }}" class="form-control" required>{{ $value->description }}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a description.
                                            </div>
                                            <script>
                                                $('#description{{ $value->id }}').summernote();
                                            </script>
                                            <br>
                                            
                                  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <div class="modal fade" id="dlt{{ $value->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="addnew" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete value</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <label>Are you sure you want delete this member?</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <a href="{{ Route('admin.agency.members.delete', $value->id) }}"
                                                class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "searching": false,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 25,
                "lengthMenu": [25, 50, 75, 100],
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        function matchStart(term, text) {
            if (text.toUpperCase().indexOf(term.toUpperCase()) == 0) {
                return true;
            }

            return false;
        }

        $.fn.select2.amd.require(['select2/compat/matcher'], function(oldMatcher) {
            $(".select2").select2({
                matcher: oldMatcher(matchStart),
            });
            $("#category_id").select2({
                matcher: oldMatcher(matchStart),
            })
        });
        $('#deadline').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
