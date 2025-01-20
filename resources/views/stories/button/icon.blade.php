@storybook([
    'status' => 'readyForQA',
    'name' => 'With Icon',
    'preset' => 'button.icon',
])

<x-vui-button :href="$href ?? null"
              :icon="$icon ?? null"
              :icon-only="true"
              :static="$static ?? null"
              :inverse="$inverse ?? null"
              :disabled="$disabled ?? null"
              :active="$active ?? null"
              :size="$size ?? null" />
