@props(['job'])

<x-panel class="flex-row gap-x-6">
    <div class="">
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex-col">
        <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>
        <h3 class="font-bold text-xl mt-2 group-hover:text-blue-600 transition-colors duration-300"><a
                href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
        </h3>
        <p class="text-sm text-gray-400 mt-auto">{{ $job->scheduale }} - {{ $job->salary }}</p>
    </div>
    <div>
        @foreach ($job->tags as $tag)
            <x-tag :tag="$tag" size="small">Tag</x-tag>
        @endforeach
    </div>
</x-panel>
