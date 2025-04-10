@storybook([
    'status' => 'readyForQA',
    'preset' => 'button.base',
])

<x-vui-button :href="$href ?? null"
              :icon="$icon ?? null"
              :icon-position="$iconPosition ?? null"
              :static="$static ?? null"
              :disabled="$disabled ?? null"
              :active="$active ?? null"
              variant="secondary">
    <x-slot:slotBefore>
        <span>BEFORE CONTENT</span>
    </x-slot:slotBefore>
    <x-slot:slotAfter>
        <span>AFTER CONTENT</span>
    </x-slot:slotAfter>

    {{ $label ?? null }}
</x-vui-button>
