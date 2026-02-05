@props([
    'behavior' => 'FilterPanel',
    'chipsTitle' => __('vitrine-ui::fe.filters.selected'),
    'filters' => [],
    'headingLevel' => 2,
    'modalId' => 'filtersPanel',
    'modalVariant' => 'filters',
    'open' => false,
    'showChips' => true,
    'title' => __('vitrine-ui::fe.filters.filter'),
    'useSwup' => false,
    'applyButtonVariant' => 'primary',
    'resetButtonVariant' => 'secondary',
    'closeOnButtonClick' => true,
])

<x-vui-modal class="{{ VitrineUI::ui('filters-panel', 'modal', [], $ui ?? []) }}"
             id="{{ $modalId }}"
             :panel="true"
             :variant="$modalVariant"
             :show-close="false"
             :open="$open">
    <div class="{{ VitrineUI::ui('filters-panel', 'panel', [], $ui ?? []) }}"
         data-behavior="{{ $behavior }}"
         data-{{ $behavior }}-closeOnButtonClick="{{ $closeOnButtonClick ? 'true' : 'false' }}"
         @if ($behavior) data-{{ $behavior }}-useSwup="{{ $useSwup ? 'true' : 'false' }}" @endif>
        @if (isset($header))
            {{ $header }}
        @else
            <div class="{{ VitrineUI::ui('filters-panel', 'header', [], $ui ?? []) }}">
                <x-vui-heading class="{{ VitrineUI::ui('filters-panel', 'title', [], $ui ?? []) }}"
                               id="{{ $modalId }}_title"
                               data-Modal-initial-focus=""
                               tabindex="-1"
                               :level="$headingLevel">
                    {{ $title }}
                </x-vui-heading>
                <x-vui-button data-Modal-close-trigger
                              aria-label="{{ __('vitrine-ui::fe.close_modal') }}"
                              variant="secondary"
                              icon="close-24"
                              :icon-only="true" />

            </div>
        @endif

        <div class="{{ VitrineUI::ui('filters-panel', 'scroll-area', [], $ui ?? []) }}"
             data-Modal-scroller>
            @if ($showChips)
                <div class="{{ VitrineUI::ui('filters-panel', 'chips', [], $ui ?? []) }}"
                     data-FilterPanel-chips
                     hidden>
                    <x-vui-heading class="{{ VitrineUI::ui('filters-panel', 'chips-title', [], $ui ?? []) }}"
                                   id="{{ $modalId }}_selectedHeading"
                                   data-FilterPanel-chipsHeading
                                   tabindex="-1"
                                   :level="3">
                        {{ $chipsTitle }}
                    </x-vui-heading>
                    <ul class="{{ VitrineUI::ui('filters-panel', 'chips-list', [], $ui ?? []) }}"
                        aria-labelledby="{{ $modalId }}_selectedHeading">
                        <li data-FilterPanel-chipTemplate
                            hidden>
                            <x-vui-tag :cancellable="true">
                                Filter
                            </x-vui-tag>
                        </li>
                    </ul>
                </div>
            @endif
            @if ($filters ?? null)
                <x-vui-accordion a11yLabel="{{ __('vitrine-ui::fe.accordion') }}">
                    @foreach ($filters as $accordionItem)
                        <x-vui-accordion-item :title="$accordionItem['title'] ?? null"
                                              :index="$loop->index"
                                              :set-fixed-height="false"
                                              :open="$accordionItem['open'] ?? false">
                            @if ($accordionItem['items'] ?? null)
                                <div
                                     class="{{ VitrineUI::ui('filters-panel', 'accordion-item-inner', [], $ui ?? []) }}">
                                    @if ($accordionItem['type'] && $accordionItem['type'] == 'checkbox')
                                        @foreach ($accordionItem['items'] as $item)
                                            <x-vui-form-checkbox data-FilterPanel-checkbox
                                                                 data-omit="{{ isset($accordionItem['omitFromChips']) && $accordionItem['omitFromChips'] ? 'true' : 'false' }}"
                                                                 :label="$item['label'] ?? null"
                                                                 :name="$accordionItem['name'] ?? null"
                                                                 :id="$accordionItem['name'] ?? null
                                                                     ? strtolower(
                                                                             str_replace(
                                                                                 ' ',
                                                                                 '-',
                                                                                 $accordionItem['name'],
                                                                             ),
                                                                         ) . $loop->index
                                                                     : null"
                                                                 :value="$item['value'] ?? null"
                                                                 :selected="count(request()->query()) === 0 &&
                                                                 (isset($item['checked']) && $item['checked'])
                                                                     ? true
                                                                     : VitrineUI::isFilterSelected(
                                                                         $accordionItem['name'],
                                                                         $item['value'],
                                                                     )" />
                                        @endforeach
                                    @endif

                                    @if ($accordionItem['type'] && $accordionItem['type'] == 'radio')
                                        @foreach ($accordionItem['items'] as $item)
                                            <x-vui-form-radio data-FilterPanel-checkbox
                                                              data-omit="{{ isset($accordionItem['omitFromChips']) && $accordionItem['omitFromChips'] ? 'true' : 'false' }}"
                                                              :label="$item['label'] ?? null"
                                                              :name="$accordionItem['name'] ?? null"
                                                              :id="$accordionItem['name'] ?? null
                                                                  ? strtolower(
                                                                          str_replace(' ', '-', $accordionItem['name']),
                                                                      ) . $loop->index
                                                                  : null"
                                                              :value="$item['value'] ?? null"
                                                              :selected="count(request()->query()) === 0 &&
                                                              (isset($item['checked']) && $item['checked'])
                                                                  ? true
                                                                  : VitrineUI::isFilterSelected(
                                                                      $accordionItem['name'],
                                                                      $item['value'],
                                                                  )" />
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </x-vui-accordion-item>
                    @endforeach
                </x-vui-accordion>

            @endif
        </div>

        @if (isset($footer))
            {{ $footer }}
        @else
            <div class="{{ VitrineUI::ui('filters-panel', 'footer', [], $ui ?? []) }}">
                <x-vui-button class="{{ VitrineUI::ui('filters-panel', 'footer-button', [], $ui ?? []) }}"
                              data-FilterPanel-reset
                              variant="{{ $resetButtonVariant }}">
                    {{ __('vitrine-ui::fe.filters.clear_all') }}
                </x-vui-button>
                <x-vui-button class="{{ VitrineUI::ui('filters-panel', 'footer-button', [], $ui ?? []) }}"
                              data-FilterPanel-apply
                              variant="{{ $applyButtonVariant }}">
                    {{ __('vitrine-ui::fe.filters.apply') }}
                    <span data-FilterPanel-count
                          hidden></span>
                </x-vui-button>
            </div>
        @endif
    </div>
</x-vui-modal>
