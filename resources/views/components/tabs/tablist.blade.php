<ul role="tablist"
    {{ $attributes->class([$ui('tab-list', 'base')]) }}
    @if ($tabListId) aria-labelledby="{{ $tabListId }}"
     @elseif($ariaLabel) aria-label="{{ $ariaLabel }}" @endif>

    @foreach ($tabsNames as $tabName)
        <li @if (count($tabsNames) == 1) role="presentation" @endif>
            <x-vui-button id="{{ $name . '-' . $loop->index }}"
                          data-Tabs-button=""
                          role="tab"
                          aria-controls="{{ $name . '-panel-' . $loop->index }}"
                          aria-selected="{{ $loop->index === $selectedIndex ? 'true' : 'false' }}"
                          :class="$ui('tab-list', 'button')"
                          :variant="$tabButtonVariant">
                {{ $tabName }}
            </x-vui-button>
        </li>
    @endforeach
</ul>
