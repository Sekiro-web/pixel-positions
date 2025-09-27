<x-layout>
    <x-page-heading>Update Job</x-page-heading>

    <x-forms.form action="{{ route('job.update', ['job' => $job->id]) }}" method="PUT">

        <x-forms.input label="Title" name="title" plsceholder="Job Title" />
        <x-forms.input label="Salary" name="salary" placeholder="Salary" />
        <x-forms.input label="Location" name="location" placeholder="Job location" />

        <x-forms.select label="scheduale" name="scheduale">
            <option class="text-black">Full Time</option>
            <option class="text-black">Part Time</option>
        </x-forms.select>


        <x-forms.input label="URL" name="url" placeholder="https://your-job-link.com" />
        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="Backend,Teaching...etc" />
        <x-forms.divider />
        <x-forms.checkbox label="Featured (costs extra)" name="featured" />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>
