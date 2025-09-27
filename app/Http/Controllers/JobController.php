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

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'scheduale' => ['required', Rule::in(['Full Time', 'Part Time'])],
            'url' => ['required', 'active_url', 'max:255'],
            'tags' => ['nullable', 'string']
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }

    public function edit(Job $job)
    {
        $tagNames = $job->tags->pluck('name')->implode(',');

        return view('Jobs.edit', [
            'job' => $job,
            'tagNames' => $tagNames
        ]);
    }

    public function update(Request $request, Job $job)
    {
        try {
            $attributes = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'salary' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'scheduale' => ['required', Rule::in(['Full Time', 'Part Time'])],
                'url' => ['required', 'active_url', 'max:255'],
                'tags' => ['nullable', 'string']
            ]);

            $attributes['featured'] = $request->boolean('featured');

            $job->update(Arr::except($attributes, 'tags'));

            $job->tags()->detach();

            if ($attributes['tags'] ?? false) {
                foreach (explode(',', $attributes['tags']) as $tag) {
                    $job->tag(trim($tag));
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect('/');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/');
    }
}
