<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Traits\JobTrait;

class JobPublishController extends Controller
{
    use JobTrait;
    /**     * Create a new controller instance.     *     * @return void     */
    public function __construct()
    {
        $this->middleware('company');
    }
}
