<?php

namespace App\Traits;

use App\User;
use App\ProfileEducation;
use App\ProfileEducationMajorSubject;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ProfileEducationFormRequest;
use App\Helpers\DataArrayHelper;
use App\Models\ProfileEducationNonFormal;

trait ProfileEducationNonFormalTrait
{
    public function showFrontProfileEducationNonFormal(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $html = '
        <div class="panel-group">';
        if (isset($user) && count($user->profileEducationNonFormal)) : foreach ($user->profileEducationNonFormal as $education) : $html .= '
        <div class="panel panel-info" id="education_non_formal_' . $education->id . '"> <div class="panel-heading">
        <h4>' . $education->training_type . ' - ' . $education->certification_status . '
        </h4>
        </div> <div class="panel-body"> <p class="text-left">
        <h5>' . $education->program_name . '
        </h5>
        </p> <p class="text-left">' . $education->date . ' | ' . $education->city->city . '
        </p> <p class="text-left">' . $education->institution . '
        </p> </div> <div class="panel-footer">
        <a href="javascript:void(0);" onclick="mostrarModalEdicionEducacionNoFormal(' . $education->id . ',' . $education->state_id . ',' . $education->city_id  . ');" class="text text-default">' . __('Edit') . '
        </a>&nbsp;|&nbsp;
        <a href="javascript:void(0);" onclick="eliminarEducacionNoFormal(' . $education->id . ');" class="text text-danger">' . __('Delete') . '
        </a>
        </div> </div>';
        endforeach;
        endif;
        echo $html . '
        </div>';
    }

    public function showProfileEducationNonFormal(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $html = '';
        if (isset($user) && count($user->profileEducationNonFormal)) : foreach ($user->profileEducationNonFormal as $education) : $html .= '<div class="col-md-12" id="education_non_formal_' . $education->id . '"> <div class="mt-element-ribbon bg-grey-steel"> <div class="ribbon ribbon-color-warning uppercase ">' . $education->training_type . ' - ' . $education->certification_status . '
        </div> <p class="ribbon-content"> ' . $education->program_name . '
        <br /> ' . $education->date . ' | ' . (isset($education->city) ? (gettype($education->city) == 'object' ? $education->city->city : $education->city['city']) : 'Sin ciudad') . '
        <br /> ' . $education->institution . '
        <br /> <a href="javascript:void(0);" onclick="mostrarModalEdicionEducacionNoFormal(' . $education->id . ',' . $education->state_id . ',' . $education->city_id . ');" class="btn btn-warning">' . __('Edit') . '
        </a> <a href="javascript:void(0);" onclick="eliminarEducacionNoFormal(' . $education->id . ');" class="btn btn-danger">' . __('Delete') . '
        </a> </p> </div> </div>';
        endforeach;
        endif;
        echo $html;
    }


    public function showApplicantProfileEducationNonFormal(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $html = '
        <ul class="educationList">';
        if (isset($user) && count($user->profileEducationNonFormal)) : foreach ($user->profileEducationNonFormal as $education) :
            $html .= '
        <li> <div class="date">' . $education->date . '
        <br/>' . $education->city->city . '
        </div> <h4>' . $education->training_type . ' - ' . $education->certification_status . '
        </h4> <h5>' . $education->program_name . '
        </h5> <p>' . $education->institution . '
        </p> <div class="clearfix">
        </div> </li>';
        endforeach;
        endif;
        echo $html . '
        </ul>';
    }

    public function getFrontProfileEducationNonFormalForm(Request $request, $user_id)
    {
        $degreeLevels = DataArrayHelper::langDegreelevelsArray();
        $resultTypes = DataArrayHelper::langResultTypesArray();
        $majorSubjects = DataArrayHelper::langMajorSubjectsArray();
        $countries = DataArrayHelper::langCountriesArray();
        $profileEducationMajorSubjectIds = array();
        $user = User::find($user_id);
        $returnHTML = view('user.forms.non_formal_education.education_modal')
            ->with('user', $user)
            ->with('degreeLevels', $degreeLevels)
            ->with('resultTypes', $resultTypes)
            ->with('majorSubjects', $majorSubjects)
            ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
            ->with('countries', $countries)->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function storeProfileEducationNonFormal(Request $request, $user_id)
    {
        $profileEducation = new ProfileEducationNonFormal();
        $profileEducation = $this->assignEducationNonFormalValues($profileEducation, $request, $user_id);
        $profileEducation->save();
        $returnHTML = view('admin.user.forms.non_formal_education.education_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    public function storeFrontProfileEducationNonFormal(Request $request, $user_id)
    {
        $profileEducation = new ProfileEducationNonFormal();
        $profileEducation = $this->assignEducationNonFormalValues($profileEducation, $request, $user_id);
        $profileEducation->save();
        $returnHTML = view('user.forms.non_formal_education.education_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    private function assignEducationNonFormalValues($profileEducation, $request, $user_id)
    {
        $profileEducation->user_id = $user_id;
        $profileEducation->training_type = $request->input('education_non_formal_training_type');
        $profileEducation->institution = $request->input('education_non_formal_institution');
        $profileEducation->certification_status = $request->input('education_non_formal_certification_status');
        $profileEducation->program_name = $request->input('education_non_formal_program_name');
        $profileEducation->country_id = $request->input('country_id');
        $profileEducation->state_id = $request->input('state_id');
        $profileEducation->city_id = $request->input('city_id');
        $profileEducation->duration = $request->input('education_non_formal_duration');
        $profileEducation->date = $request->input('education_non_formal_date');
        return $profileEducation;
    }
    public function getProfileEducationNonFormalEditForm(Request $request, $user_id)
    {
        $education_id = $request->input('education_non_formal_id');
        $countries = DataArrayHelper::defaultCountriesArray();
        $profileEducation = ProfileEducationNonFormal::find($education_id);
        $user = User::find($user_id);
        $returnHTML = view('admin.user.forms.non_formal_education.education_edit_modal')->with('user', $user)
            ->with('profileEducation', $profileEducation)
            ->with('countries', $countries)->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function getFrontProfileEducationNonFormalEditForm(Request $request, $user_id)
    {
        $education_id = $request->input('education_non_formal_id');
        $degreeLevels = DataArrayHelper::langDegreelevelsArray();
        $resultTypes = DataArrayHelper::langResultTypesArray();
        $majorSubjects = DataArrayHelper::langMajorSubjectsArray();
        $countries = DataArrayHelper::langCountriesArray();
        $profileEducation = ProfileEducationNonFormal::find($education_id);
        $user = User::find($user_id);

        $returnHTML = view('user.forms.non_formal_education.education_edit_modal', compact(
            'user',
            'profileEducation',
            'degreeLevels',
            'resultTypes',
            'majorSubjects',
            'countries'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $returnHTML
        ]);
    }

    public function updateProfileEducationNonFormal(Request $request, $education_id, $user_id)
    {
        $profileEducation = ProfileEducationNonFormal::find($education_id);
        $profileEducation = $this->assignEducationNonFormalValues($profileEducation, $request, $user_id);
        $profileEducation->update();

        $returnHTML = view('admin.user.forms.non_formal_education.education_edit_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    public function updateFrontProfileEducationNonFormal(Request $request, $education_id, $user_id)
    {
        $profileEducation = ProfileEducationNonFormal::find($education_id);
        $profileEducation = $this->assignEducationNonFormalValues($profileEducation, $request, $user_id);
        $profileEducation->update();
        $returnHTML = view('user.forms.non_formal_education.education_edit_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    public function deleteAllProfileEducationNonFormal($user_id)
    {
        $profileEducations = ProfileEducationNonFormal::where('user_id', '=', $user_id)->get();
        foreach ($profileEducations as $profileEducation) {
            echo $this->removeProfileEducationNonFormal($profileEducation->id);
        }
    }

    public function deleteProfileEducationNonFormal(Request $request)
    {
        $id = $request->input('id');
        echo $this->removeProfileEducationNonFormal($id);
    }

    private function removeProfileEducationNonFormal($id)
    {
        try {
            $profileEducation = ProfileEducationNonFormal::findOrFail($id);
            $profileEducation->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function getProfileEducationNonFormalForm(Request $request, $user_id)
    {
        $degreeLevels = DataArrayHelper::langDegreelevelsArray();
        $resultTypes = DataArrayHelper::langResultTypesArray();
        $majorSubjects = DataArrayHelper::langMajorSubjectsArray();
        $countries = DataArrayHelper::langCountriesArray();
        $profileEducationMajorSubjectIds = array();
        $user = User::find($user_id);
        $returnHTML = view('admin.user.forms.non_formal_education.education_modal')
            ->with('user', $user)
            ->with('degreeLevels', $degreeLevels)
            ->with('resultTypes', $resultTypes)
            ->with('majorSubjects', $majorSubjects)
            ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
            ->with('countries', $countries)->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }
}
