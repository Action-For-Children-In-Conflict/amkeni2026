<!-- ================= FOCUS AREAS ================= -->
<section class="section-pad focus-section" id="focus">
    <div class="container container-narrow">
        <div class="section-head">
            <span class="section-eyebrow">Our Focus Areas</span>
            <h2>Four areas, one goal</h2>
            <hr class="rule">
            <p>Systemic problems need connected solutions — this is where we direct our energy and resources to create lasting change.</p>
        </div>
        <div class="row g-4">
            @foreach ($programs as $program)
                <div class="col-md-6 col-lg-3">
                    
                    <div class="focus-card">
                        <div class="focus-img"
                            style="background-image:url('{{ $program->image_url }}');">
                        </div>
                        <div class="focus-body">
                          {{--   <span class="focus-tag">Ch</span> --}}
                            <h3>{{$program->title}}</h3>
                            <p>{!! Str::limit($program->description, 100) !!}.</p>
                            <a href="focus-child-protection.html" class="focus-link">Read more</a>
                        </div>
                    </div>
                   
                </div>
               @endforeach
              {{--   <span class="text-gray-500">No programs available at the moment.</span> --}}
           

            {{-- <div class="col-md-6 col-lg-3">
                <div class="focus-card">
                    <div class="focus-img"
                        style="background-image:url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=800&auto=format&fit=crop');">
                    </div>
                    <div class="focus-body">
                        <span class="focus-tag">Education</span>
                        <h3>Classrooms that keep kids</h3>
                        <p>Sponsoring children from vulnerable backgrounds so school stays a place they return to, not
                            one they leave.</p>
                        <a href="focus-education-empowerment.html" class="focus-link">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="focus-card">
                    <div class="focus-img"
                        style="background-image:url('https://images.unsplash.com/photo-1531123897727-8f129e1688ce?q=80&w=800&auto=format&fit=crop');">
                    </div>
                    <div class="focus-body">
                        <span class="focus-tag">Women's empowerment</span>
                        <h3>Equal ground</h3>
                        <p>Challenging norms that hold women back through education, awareness and economic support.</p>
                        <a href="focus-womens-empowerment.html" class="focus-link">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="focus-card">
                    <div class="focus-img"
                        style="background-image:url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?q=80&w=800&auto=format&fit=crop');">
                    </div>
                    <div class="focus-body">
                        <span class="focus-tag">Climate</span>
                        <h3>Land that lasts</h3>
                        <p>Promoting renewable energy and sustainable land management so families aren't the first to
                            feel the next drought.</p>
                        <a href="focus-climate-change.html" class="focus-link">Read more</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
