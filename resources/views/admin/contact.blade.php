@extends('admin.layouts.master')
@section('title')
Contact
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
            <h3 class="card-title">Contact</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" id="frm1" enctype="multipart/form-data"
                action="{{ Route('admin.contact.update') }}" novalidate>
                @csrf
                <br>
                <label>Subscribe Title</label>
                <input type="text" name="subsc_text" id="titleone" class="form-control" value="{{  $contact->subsc_text }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a subscribe title.
                </div>
                <br>


                <label>Subscribe footer</label>
                <textarea  name="subsc_footer" id="description" required>{{  $contact->subsc_footer }}</textarea>
                <div class="invalid-feedback">
                    Please enter description.
                </div>
                <script>
                    $('#description').summernote();
                </script>
                <br>

                <label>Dubai Location </label>
                <input type="text" name="loca_dubai" id="titlethree" class="form-control" value="{{  $contact->loca_dubai }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the dubai location.
                </div>
                <br>
                <label>Beirut Location</label>
                <input type="text" name="loca_beirut" id="titlefour" class="form-control" value="{{  $contact->loca_beirut }}"
                    required>
                <div class="invalid-feedback">
                    Please enter a beirut location.
                </div>
                <br>

                <label>Careers Email</label>
                <input type="text" name="email_join" id="titlefive" class="form-control" value="{{  $contact->email_join }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the careers email.
                </div>
                <br>
                <label>Work Email</label>
                <input type="text" name="email_work" id="titlesix" class="form-control" value="{{  $contact->email_work }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the work email.
                </div>
                <br>

                <label>Dubai Phone</label>
                <input type="text" name="dubai_phone" id="titlesix" class="form-control" value="{{  $contact->dubai_phone }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the dubai phone number.
                </div>
                <br>
                <label>Beirut Phone</label>
                <input type="text" name="beirut_phone" id="titlesix" class="form-control" value="{{  $contact->beirut_phone }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the beirut phone number.
                </div>
                <br>


                <label>Facebook</label>
                <input type="text" name="faceb" id="titleseven" class="form-control" value="{{  $contact->faceb }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the link of facebook.
                </div>
                <br>
                <label>Instagram</label>
                <input type="text" name="insta" id="titleeight" class="form-control" value="{{  $contact->insta }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the link of instagram.
                </div>
                <br>
                <label>Twitter</label>
                <input type="text" name="twitter" id="titlenine" class="form-control" value="{{  $contact->twitter }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the link of twitter.
                </div>
                <br>
                <label>Linkedin</label>
                <input type="text" name="linkedin" id="titleten" class="form-control" value="{{  $contact->linkedin }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the link of linkedin.
                </div>
                <br>
                <label>Youtube</label>
                <input type="text" name="youtube" id="titleeleven" class="form-control" value="{{  $contact->youtube }}"
                    required>
                <div class="invalid-feedback">
                    Please enter the link of youtube.
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
