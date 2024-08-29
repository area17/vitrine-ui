<div {{ $attributes->class([$ui('tabs', 'base')]) }} data-behavior="Tabs">

    @if($title)
        <x-vui-heading :class="$ui('tabs', 'title')" :id="$tabListId" :level="$titleLevel">{{ $title }}</x-vui-heading>
    @endif

    <x-vui-tabs-list :class="$ui('tabs', 'tablist')"
                     :tabs-names="$tabsNames"
                     :name="$name"
                     :tabListId="isset($title) ? $tabListId : null"/>

    {{ $slot }}
</div>
