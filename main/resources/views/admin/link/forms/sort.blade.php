{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Enlaces</h3>
    {!! Form::select('lang', ['' => 'Select Language'] + $languages, config('default_lang'), [
        'class' => 'form-control',
        'id' => 'lang',
        'onchange' => 'refresh_link_sort_data();',
    ]) !!}
    <div id="link_sort_data_div">
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            refresh_link_sort_data();
        });

        function refresh_link_sort_data() {
            var language = $('#lang').val();
            $.ajax({
                type: "GET",
                url: "{{ route('link.sort.data') }}",
                data: {
                    lang: language
                },
                success: function(responseData) {
                    $("#link_sort_data_div").html('');
                    $("#link_sort_data_div").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        update: function(event, ui) {
                            var linkOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route('link.sort.update') }}", {
                                linkOrder: linkOrder,
                                _method: 'PUT',
                                _token: '{{ csrf_token() }}'
                            })
                        }
                    });
                    $("#sortable").disableSelection();
                    /***************************/
                }
            });
        }
    </script>
@endpush
