@extends('admin.layouts.master')
@section('title')
Agency images
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
            <h3 class="card-title">Agency images</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" id="frm1" enctype="multipart/form-data"
                action="{{ Route('admin.agency.images.update') }}" novalidate>
                @csrf
                <div align="center">
                    <img alt="" id="imgone" src="{{ asset( $agencyimages->imageone) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgone');" name="imageone">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
                <br>
                <div align="center">
                    <img alt="" id="imgtwo" src="{{ asset( $agencyimages->imagetwo) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgtwo');" name="imagetwo">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
                <br>
                <div align="center">
                    <img alt="" id="imgthree" src="{{ asset( $agencyimages->imagethree) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgthree');" name="imagethree">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
                <br>
                <div align="center">
                    <img alt="" id="imgfour" src="{{ asset( $agencyimages->imagefour) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgfour');" name="imagefour">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
                <br>
                <div align="center">
                    <img alt="" id="imgfive" src="{{ asset( $agencyimages->imagefive) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgfive');" name="imagefive">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
                <br>
                <div align="center">
                    <img alt="" id="imgsix" src="{{ asset( $agencyimages->imagesix) }}" width="50%">
                </div>
                <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*" id="customFile"
                        onchange="desc(event,'imgsix');" name="imagesix">
                    <div class="invalid-feedback">
                        Please choose an image.
                    </div>
                    <label class="custom-file-label" for="customFile">Choose file...</label>
                </div>
       
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
