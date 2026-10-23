@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= EVENTS ================= -->
    <section class="section-pad focus-section" id="events">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Events</span>
                <h2>Upcoming and past events</h2>
                <hr class="rule">
                <p>Stay up to date with community outreaches, trainings, and activities happening across Thika and the wider region.</p>
            </div>

            <div class="row g-4">
                @forelse ($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img"
                                style="background-image:url('{{ $event->image_url ? asset('storage/' . $event->image_url) : asset('frontend/images/slider/up.jpg') }}');"
                                title="{{ $event->title }}"></div>
                            <div class="focus-body">
                                @if ($event->tag)
                                    <span class="focus-tag">{{ $event->tag->title ?? $event->tag->name }}</span>
                                @endif
                                <h3>{{ $event->title }}</h3>
                                <p class="event-meta">
                                    @if ($event->date)
                                        <span>{{ $event->date }}</span>
                                    @endif
                                    @if ($event->time)
                                        <span>{{ $event->time }}</span>
                                    @endif
                                    @if ($event->location)
                                        <span>{{ $event->location }}</span>
                                    @endif
                                </p>
                                <p>{!! Str::limit(strip_tags($event->content), 120) !!}.</p>
                                <a href="{{ route('frontend.events.show', $event->slug) }}" class="focus-link">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No events available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $events->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
