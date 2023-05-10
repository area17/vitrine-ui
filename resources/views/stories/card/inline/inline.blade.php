@storybook([
    'status' => 'readyForQA',
    'preset' => 'card.inline'
])

<div class="w-screen -ml-[1rem]">
    <div class="container">
        <x-vui-card-inline
            :heading-level="$headingLevel ?? null"
            :href="$href ?? null"
            :title="$title ?? null"
            :description="$description ?? null"
            :date="$date ?? null"
            :media="$media ?? null"
        />
    </div>
</div>
