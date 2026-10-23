<div class="sidebar-widget">
    <h5>Our Partners</h5>

    @if ($partners->isEmpty())
        <p class="small text-muted mb-0">Partner information coming soon.</p>
    @else
        <ul class="partner-list">
            @foreach ($partners as $partner)
                <li>
                    <a href="{{ $partner->website_url ?: route('partners') }}"
                        @if ($partner->website_url) target="_blank" rel="noopener" @endif>
                        {{ $partner->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
