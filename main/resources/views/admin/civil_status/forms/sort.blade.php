{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort Civil Statuses</h3>
    {!! Form::select('lang', ['' => 'Select Language']+$languages, 'en', array('class'=>'form-control', 'id'=>'lang', 'onchange'=>'refreshCivilStatusSortData();')) !!}
    <div id="civilStatusSortDataDiv"></div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refreshCivilStatusSortData();
    });
    function refreshCivilStatusSortData() {
        var language = $('#lang').val();
        $.ajax({
            type: "GET",
            url: "{{ route('civil.status.sort.data') }}",
            data: {lang: language},
            success: function (responseData) {
                $("#civilStatusSortDataDiv").html('');
                $("#civilStatusSortDataDiv").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var civilStatusOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('civil.status.sort.update') }}", {civilStatusOrder: civilStatusOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script> 
@endpush