<h5 onclick="showExperience();">{{ __('Experience') }}</h5>

<div class="row">
    <div class="col-md-12">
        <div class="" id="experience_div">
        </div>
    </div>
</div>
<a href="javascript:;" onclick="showProfileExperienceModal();"> {{ __('Add Experience') }}
</a>
<hr>
<div class="modal" id="add_experience_modal" role="dialog">
</div>
@push('styles')
    <style type="text/css">
        .datepicker>div {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        function showProfileExperienceModal() {
            $("#add_experience_modal").modal();
            loadProfileExperienceForm();
        }

        function loadProfileExperienceForm() {
            $.ajax({
                type: "POST",
                url: "{{ route('get.front.profile.experience.form', $user->id) }}",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                datatype: 'json',
                success: function(json) {
                    $("#add_experience_modal").html(json.html);
                    initdatepicker();
                    filterDefaultStatesExperience(0, 0);

                    $('.selected-remote').select2({
                        width: 'resolve',
                        placeholder: 'Ocupacíon',
                        ajax: {
                            url: '/api/proffesions',
                            dataType: 'json'
                        }
                    });
                }
            });
        }

        function showProfileExperienceEditModal(profile_experience_id, state_id, city_id) {
            $("#add_experience_modal").modal();
            loadProfileExperienceEditForm(profile_experience_id, state_id, city_id);
        }

        function loadProfileExperienceEditForm(profile_experience_id, state_id, city_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('get.front.profile.experience.edit.form', $user->id) }}",
                data: {
                    "profile_experience_id": profile_experience_id,
                    "_token": "{{ csrf_token() }}"
                },
                datatype: 'json',
                success: async function(json) {
                    $("#add_experience_modal").html(json.html);
                    initdatepicker();
                    filterDefaultStatesExperience(state_id, city_id);


                    var profession = await document.getElementById('profession').getAttribute("value");

                    $('.selected-remote').select2({
                        width: 'resolve',
                        ajax: {
                            url: '/api/proffesions',
                            dataType: 'json'
                        }
                    });

                    var studentSelect = $('.selected-remote');
                    $.ajax({
                        type: 'GET',
                        url: '/api/proffesions?name=' + profession
                    }).then(function(data) {
                        var option = new Option(data.text, data.id, true, true);
                        studentSelect.append(option).trigger('change');
                    });

                }
            });
        }

        function submitProfileExperienceForm() {
            var form = $('#add_edit_profile_experience');
            let cities = document.getElementsByName('city_id');
            let city = cities[1];
            var formData = new FormData();
            formData.append("_token", $('input[name=_token]').val());
            formData.append("title", $('#titleExp').val());
            formData.append("company", $('#companyExp').val());
            formData.append("country_id", $('#country_id').val());
            formData.append("state_id", $('#experience_state_id').val());
            formData.append("city_id", city.value);
            formData.append("date_start", $('#date_startExp').val());
            formData.append("date_end", $('#date_endExp').val());
            formData.append("is_currently_working", $('#is_currently_working').val());
            formData.append("description", $('#descriptionExp').val());
            formData.append("position", $('#position').val());
            formData.append("profession", $('#profession').val());
            if (document.getElementById("adjunto").value != "") {
                formData.append("file", $('#adjunto')[0].files[0]);
            }
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(json) {
                    $("#add_experience_modal").html(json.html);
                    showExperience();
                },
                error: function(json) {
                    if (json.status === 422) {
                        var resJSON = json.responseJSON;
                        $('.help-block').html('');
                        $.each(resJSON.errors, function(key, value) {
                            if (key == 'file') key = 'adjunto'
                            $('.' + key + '-error').html(' <strong > ' + value + ' </strong>');
                            $('#div_' + key).addClass('has-error');
                        });
                    } else {}
                }
            });
        }

        function delete_profile_experience(id) {
            var msg = "{{ __('Are you sure! you want to delete?') }}";
            if (confirm(msg)) {
                $.post("{{ route('delete.front.profile.experience') }}", {
                    id: id,
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    if (response == 'ok') {
                        $('#experience_' + id).remove();
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }

        function initdatepicker() {
            $(".datepicker").datepicker({
                autoclose: true,
                format: 'yyyy-m-d'
            });
        }
        $(document).ready(function() {
            showExperience();
            initdatepicker();
            $(document).on('change', '#experience_country_id', function(e) {
                e.preventDefault();
                filterDefaultStatesExperience(0, 0);
            });
            $(document).on('change', '#experience_state_id', function(e) {
                e.preventDefault();
                filterDefaultCitiesExperience(0);
            });
        });

        function showExperience() {
            $.post("{{ route('show.front.profile.experience', $user->id) }}", {
                user_id: {{ $user->id }},
                _method: 'POST',
                _token: '{{ csrf_token() }}'
            }).done(function(response) {
                $('#experience_div').html(response);
            });
        }

        function filterDefaultStatesExperience(state_id, city_id) {
            var country_id = $('#experience_country_id').val();
            if (country_id != '') {
                $.post("{{ route('filter.lang.states.dropdown') }}", {
                    country_id: country_id,
                    state_id: state_id,
                    new_state_id: 'experience_state_id',
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    $('#default_state_experience_dd').html(response);
                    filterDefaultCitiesExperience(city_id);
                });
            }
        }

        function filterDefaultCitiesExperience(city_id) {
            var state_id = $('#experience_state_id').val();
            if (state_id != '') {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {
                    state_id: state_id,
                    city_id: city_id,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    $('#default_city_experience_dd').html(response);
                });
            }
        }
    </script>
@endpush
