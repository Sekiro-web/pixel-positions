<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        $jobs = Job::with('tags', 'employer')->latest()->get();
        $groupedJobs = $jobs->groupBy('featured');

        return view('Jobs.index', [
            'jobs' => $groupedJobs[0],
            'featurdJobs' => $groupedJobs[1],
            'tags' => $tags,
        ]);
    }


    public function create()
    {
        return view('Jobs.create', ['tags' => Tag::all()]);
    }

    public function store(Request $request) {

        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'scheduale' => ['required', Rule::in(['Full Time', 'Part Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if($attributes['tags'] ?? false){
            foreach(explode(',', $attributes['tags']) as $tag){
                $job->tag($tag);
            }
        }

        return redirect('/');
    }

    public function search()
    {
        return '';
    }
}
