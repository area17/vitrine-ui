@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'preset' => 'listing.inline',
])

<div class="w-screen max-w-full">
    <x-vui-listing
        layout="1up"
        :items="$items ?? null"
        card-type="inline"
    />
</div>
