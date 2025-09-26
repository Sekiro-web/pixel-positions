@props(['employer', 'width' => 90])

<img src="{{ $employer->logo }}" alt="" class="rounded-xl"
    style="width: {{ $width }}px; height: {{ $width }}px;">
