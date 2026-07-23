<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form class="form" id="add_edit_profile_education_non_formal" method="PUT"
            action="{{ route('update.profile.education_non_formal', [$profileEducation->id, $user->id]) }}">
            {{ csrf_field() }} <div class="modal-header"> <button type="button" class="close"
                    data-dismiss="modal">&times;
                </button>
                <h4 class="modal-title">{{ __('Edit Education') }}
                </h4>
            </div> @include('user.forms.non_formal_education.education_form') 
                   <div class="modal-footer"> <button type="button"
                    class="btn btn-large btn-primary"
                    onClick="enviarFormularioEducacionNoFormal();">{{ __('Update Education') }}
                    <i class="fa fa-arrow-circle-right" aria-hidden="true">
                    </i>
                </button> </div>
        </form>
    </div>
</div>
