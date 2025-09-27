<x-layout>
    <x-page-heading>Update Job</x-page-heading>

    <x-forms.form action="{{ route('job.update', ['job' => $job->id]) }}" method="POST">
        @method('PUT')
        <x-forms.input label="Title" name="title" plsceholder="Job Title" value="{{ $job->title }}" />
        <x-forms.input label="Salary" name="salary" placeholder="Salary" value="{{ $job->salary }}" />
        <x-forms.input label="Location" name="location" placeholder="Job location" value="{{ $job->location }}" />

        <x-forms.select label="scheduale" name="scheduale">
            <option selected disabled>Choose scheduale</option>
            <option class="text-black" @if ($job->scheduale == 'Full Time') selected @endif>Full Time</option>
            <option class="text-black" @if ($job->scheduale == 'Part Time') selected @endif>Part Time</option>
        </x-forms.select>


        <x-forms.input label="URL" name="url" placeholder="https://your-job-link.com"
            value="{{ $job->url }}" />
        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="Backend,Teaching...etc"
            value="{{ $tagNames }}" />
        <x-forms.divider />
        <x-forms.checkbox label="Featured (costs extra)" name="featured"
            checked="{{ $job->featured ? true : false }}" />

        <x-forms.button>Update</x-forms.button>
    </x-forms.form>
</x-layout>
