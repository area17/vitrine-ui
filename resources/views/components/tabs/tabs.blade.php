<div data-behavior="Tabs"
     {{ $attributes->class([$ui('tabs', 'base')]) }}>

    @if ($title)
        <x-vui-heading :class="$ui('tabs', 'title')"
                       :id="$tabListId"
                       :level="$titleLevel">{{ $title }}</x-vui-heading>
    @endif

    <x-vui-tabs-list :class="$ui('tabs', 'tablist')"
                     :tabs-names="$tabsNames"
                     :name="$name"
                     :ariaLabel="$ariaLabel"
                     :selectedIndex="$startIndex"
                     :tab-button-variant="$tabButtonVariant"
                     :tabListId="isset($title) ? $tabListId : null" />

    {{ $slot }}
</div>
