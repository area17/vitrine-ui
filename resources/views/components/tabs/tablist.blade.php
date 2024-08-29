<div {{ $attributes->class([$ui('tab-list', 'base')]) }}
     @if($tabListId) aria-labelledby="{{ $tabListId }}"
     @elseif($ariaLabel) aria-label="{{$ariaLabel}}"
        @endif>

     @foreach($tabsNames as $tabName)
          <x-vui-button id="{{ $name.'-'.$loop->index }}"
                        data-Tabs-button=""
                        aria-controls="{{  $name.'-panel-'.$loop->index }}"
                        role="tab"
                        aria-selected="{{ $loop->index === $selectedIndex ? 'true' : 'false' }}"
                        :class="$ui('tab-list', 'button')"
                        :variant="$tabButtonVariant">
               {{ $tabName }}
          </x-vui-button>
     @endforeach
</div>
