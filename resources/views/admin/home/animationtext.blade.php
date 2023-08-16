@extends('admin.layouts.master')
@section('title')
infinite text
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
            <h3 class="card-title">Infinite Text</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" id="frm1" enctype="multipart/form-data"
                action="{{  Route('admin.home.animation.text') }}" novalidate>
                @csrf
     
                <br>
                <label>Home infnite text one</label>
                <input type="text" name="titleone" id="titleone" class="form-control" value="{{   $animationtext->titleone }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a title.
                </div>
                <br>
       

                <br>
                <label>Home infinite text two</label>
                <input type="text" name="titletwo" id="titletwo" class="form-control" value="{{   $animationtext->titletwo }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a title.
                </div>
                <br>

                <br>
                <label>Agency infinite text one</label>
                <input type="text" name="titlethree" id="titlethree" class="form-control" value="{{   $animationtext->titlethree }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a title.
                </div>
                <br>
                <label>gency infinite text two</label>
                <input type="text" name="titlefour" id="titlefour" class="form-control" value="{{   $animationtext->titlefour }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a title.
                </div>
                <br>
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
