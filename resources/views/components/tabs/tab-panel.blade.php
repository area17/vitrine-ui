<div {{ $attributes->class([$ui('tab-panel', 'base')]) }}
     @if($selected) data-panel-active="true" @else inert hidden @endif
     id="{{ $name.'-panel-'.$index }}"
     data-Tabs-panel=""
     role="tabpanel"
     aria-labelledby="{{ $name.'-'.$index }}">
    {{ $slot }}
</div>
