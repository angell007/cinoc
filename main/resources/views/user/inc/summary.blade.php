<h5>{{__('Summary')}}</h5>
<div class="row">
    <div class="col-md-12">
        <form class="form" id="add_edit_profile_summary" method="POST" action="{{ route('update.front.profile.summary', [$user->id]) }}">
            {{ csrf_field() }}
            <div class="form-body">
                <div id="success_msg"></div>
                <div class="formrow {!! APFrmErrHelp::hasError($errors, 'summary') !!}">
                    <textarea name="summary" class="form-control textC" id="summary" placeholder="{{__('Profile Summary')}}">{{ old('summary', $user->getProfileSummary('summary')) }}</textarea>
                    <span class="help-block text-danger summary-error"></span>
                </div>
                <button type="button" class="btn btn-large btn-primary" onClick="submitProfileSummaryForm();">{{__('Update Summary')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="w-100 my-2"></div>

<h5>{{__('Aspiraciones futuras')}}</h5>
<div class="row">
    <div class="col-md-12">
        <form class="form" id="add_edit_profile_aspirations" method="POST" action="{{ route('update.front.profile.aspirations', [$user->id]) }}">
            {{ csrf_field() }}
            <div class="form-body">
                <div id="success_msg"></div>
                <div class="formrow {!! APFrmErrHelp::hasError($errors, 'aspirations') !!}">
                    <textarea name="aspirations" class="form-control textC" id="summary" placeholder="">{{ old('aspirations', $user->getProfileSummary('aspirations')) }}</textarea>
                    <span class="help-block text-danger summary-error"></span>
                </div>
                <button type="button" class="btn btn-large btn-primary" onClick="submitProfileAspirationsForm();">{{__('Actualizar')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="w-100 my-2"></div>


        @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
        @endif

<h5>{{__('Carta de presentación')}}</h5>
<div class="row">
    <div class="col-md-12">
        <form class="form" id="add_edit_profile_aspirations" method="POST" action="{{ route('update.front.profile.letter', ['id' => $user->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-body">
                <div id="success_msg"></div>
                <div class="formrow">
                    
                    <input name="file" type="file"> 
                    
                    
                    <span class="help-block text-danger summary-error"></span>
                </div>
                <button type="submit" class="btn btn-large btn-primary">{{__('Cargar Carta')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </form>
        
        <!--<form class="form" method="POST" action="{{ route('update.front.profile.letter', ['id' => $user->id]) }}">-->
        <!--    {{ csrf_field() }}-->
            <div class="form-body">
                <button type="button" onclick="deleteLetter()" class=" btn-sm rounded alert-danger">{{__('Eliminar Carta')}}</button>
        <!--</form>-->
        
    </div>
</div>


@push('scripts')
<script type="text/javascript">


deleteLetter = () => {
    
if (window.confirm("Deseas eliminar este archivo?")) {
       
    
fetch('./letter-delete')
  .then(response => response.json())
  .then(data => {
     
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Operación realizada correctamente. ',
            showConfirmButton: false,
            timer: 2500
            })
  });

}
    
}





    function submitProfileSummaryForm() {
        var form = $('#add_edit_profile_summary');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(json) {
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
                    // alert('Incorrect credentials. Please try again.')
                }
            }
        });
    }
</script>
<script type="text/javascript">
    function submitProfileAspirationsForm() {
        var form = $('#add_edit_profile_aspirations');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(json) {
                $("#success_msg").html("<span class='text text-success'>{{__('Aspiraciones futuras actualizadas')}}</span>");
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
                    // alert('Incorrect credentials. Please try again.')
                }
            }
        });
    }
</script>
@endpush