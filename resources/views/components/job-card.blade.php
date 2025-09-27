@props(['job'])

<x-panel class="flex-col text-center">
    <div class="flex justify-between">
        <div class="text-sm">{{ $job->employer->name }}</div>
        @can('update', $job)
            <div class="text-sm">
                <a href="{{ route('job.edit', ['job' => $job->id]) }}"
                    class="text-sm text-gray-400 hover:text-blue-600">Edit</a>
                <button type="submit" form="Delete-Form"
                    class="text-sm text-gray-400 hover:text-red-600 ml-2">Delete</button>

                <form action="{{ route('job.destroy', ['job' => $job->id]) }}" method="post" id="Delete-Form">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        @endcan
    </div>
    <div class="py-8">
        <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
        </h3>
        <p class="text-sm mt-4">{{ $job->scheduale }} - {{ $job->salary }}</p>
    </div>
    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach ($job->tags as $tag)
                <x-tag :tag="$tag" size="small" />
            @endforeach
        </div>
        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
