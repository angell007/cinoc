<?php

namespace Tests\Unit;

use App\Http\Requests\JobFormRequest;
use Tests\TestCase;

class JobFormRequestTest extends TestCase
{
    public function test_position_is_required_when_storing_a_job()
    {
        $request = JobFormRequest::create('/admin/store-job', 'POST');
        $rules = $request->rules();

        $this->assertArrayHasKey('position', $rules);
        $this->assertSame('required', $rules['position']);
        $this->assertArrayNotHasKey('skills', $rules);
    }
}
