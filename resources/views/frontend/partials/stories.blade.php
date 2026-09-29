<!-- ================= STORIES ================= -->
<section class="section-pad focus-section" id="stories">
    <div class="container container-narrow">
        <div class="section-head">
            <span class="section-eyebrow">Stories of Transformation</span>
            <h2>Turning adversity into opportunity</h2>
            <hr class="rule">
            <p>Real stories of courage, resilience, and hope from young people whose lives changed course through our programmes.</p>
        </div>
        <div class="row g-4">
            @foreach ($testmonialstories as $testimonial)
                <div class="col-md-4">
                    <div class="story-card">
                        <div class="story-img-wrap"><img
                                src="{{ $testimonial->image }}"
                                alt="Portrait representing a young person"></div>
                        <h4>{{ $testimonial->position }}</h4>
                        <p>{!! Str::limit(strip_tags($testimonial->name), 110) . '...' !!}</p>
                        <a href="story-alex.html" class="story-link">Read the story →</a>
                    </div>
                </div>
            @endforeach
          
           {{--  <div class="col-md-4">
                <div class="story-card">
                    <div class="story-img-wrap"><img
                            src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?q=80&w=800&auto=format&fit=crop"
                            alt="Portrait representing a young person"></div>
                    <h4>Waweru's journey of resilience</h4>
                    <p>Growing up in Kiandutu, one young man's path from hardship to transformation.</p>
                    <a href="story-waweru.html" class="story-link">Read the story →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="story-card">
                    <div class="story-img-wrap"><img
                            src="https://images.unsplash.com/photo-1531123414780-f74242c2b052?q=80&w=800&auto=format&fit=crop"
                            alt="Portrait representing a young person"></div>
                    <h4>Nelly's brighter future</h4>
                    <p>A 22-year-old from Thika shows what a single well-placed programme can change.</p>
                    <a href="story-nelly.html" class="story-link">Read the story →</a>
                </div>
            </div> --}}
        </div>
    </div>
</section>
