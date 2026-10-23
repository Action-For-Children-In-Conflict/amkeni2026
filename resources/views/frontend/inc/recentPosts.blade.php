<div class="sidebar-widget">
    <h5>{{ $recentPostsTitle ?? 'Recent Posts' }}</h5>

    @forelse ($recentPosts ?? [] as $post)
        <a href="{{ $post['url'] }}" class="recent-post">
            @if (! empty($post['image']))
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" loading="lazy">
            @endif
            <div>
                <div class="rp-title">{{ $post['title'] }}</div>
                @if (! empty($post['meta']))
                    <span class="rp-date">{{ $post['meta'] }}</span>
                @endif
            </div>
        </a>
    @empty
        <p class="small text-muted mb-0">No recent posts yet.</p>
    @endforelse
</div>
