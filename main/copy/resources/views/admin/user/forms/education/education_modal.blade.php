<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form class="form" id="add_edit_profile_education" method="POST"
            action="{{ route('store.profile.education', [$user->id]) }}">{{ csrf_field() }} <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                </button>
                <h4 class="modal-title"> Nuevo estudio
                </h4>
            </div> @include('admin.user.forms.education.education_form') <div class="modal-footer"> <button type="button"
                    class="btn dark btn-outline" data-dismiss="modal">Close
                </button> <button type="button" class="btn btn-large btn-primary"
                    onClick="submitProfileEducationForm();">Guardar estudio
                    <i class="fa fa-arrow-circle-right" aria-hidden="true">
                    </i>
                </button> </div>
        </form>
    </div>
</div>
