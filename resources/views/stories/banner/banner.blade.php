@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'args' => [
        'id' => '123',
        'showClose' => true,
        'closeButtonVariant' => 'primary',
        'closeButtonSize' => 'md',
        'cookieTimeout' => 3, // Default cookie timeout in days
    ],
])

<div class="w-full overflow-hidden">
    <x-vui-banner class="bg-[#EEEEEE]"
                  id="123"
                  :show-close="$showClose"
                  :close-button-variant="$closeButtonVariant"
                  :close-button-size="$closeButtonSize"
                  :cookie-timeout="$cookieTimeout">
        <div class="pe-60">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget dapibus quam. Donec egestas congue
                eros eu elementum. Integer malesuada auctor quam sed sollicitudin. Aliquam erat volutpat.</p>
        </div>
    </x-vui-banner>
</div>
