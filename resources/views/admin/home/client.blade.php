@extends('admin.layouts.master')
@section('title')
Client
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
            <h3 class="card-title">Client List</h3>
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
                        <form action="{{ Route('admin.home.client.add') }}" id="frmnewvalue" novalidate method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <label>Image</label>
                           
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

                                <label>Image Two</label>
                           
                                <div align="center">
                                    <img id="imgvaluetwo" alt="" style="width: 50%">
                                </div>
                                <br>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                                        onchange="desc(event,'imgvaluetwo');" name="imagetwo" required>
                                    <div class="invalid-feedback">
                                        Please choose an image.
                                    </div>
                                    <label class="custom-file-label" for="customFile">Choose file...</label>
                                </div>
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
                <table id="example1" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                     
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot style="display: table-header-group">
                        <tr class="filters">
                            <th></th>
                            <th></th>
          
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ( $client as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td align="center"><img src="{{ asset($value->image) }}" style="width:100px"></td>
                   
                                <td align="center">
                               
                                        <a type="button" class="btn btn-sm btn-success"data-toggle="modal"
                                            data-target="#edt{{ $value->id }}"><i class="fas fa-edit"></i></a>
                                        <a type="button" class="btn btn-sm btn-danger"data-toggle="modal"
                                            data-target="#dlt{{ $value->id }}"><i class="fas fa-trash"></i></a>
                                
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
                                        <form action="{{ Route('admin.home.client.update', $value->id) }}"
                                            class="frmvalueedit{{ $value->id }}"
                                            id="frmvalueedit{{ $value->id }}" novalidate method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Image</label>
                                           
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
                                             
                                                <label>Image Two</label>
                                            
                                                <div align="center">
                                                    <img id="imgvaluetwo{{ $value->id }}"
                                                        src="{{ asset($value->imagetwo) }}" alt=""
                                                        style="width: 50%">
                                                </div>
                                                <br>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" accept="image/*"
                                                        id="customFile"
                                                        onchange="desc(event,'imgvaluetwo{{ $value->id }}');"
                                                        name="imagetwo">
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
                                            <label>Are you sure you want delete this client?</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <a href="{{ Route('admin.home.client.delete', $value->id) }}"
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
