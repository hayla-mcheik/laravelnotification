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
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Agency</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" id="frm1" enctype="multipart/form-data"
                action="{{ Route('admin.agency.agency.update') }}" novalidate>
                @csrf
             
                <div align="center">
                    <img alt="" id="video" src="{{ asset( $agency->video) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="video/*" id="customFile"
                        onchange="desc(event,'video');" name="video">
                    <div class="invalid-feedback">
                        Please choose a video.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose video...</label>
                </div>
       

                <label>Description</label>
                <textarea name="agencydescr" id="description" required>{{ $agency->agencydescr }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#description').summernote();
                </script>
                <br>

                <br>
                <label>Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $agency->title }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a title.
                </div>
                <br>

                <label>Small Title</label>
                <input type="text" name="agencytitle" id="title" class="form-control" value="{{ $agency->agencytitle }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a small title.
                </div>
                <br>

                <label>Methodology Description one</label>
                <textarea name="agencydesc" id="descriptionone" required>{{ $agency->agencydesc }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#descriptionone').summernote();
                </script>
                <br>



                <label>Small Title two</label>
                <input type="text" name="agencytitletwo" id="title" class="form-control" value="{{ $agency->agencytitletwo }}"
                    required>
                <div class="invalid-feedback">
                Please enter a small title.
                </div>
                <br>

                <label>Methodology Description two</label>
                <textarea name="agencydesctwo" id="descriptiontwo" required>{{ $agency->agencydesctwo }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#descriptiontwo').summernote();
                </script>
                <br>


                <label>Small Title Three</label>
                <input type="text" name="agencytitlethree" id="title" class="form-control" value="{{ $agency->agencytitlethree }}"
                    required>
                <div class="invalid-feedback">
                Please enter a small title.
                </div>
                <br>

                <label>Methodology Description three</label>
                <textarea name="agencydescthree" id="descriptionthree" required>{{ $agency->agencydescthree }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#descriptionthree').summernote();
                </script>
                <br>

                <label>Small Title Four</label>
                <input type="text" name="agencytitlefour" id="title" class="form-control" value="{{ $agency->agencytitlefour }}"
                    required>
                <div class="invalid-feedback">
                Please enter a small title.
                </div>
                <br>

                <label>Methodology Description Four</label>
                <textarea name="agencydescfour" id="descriptionfour" required>{{ $agency->agencydescfour }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#descriptionfour').summernote();
                </script>
                <br>


                <label>Animated Text</label>
                <input type="text" name="animattext" id="title" class="form-control" value="{{ $agency->animattext }}"
                    required>
                <div class="invalid-feedback">
                Please enter a text.
                </div>
                <br>



                <label>Title</label>
                <input type="text" name="gettrs" id="title" class="form-control" value="{{ $agency->gettrs }}"
                    required>
                <div class="invalid-feedback">
                Please enter a title.
                </div>
                <br>

                <label>Description</label>
                <textarea name="getrsdesc" id="descriptionfive" required>{{ $agency->getrsdesc }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#descriptionfive').summernote();
                </script>
                <br>


                <div align="center">
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('#frm1')

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
