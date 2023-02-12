<?php

namespace App\Traits;

use App\ProfileSummary;
use App\Http\Requests\ProfileSummaryFormRequest;
use Illuminate\Http\Request;

trait ProfileSummaryTrait
{

    public function updateProfileSummary($user_id, ProfileSummaryFormRequest $request)
    {
        $ProfileSummary = ProfileSummary::where('user_id', '=', $user_id)->first();

        if (!$ProfileSummary) {
            $ProfileSummary = new ProfileSummary();
        }
        $summary = $request->input('summary');
        $ProfileSummary->user_id = $user_id;
        $ProfileSummary->summary = $summary;
        $ProfileSummary->save();
        return response()->json(array('success' => true, 'status' => 200), 200);
    }

    public function updateProfileAspirations($user_id, Request $request)
    {
        $ProfileSummary = ProfileSummary::where('user_id', '=', $user_id)->first();
        if (!$ProfileSummary) {
            $ProfileSummary = new ProfileSummary();
        }
        $summary = $request->input('aspirations');
        $ProfileSummary->user_id = $user_id;
        $ProfileSummary->aspirations = $summary;
        $ProfileSummary->save();
        return response()->json(array('success' => true, 'status' => 200), 200);

        // ProfileSummary::where('user_id', '=', $user_id)->delete();
        // $summary = $request->input('aspirations');
        // $ProfileSummary = new ProfileSummary();
        // $ProfileSummary->user_id = $user_id;
        // $ProfileSummary->aspirations = $summary;
        // $ProfileSummary->save();
        // dd($ProfileSummary);
        // /*         * ************************************ */
        // return response()->json(array('success' => true, 'status' => 200), 200);
    }
}
