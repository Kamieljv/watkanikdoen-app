<ul class="{{ $class ?? 'flex items-center space-x-5' }}">
    @include('partials.social-link', ['href' => 'https://www.instagram.com/watkanikdoen.nl/', 'label' => 'Instagram', 'icon' => 'instagram'])
    @include('partials.social-link', ['href' => 'https://bsky.app/profile/watkanikdoen-nl.bsky.social', 'label' => 'Bluesky', 'icon' => 'bluesky'])
    @include('partials.social-link', ['href' => 'https://github.com/Kamieljv/watkanikdoen-app', 'label' => 'GitHub', 'icon' => 'github'])
</ul>
