@storybook([
    'status' => 'readyForQA',
    'preset' => 'card.primary'
])

<div class="w-screen" style="max-width: 300px">
    <x-vui-card-primary
        :title="$title ?? null"
        :description="$description ?? null"
        :media="$media ?? null"
        :href="$href ?? null"
        :heading-level="$headingLevel ?? null"
    />
</div>
