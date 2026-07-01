<h5>Gestion de Contraseña</h5>
<div class="row">
    <div class="col-md-12">
        <form class="form" id="changepassform" method="POST" action="{{ route('change-pass', [$user->id]) }}">
            {{ csrf_field() }}
            <div class="form-body">
                
                <div id="success_msg"></div>
                
                <input type="hidden" name="id" class="form-control textC" value="{{$user->id}}">
                
                <div class="formrow {!! APFrmErrHelp::hasError($errors, 'pass') !!}">
                    <label>Contraseña actual</label>
                    <input type="password" name="pass" class="form-control textC" id="pass" placeholder="**********">
                    <span class="help-block text-danger pass-error"></span>
                </div>
                <div class="formrow">
                    <label>Nueva Contraseña</label>
                    <input type="password" name="repass" class="form-control textC" id="repass" placeholder="**********">
                    <span class="help-block text-danger repass-error"></span>
                </div>
                <button type="button" class="btn btn-large btn-primary" onClick="submitChangePass();">Actualizar<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    function submitChangePass() {
        var form = $('#changepassform');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(json) {
                alert('Actualizacion correcta')
                $("#success_msg").html("<span class='text text-success'>{{__('Summary updated successfully')}}</span>");
            },
            error: function(json) {
                if (json.status === 422) {
                    var resJSON = json.responseJSON;
                    $('.help-block').html('');
                    $.each(resJSON.errors, function(key, value) {
                        $('.' + key + '-error').html('<strong>' + value + '</strong>');
                        $('#div_' + key).addClass('has-error');
                    });
                } else {
                    // Error
                    // Incorrect credentials
                    alert('La contraseña no coincide con tu contraseña actual')
                }
            }
        });
    }
</script>
@endpush