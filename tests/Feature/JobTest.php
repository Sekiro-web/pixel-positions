<?php

namespace Tests\Feature;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_job_belongs_to_employer()
    {
        $employer = Employer::factory()->create();

        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        $this->assertTrue($employer->job->contains($job));
        $this->assertTrue($job->employer->is($employer));
    }
}
