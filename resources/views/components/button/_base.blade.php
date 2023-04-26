@php
$classes = [
    'inline-flex items-center',
    'disabled:cursor-default',
    'group',
    'transition-all',
];
@endphp

<{{ $element() }}
    {{ $attributes->class(Arr::toCssClasses($classes)) }}
    @if($href) href="{{ $href }}" @endif
    @if($target) target="{{ $target }}" @endif
>
    @if ($iconBefore())
        {{-- {!! $theIcon() !!} --}}
    @endif

    @if (!$slot->isEmpty())
        <span class="text-inherit {{ $labelClasses() }}">{{ $slot }}</span>
    @endisset

    @if ($iconAfter())
        {{-- {!! $theIcon() !!} --}}
    @endif
</{{ $element() }}>
