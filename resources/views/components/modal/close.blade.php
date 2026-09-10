@props([
    'closeButtonVariant' => null,
])

<div class="{{ VitrineUI::ui('modal-close') }}">
    <div class="{{ VitrineUI::ui('modal-close', 'wrapper') }}">
        <x-vui-button class="{{ VitrineUI::ui('modal-close', 'button') }}"
                      data-Modal-close-trigger
                      aria-label="{{ __('vitrine-ui::fe.close_modal') }}"
                      :variant="$closeButtonVariant"
                      icon="{{ VitrineUI::ui('modal-close', 'icon') }}"
                      :icon-only="true" />
    </div>
</div>
